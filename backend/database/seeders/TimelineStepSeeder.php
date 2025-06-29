<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TimelineStep;

class TimelineStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $steps = [
            [
                'title_ar' => 'مرحلة استقبال الطلبات',
                'title_en' => 'Application Submission Phase',
                'subtitle_ar' => 'يبدأ المشاركون بالتقديم من خلال رفع سيرهم الذاتية.',
                'subtitle_en' => 'Participants begin by submitting their CVs.',
                'description_ar' => '',
                'description_en' => '',
                'step_date' => '2025-06-29',
                'order' => 1,
                'is_active' => true
            ],
            [
                'title_ar' => 'مرحلة التصفيات الأولى',
                'title_en' => 'First Qualifying Round',
                'subtitle_ar' => 'يتم تقييم جميع المشاركات، وتأهيل 3 فرق لكل مسار للانتقال إلى الجولة الثانية.',
                'subtitle_en' => 'All submissions are evaluated, and 12 teams from each track are qualified to move to the second round.',
                'description_ar' => '',
                'description_en' => '',
                'step_date' => '2025-07-13',
                'order' => 2,
                'is_active' => true
            ],
            [
                'title_ar' => 'مرحلة ورش العمل والعروض التقديمية',
                'title_en' => 'Workshops and Presentations Phase',
                'subtitle_ar' => 'يحضر الفرق المؤهلة 3 ورش عمل متخصصة لمساعدتهم في تطوير أفكارهم، يليها إعداد عرض تقديمي مفصل عن الحلول المقترحة.',
                'subtitle_en' => 'Qualified teams attend 3 specialized workshops to help develop their ideas, followed by preparing a detailed presentation about their proposed solutions.',
                'description_ar' => '',
                'description_en' => '',
                'step_date' => '2025-07-20',
                'order' => 3,
                'is_active' => true
            ],
            [
                'title_ar' => 'مرحلة التصفيات الثانية',
                'title_en' => 'Second Qualifying Round',
                'subtitle_ar' => 'بعد تقديم العروض، يتم اختيار أفضل 5 فرق من كل مسار للتأهل إلى المرحلة النهائية.',
                'subtitle_en' => 'After presentations, the top 5 teams from each track are selected to qualify for the final stage.',
                'description_ar' => '',
                'description_en' => '',
                'step_date' => '2025-08-10',
                'order' => 4,
                'is_active' => true
            ],
            [
                'title_ar' => 'مرحلة تطوير النماذج الأولية والعرض النهائي',
                'title_en' => 'Prototype Development and Final Presentation Phase',
                'subtitle_ar' => 'المرحلة النهائية لتطوير النماذج الأولية وتقديم العروض النهائية.',
                'subtitle_en' => 'Final stage for prototype development and final presentations.',
                'description_ar' => '',
                'description_en' => '',
                'step_date' => '2025-08-13',
                'order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($steps as $step) {
            TimelineStep::create($step);
        }
    }
}
