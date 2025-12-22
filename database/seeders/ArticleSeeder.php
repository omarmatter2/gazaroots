<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $authors = Author::all();

        $articles = [
            [
                'title_en' => 'Clean Water Brings Hope to Gaza Families',
                'title_ar' => 'المياه النظيفة تجلب الأمل لعائلات غزة',
                'excerpt_en' => 'New water wells are providing clean drinking water to thousands of families in Gaza City.',
                'excerpt_ar' => 'الآبار الجديدة توفر مياه الشرب النظيفة لآلاف العائلات في مدينة غزة.',
                'content_en' => 'In the heart of Gaza City, a new water well has become a beacon of hope for over 500 families. The project, funded by international donors, provides clean drinking water to a community that has struggled with water scarcity for years. Local residents gather daily at the well, filling containers with life-saving water. "This well has changed our lives," says Um Ahmad, a mother of five. "Before, we had to walk kilometers to find clean water."',
                'content_ar' => 'في قلب مدينة غزة، أصبحت بئر مياه جديدة منارة أمل لأكثر من 500 عائلة. المشروع، الممول من متبرعين دوليين، يوفر مياه الشرب النظيفة لمجتمع عانى من ندرة المياه لسنوات. يتجمع السكان المحليون يومياً عند البئر، يملأون الحاويات بالمياه المنقذة للحياة. "هذه البئر غيرت حياتنا"، تقول أم أحمد، أم لخمسة أطفال. "قبل ذلك، كنا نضطر للمشي كيلومترات للعثور على مياه نظيفة."',
                'is_featured' => true,
                'is_urgent' => false,
            ],
            [
                'title_en' => 'Children Continue Education Despite Challenges',
                'title_ar' => 'الأطفال يواصلون التعليم رغم التحديات',
                'excerpt_en' => 'Despite destroyed schools, Gaza children find ways to continue their education.',
                'excerpt_ar' => 'رغم تدمير المدارس، يجد أطفال غزة طرقاً لمواصلة تعليمهم.',
                'content_en' => 'In makeshift classrooms across Gaza, children gather to learn. Teachers volunteer their time, using whatever materials they can find. The determination of these young students is inspiring, as they refuse to let circumstances define their future.',
                'content_ar' => 'في فصول دراسية مؤقتة في جميع أنحاء غزة، يتجمع الأطفال للتعلم. يتطوع المعلمون بوقتهم، مستخدمين أي مواد يمكنهم العثور عليها. إصرار هؤلاء الطلاب الصغار ملهم، حيث يرفضون السماح للظروف بتحديد مستقبلهم.',
                'is_featured' => true,
                'is_urgent' => false,
            ],
            [
                'title_en' => 'Medical Teams Work Around the Clock',
                'title_ar' => 'الفرق الطبية تعمل على مدار الساعة',
                'excerpt_en' => 'Healthcare workers in Gaza hospitals continue to save lives despite limited resources.',
                'excerpt_ar' => 'العاملون في الرعاية الصحية في مستشفيات غزة يواصلون إنقاذ الأرواح رغم الموارد المحدودة.',
                'content_en' => 'Dr. Mahmoud works 18-hour shifts at Al-Shifa Hospital. With limited supplies and constant power outages, he and his team perform life-saving surgeries. "We do what we must to save lives," he says.',
                'content_ar' => 'الدكتور محمود يعمل نوبات من 18 ساعة في مستشفى الشفاء. مع الإمدادات المحدودة وانقطاع التيار الكهربائي المستمر، يقوم هو وفريقه بإجراء عمليات جراحية منقذة للحياة. "نفعل ما يجب لإنقاذ الأرواح"، يقول.',
                'is_featured' => false,
                'is_urgent' => true,
            ],
            [
                'title_en' => 'Community Kitchen Feeds Hundreds Daily',
                'title_ar' => 'مطبخ المجتمع يطعم المئات يومياً',
                'excerpt_en' => 'Volunteers run community kitchens to feed displaced families in Gaza.',
                'excerpt_ar' => 'متطوعون يديرون مطابخ مجتمعية لإطعام العائلات النازحة في غزة.',
                'content_en' => 'Every morning, volunteers arrive before dawn to prepare meals for hundreds of displaced families. The community kitchen has become a lifeline for those who have lost everything.',
                'content_ar' => 'كل صباح، يصل المتطوعون قبل الفجر لإعداد وجبات لمئات العائلات النازحة. أصبح مطبخ المجتمع شريان حياة لأولئك الذين فقدوا كل شيء.',
                'is_featured' => false,
                'is_urgent' => false,
            ],
            [
                'title_en' => 'Emergency Aid Reaches Northern Gaza',
                'title_ar' => 'المساعدات الطارئة تصل شمال غزة',
                'excerpt_en' => 'First aid convoy in weeks reaches families in northern Gaza Strip.',
                'excerpt_ar' => 'أول قافلة مساعدات منذ أسابيع تصل للعائلات في شمال قطاع غزة.',
                'content_en' => 'After weeks of waiting, humanitarian aid has finally reached the northern areas of Gaza. Families lined up for hours to receive food packages, water, and medical supplies.',
                'content_ar' => 'بعد أسابيع من الانتظار، وصلت المساعدات الإنسانية أخيراً إلى المناطق الشمالية من غزة. وقفت العائلات في طوابير لساعات لتلقي حزم الطعام والمياه والإمدادات الطبية.',
                'is_featured' => false,
                'is_urgent' => true,
            ],
            [
                'title_en' => 'Young Artist Documents Life Through Drawings',
                'title_ar' => 'فنان شاب يوثق الحياة من خلال الرسومات',
                'excerpt_en' => '14-year-old Palestinian artist uses art to express hope and document daily life.',
                'excerpt_ar' => 'فنان فلسطيني يبلغ 14 عاماً يستخدم الفن للتعبير عن الأمل وتوثيق الحياة اليومية.',
                'content_en' => 'Ahmad, 14, has become known in his community for his powerful drawings. Using whatever materials he can find, he creates art that tells the story of his people.',
                'content_ar' => 'أحمد، 14 عاماً، أصبح معروفاً في مجتمعه برسوماته القوية. باستخدام أي مواد يمكنه العثور عليها، يبدع فناً يروي قصة شعبه.',
                'is_featured' => true,
                'is_urgent' => false,
            ],
        ];

        foreach ($articles as $articleData) {
            $article = new Article();
            $article->category_id = $categories->random()->id;
            $article->author_id = $authors->random()->id;
            $article->setTranslations('title', [
                'en' => $articleData['title_en'],
                'ar' => $articleData['title_ar'],
            ]);
            $article->slug = Str::slug($articleData['title_en']);
            $article->setTranslations('excerpt', [
                'en' => $articleData['excerpt_en'],
                'ar' => $articleData['excerpt_ar'],
            ]);
            $article->setTranslations('content', [
                'en' => $articleData['content_en'],
                'ar' => $articleData['content_ar'],
            ]);
            $article->is_featured = $articleData['is_featured'];
            $article->is_urgent = $articleData['is_urgent'];
            $article->is_published = true;
            $article->views = rand(100, 5000);
            $article->published_at = now()->subDays(rand(1, 30));
            $article->save();
        }
    }
}

