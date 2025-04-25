<?php

namespace Modules\Support\app\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Modules\Support\app\Models\ContactForm;
use Modules\Support\app\Mail\NewContactSubmission;
use Modules\Support\app\Mail\ContactFormStatusChange;

class ContactFormService
{
    /**
     * Get contact form submissions with pagination and filtering.
     *
     * @param int $perPage
     * @param string|null $status
     * @param string|null $search
     * @param string|null $fromDate
     * @param string|null $toDate
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getContactForms($perPage = 15, $status = null, $search = null, $fromDate = null, $toDate = null)
    {
        $query = ContactForm::with('user')->orderBy('created_at', 'desc');
        
        // Filter by status if provided
        if ($status) {
            $query->where('status', $status);
        }
        
        // Filter by search term if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }
        
        // Filter by date range if provided
        if ($fromDate) {
            $query->where('created_at', '>=', $fromDate);
        }
        
        if ($toDate) {
            $query->where('created_at', '<=', $toDate);
        }
        
        return $query->paginate($perPage);
    }

    /**
     * Get a specific contact form submission.
     *
     * @param int $id
     * @return ContactForm
     */
    public function getContactForm($id)
    {
        return ContactForm::with('user')->findOrFail($id);
    }

    /**
     * Create a new contact form submission.
     *
     * @param array $data
     * @param int|null $userId
     * @param string|null $ipAddress
     * @return ContactForm
     */
    public function createContactForm(array $data, $userId = null, $ipAddress = null)
    {
        DB::beginTransaction();
        
        try {
            // Set additional data
            $data['user_id'] = $userId;
            $data['ip_address'] = $ipAddress;
            $data['status'] = 'pending';
            
            $contactForm = ContactForm::create($data);
            
            // Send notification email
            $this->sendNewContactFormNotification($contactForm);
            
            DB::commit();
            
            return $contactForm;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update the status of a contact form submission.
     *
     * @param int $id
     * @param string $status
     * @param string|null $notes
     * @return ContactForm
     */
    public function updateContactFormStatus($id, $status, $notes = null)
    {
        $contactForm = ContactForm::findOrFail($id);
        
        // Update status and notes
        $contactForm->status = $status;
        
        if ($notes) {
            $contactForm->admin_notes = $notes;
        }
        
        $contactForm->save();
        
        // Send status change email to contact
        if ($contactForm->wasChanged('status')) {
            $this->sendStatusChangeNotification($contactForm);
        }
        
        return $contactForm->fresh('user');
    }

    /**
     * Delete a contact form submission.
     *
     * @param int $id
     * @return bool
     */
    public function deleteContactForm($id)
    {
        $contactForm = ContactForm::findOrFail($id);
        return $contactForm->delete();
    }

    /**
     * Get contact form statistics.
     *
     * @return array
     */
    public function getContactFormStats()
    {
        $total = ContactForm::count();
        $pending = ContactForm::where('status', 'pending')->count();
        $inProgress = ContactForm::where('status', 'in_progress')->count();
        $resolved = ContactForm::where('status', 'resolved')->count();
        $spam = ContactForm::where('status', 'spam')->count();
        
        // Get submissions by day for the last 30 days
        $thirtyDaysAgo = now()->subDays(30);
        $submissionsByDay = ContactForm::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();
        
        return [
            'total' => $total,
            'pending' => $pending,
            'in_progress' => $inProgress,
            'resolved' => $resolved,
            'spam' => $spam,
            'submissions_by_day' => $submissionsByDay,
        ];
    }

    /**
     * Send notification email about new contact form submission.
     *
     * @param ContactForm $contactForm
     * @return void
     */
    private function sendNewContactFormNotification(ContactForm $contactForm)
    {
        // Get admin email from config or use a default
        $adminEmail = config('support.admin_email', 'admin@example.com');
        
        // Send notification to admin
        Mail::to($adminEmail)->send(new NewContactSubmission($contactForm));
    }

    /**
     * Send notification email about status change.
     *
     * @param ContactForm $contactForm
     * @return void
     */
    private function sendStatusChangeNotification(ContactForm $contactForm)
    {
        // Only send status updates for non-spam submissions
        if ($contactForm->status !== 'spam' && $contactForm->email) {
            Mail::to($contactForm->email)->send(new ContactFormStatusChange($contactForm));
        }
    }
} 