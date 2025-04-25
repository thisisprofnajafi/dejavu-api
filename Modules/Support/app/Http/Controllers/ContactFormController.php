<?php

namespace Modules\Support\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Support\app\Http\Requests\StoreContactFormRequest;
use Modules\Support\app\Services\ContactFormService;
use Modules\Support\app\Models\ContactForm;

class ContactFormController extends Controller
{
    protected $contactFormService;

    public function __construct(ContactFormService $contactFormService)
    {
        $this->contactFormService = $contactFormService;
        // Only admins can view all contact form submissions
        $this->middleware('auth:sanctum')->only(['index', 'show', 'update', 'destroy']);
        $this->middleware('role:admin')->only(['index', 'show', 'update', 'destroy']);
    }

    /**
     * Display a listing of contact form submissions.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $status = $request->input('status');
        $search = $request->input('search');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
        $submissions = $this->contactFormService->getContactForms(
            $perPage,
            $status,
            $search,
            $fromDate,
            $toDate
        );
        
        return response()->json([
            'success' => true,
            'data' => $submissions
        ]);
    }

    /**
     * Store a newly created contact form submission.
     *
     * @param StoreContactFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactFormRequest $request)
    {
        try {
            $userId = Auth::check() ? Auth::id() : null;
            $submission = $this->contactFormService->createContactForm(
                $request->validated(),
                $userId,
                $request->ip()
            );
            
            return response()->json([
                'success' => true,
                'message' => 'فرم تماس با موفقیت ارسال شد',
                'data' => $submission
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در ارسال فرم تماس: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified contact form submission.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $submission = $this->contactFormService->getContactForm($id);
            
            return response()->json([
                'success' => true,
                'data' => $submission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'ارسال فرم تماس یافت نشد'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the status of a contact form submission.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,in_progress,resolved,spam'
        ]);
        
        try {
            $submission = $this->contactFormService->updateContactFormStatus(
                $id,
                $request->status,
                $request->input('notes')
            );
            
            return response()->json([
                'success' => true,
                'message' => 'وضعیت فرم تماس با موفقیت به‌روزرسانی شد',
                'data' => $submission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در به‌روزرسانی وضعیت فرم تماس: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified contact form submission.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->contactFormService->deleteContactForm($id);
            
            return response()->json([
                'success' => true,
                'message' => 'ارسال فرم تماس با موفقیت حذف شد'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در حذف ارسال فرم تماس: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    /**
     * Get contact form submission statistics.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        try {
            $stats = $this->contactFormService->getContactFormStats();
            
            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت آمار فرم تماس: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
} 