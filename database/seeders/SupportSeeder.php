<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Support\Models\Department;
use Modules\Support\Models\DepartmentUser;
use Modules\Support\Models\FaqCategory;
use Modules\Support\Models\Faq;
use Modules\Support\Models\Ticket;
use Modules\Support\Models\TicketResponse;
use App\Models\User;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create support departments
        $departments = [
            [
                'name' => 'Technical Support',
                'description' => 'Help with technical issues and platform functionality',
                'email' => 'tech@example.com',
                'status' => 'active',
            ],
            [
                'name' => 'Billing',
                'description' => 'Help with payment, subscription and billing issues',
                'email' => 'billing@example.com',
                'status' => 'active',
            ],
            [
                'name' => 'Content',
                'description' => 'Assistance with content creation and publishing',
                'email' => 'content@example.com',
                'status' => 'active',
            ],
            [
                'name' => 'General Inquiries',
                'description' => 'General questions and information',
                'email' => 'info@example.com',
                'status' => 'active',
            ],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(['name' => $department['name']], $department);
        }

        // Assign admin to all departments
        $admin = User::where('email', 'admin@example.com')->first();
        $allDepartments = Department::all();
        
        foreach ($allDepartments as $department) {
            DepartmentUser::firstOrCreate(
                ['department_id' => $department->id, 'user_id' => $admin->id],
                ['is_manager' => true]
            );
        }

        // Create FAQ categories
        $faqCategories = [
            [
                'name' => 'Account & Security',
                'description' => 'Questions about account management and security',
                'order' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Billing & Payments',
                'description' => 'Questions about billing, payments and subscriptions',
                'order' => 2,
                'status' => 'active',
            ],
            [
                'name' => 'Content Management',
                'description' => 'Questions about creating and managing content',
                'order' => 3,
                'status' => 'active',
            ],
            [
                'name' => 'Platform Features',
                'description' => 'Questions about platform features and functionality',
                'order' => 4,
                'status' => 'active',
            ],
        ];

        foreach ($faqCategories as $category) {
            FaqCategory::firstOrCreate(['name' => $category['name']], $category);
        }

        // Create FAQs
        $faqs = [
            [
                'question' => 'How do I reset my password?',
                'answer' => 'To reset your password, click on the "Forgot Password" link on the login page. Enter your email address and follow the instructions sent to your email.',
                'faq_category_id' => 1, // Account & Security
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'How can I change my email address?',
                'answer' => 'You can change your email address in your account settings. Go to "My Account" > "Profile" and update your email address.',
                'faq_category_id' => 1, // Account & Security
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept credit/debit cards (Visa, MasterCard, American Express), PayPal, and bank transfers for certain plans.',
                'faq_category_id' => 2, // Billing & Payments
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'How do I cancel my subscription?',
                'answer' => 'To cancel your subscription, go to "My Account" > "Billing" and click on "Cancel Subscription". Follow the prompts to complete the cancellation.',
                'faq_category_id' => 2, // Billing & Payments
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'How do I create a new post?',
                'answer' => 'To create a new post, go to "Content" > "Posts" and click on "Create New Post". Fill in the required fields and click "Publish" when ready.',
                'faq_category_id' => 3, // Content Management
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'Can I schedule posts for future publication?',
                'answer' => 'Yes, you can schedule posts for future publication. When creating or editing a post, set the publication date and time in the "Schedule" section.',
                'faq_category_id' => 3, // Content Management
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'How do I earn commission as a visitor?',
                'answer' => 'As a visitor, you earn commission when people visit content through your referral links. Your unique referral code is available in your dashboard.',
                'faq_category_id' => 4, // Platform Features
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'What analytics are available for my content?',
                'answer' => 'We provide comprehensive analytics including page views, unique visitors, engagement metrics, and conversion rates. Access these through your dashboard.',
                'faq_category_id' => 4, // Platform Features
                'order' => 2,
                'status' => 'active',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], $faq);
        }

        // Create sample tickets
        $users = User::all();
        $departments = Department::all();
        $statuses = ['open', 'in_progress', 'resolved', 'closed'];
        $priorities = ['low', 'medium', 'high', 'urgent'];
        
        for ($i = 1; $i <= 10; $i++) {
            $user = $users->random();
            $department = $departments->random();
            $status = $statuses[array_rand($statuses)];
            $priority = $priorities[array_rand($priorities)];
            
            $ticket = Ticket::create([
                'subject' => "Sample Ticket #{$i}: " . fake()->sentence(),
                'content' => fake()->paragraphs(3, true),
                'user_id' => $user->id,
                'department_id' => $department->id,
                'ticket_number' => 'TKT-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'status' => $status,
                'priority' => $priority,
                'created_at' => now()->subDays(rand(1, 30)),
            ]);
            
            // Add a response for tickets that are not 'open'
            if ($status !== 'open') {
                TicketResponse::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $admin->id, // Admin responds
                    'content' => "Thank you for your inquiry. " . fake()->paragraph(),
                    'is_private' => false,
                    'created_at' => $ticket->created_at->addHours(rand(1, 24)),
                ]);
            }
        }
    }
} 