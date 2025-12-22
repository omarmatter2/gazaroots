<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name_en' => 'Um Ahmad',
                'name_ar' => 'أم أحمد',
                'content_en' => 'The water well built in our neighborhood has changed our lives. My children no longer have to walk for hours to find clean water. Thank you to everyone who made this possible.',
                'content_ar' => 'البئر التي بُنيت في حينا غيرت حياتنا. لم يعد أطفالي مضطرين للمشي لساعات للعثور على مياه نظيفة. شكراً لكل من جعل هذا ممكناً.',
                'order' => 1,
            ],
            [
                'name_en' => 'Abu Mohammed',
                'name_ar' => 'أبو محمد',
                'content_en' => 'When we lost our home, we thought we had lost everything. But the support we received gave us hope. The food packages and blankets helped us survive the difficult nights.',
                'content_ar' => 'عندما فقدنا منزلنا، اعتقدنا أننا فقدنا كل شيء. لكن الدعم الذي تلقيناه أعطانا الأمل. حزم الطعام والبطانيات ساعدتنا على النجاة من الليالي الصعبة.',
                'order' => 2,
            ],
            [
                'name_en' => 'Fatima',
                'name_ar' => 'فاطمة',
                'content_en' => 'My daughter needed urgent medical care. Thanks to the medical aid program, she received the treatment she needed. Today she is healthy and back to playing with her friends.',
                'content_ar' => 'ابنتي كانت بحاجة لرعاية طبية عاجلة. بفضل برنامج المساعدة الطبية، تلقت العلاج الذي احتاجته. اليوم هي بصحة جيدة وعادت للعب مع أصدقائها.',
                'order' => 3,
            ],
            [
                'name_en' => 'Teacher Mahmoud',
                'name_ar' => 'المعلم محمود',
                'content_en' => 'The educational supplies helped us continue teaching the children. Education is hope for our future. Every pencil, every notebook is a step towards a better tomorrow.',
                'content_ar' => 'المستلزمات التعليمية ساعدتنا على مواصلة تعليم الأطفال. التعليم هو أمل مستقبلنا. كل قلم رصاص، كل دفتر هو خطوة نحو غد أفضل.',
                'order' => 4,
            ],
            [
                'name_en' => 'Khalil',
                'name_ar' => 'خليل',
                'content_en' => 'The community kitchen feeds my family every day. Without this support, I do not know how we would have survived. May God bless all the donors.',
                'content_ar' => 'مطبخ المجتمع يطعم عائلتي كل يوم. بدون هذا الدعم، لا أعرف كيف كنا سننجو. بارك الله في جميع المتبرعين.',
                'order' => 5,
            ],
            [
                'name_en' => 'Sara',
                'name_ar' => 'سارة',
                'content_en' => 'As a nurse, I have seen firsthand how medical supplies save lives. Every donation matters. Every act of kindness makes a difference.',
                'content_ar' => 'كممرضة، رأيت بنفسي كيف تنقذ الإمدادات الطبية الأرواح. كل تبرع مهم. كل عمل لطف يحدث فرقاً.',
                'order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            $testimonial = new Testimonial();
            $testimonial->setTranslations('name', [
                'en' => $testimonialData['name_en'],
                'ar' => $testimonialData['name_ar'],
            ]);
            $testimonial->setTranslations('content', [
                'en' => $testimonialData['content_en'],
                'ar' => $testimonialData['content_ar'],
            ]);
            $testimonial->is_active = true;
            $testimonial->order = $testimonialData['order'];
            $testimonial->save();
        }
    }
}

