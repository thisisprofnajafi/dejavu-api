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
                'name' => 'پشتیبانی فنی',
                'description' => 'کمک با مشکلات فنی و عملکرد پلتفرم',
                'email' => 'tech@example.com',
                'status' => 'active',
            ],
            [
                'name' => 'صورتحساب',
                'description' => 'کمک با پرداخت، اشتراک و مسائل صورتحساب',
                'email' => 'billing@example.com',
                'status' => 'active',
            ],
            [
                'name' => 'محتوا',
                'description' => 'کمک با ایجاد و مدیریت محتوا',
                'email' => 'content@example.com',
                'status' => 'active',
            ],
            [
                'name' => 'سوالات عمومی',
                'description' => 'سوالات عمومی و اطلاعات',
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
                'name' => 'حساب کاربری و امنیت',
                'description' => 'سؤالات مربوط به مدیریت حساب کاربری و امنیت',
                'order' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'صورتحساب و پرداخت‌ها',
                'description' => 'سؤالات مربوط به صورتحساب، پرداخت‌ها و اشتراک‌ها',
                'order' => 2,
                'status' => 'active',
            ],
            [
                'name' => 'مدیریت محتوا',
                'description' => 'سؤالات مربوط به ایجاد و مدیریت محتوا',
                'order' => 3,
                'status' => 'active',
            ],
            [
                'name' => 'ویژگی‌های پلتفرم',
                'description' => 'سؤالات مربوط به ویژگی‌ها و عملکرد پلتفرم',
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
                'question' => 'چگونه رمز عبور خود را بازنشانی کنم؟',
                'answer' => 'برای بازنشانی رمز عبور، روی لینک «فراموشی رمز عبور» در صفحه ورود کلیک کنید. ایمیل خود را وارد کنید و دستورالعمل‌های ارسال شده به ایمیل خود را دنبال کنید.',
                'faq_category_id' => 1, // Account & Security
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'چگونه می‌توانم آدرس ایمیل خود را تغییر دهم؟',
                'answer' => 'شما می‌توانید آدرس ایمیل خود را در تنظیمات حساب کاربری تغییر دهید. به «حساب من» > «نمایه» بروید و آدرس ایمیل خود را به‌روز کنید.',
                'faq_category_id' => 1, // Account & Security
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'چه روش‌های پرداختی را می‌پذیرید؟',
                'answer' => 'ما کارت‌های اعتباری/بدهی (ویزا، مسترکارت، امریکن اکسپرس)، پی‌پال و انتقال بانکی برای برخی از طرح‌ها را می‌پذیریم.',
                'faq_category_id' => 2, // Billing & Payments
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'چگونه اشتراک خود را لغو کنم؟',
                'answer' => 'برای لغو اشتراک خود، به «حساب من» > «صورتحساب» بروید و روی «لغو اشتراک» کلیک کنید. دستورالعمل‌ها را برای تکمیل لغو دنبال کنید.',
                'faq_category_id' => 2, // Billing & Payments
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'چگونه یک پست جدید ایجاد کنم؟',
                'answer' => 'برای ایجاد یک پست جدید، به «محتوا» > «پست‌ها» بروید و روی «ایجاد پست جدید» کلیک کنید. فیلدهای مورد نیاز را پر کنید و هنگامی که آماده شد روی «انتشار» کلیک کنید.',
                'faq_category_id' => 3, // Content Management
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'آیا می‌توانم پست‌ها را برای انتشار در آینده زمان‌بندی کنم؟',
                'answer' => 'بله، می‌توانید پست‌ها را برای انتشار در آینده زمان‌بندی کنید. هنگام ایجاد یا ویرایش یک پست، تاریخ و زمان انتشار را در بخش «زمان‌بندی» تنظیم کنید.',
                'faq_category_id' => 3, // Content Management
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'چگونه به عنوان بازدیدکننده کمیسیون کسب کنم؟',
                'answer' => 'به عنوان بازدیدکننده، زمانی که افراد از طریق لینک‌های ارجاع شما از محتوا بازدید می‌کنند، کمیسیون کسب می‌کنید. کد ارجاع منحصر به فرد شما در داشبورد شما موجود است.',
                'faq_category_id' => 4, // Platform Features
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'چه تحلیل‌هایی برای محتوای من در دسترس است؟',
                'answer' => 'ما تحلیل‌های جامعی شامل بازدیدهای صفحه، بازدیدکنندگان منحصر به فرد، معیارهای مشارکت و نرخ‌های تبدیل ارائه می‌دهیم. به این موارد از طریق داشبورد خود دسترسی پیدا کنید.',
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
                'subject' => "تیکت نمونه #{$i}: " . fake()->sentence(),
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
                    'content' => "با تشکر از استعلام شما. " . fake()->paragraph(),
                    'is_private' => false,
                    'created_at' => $ticket->created_at->addHours(rand(1, 24)),
                ]);
            }
        }
    }
} 