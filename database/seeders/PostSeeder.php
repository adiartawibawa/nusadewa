<?php

namespace Database\Seeders;

use App\Enums\PostType;
use App\Models\Post;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        if (Tag::count() === 0 || Topic::count() === 0 || ProductCategory::count() === 0) {
            $this->call([
                TagSeeder::class,
                TopicSeeder::class,
                ProductCategorySeeder::class,
            ]);
        }

        $faker = Factory::create();
        $users = User::pluck('id')->toArray();
        $tags = Tag::all();
        $topics = Topic::all();
        $productCategories = ProductCategory::all();

        // Disable mass assignment protection temporarily
        Post::unguard();

        // Generate 50 posts total
        $posts = [];

        // 1. Generate 5 product posts
        for ($i = 1; $i <= 8; $i++) {
            $post = $this->createPost(
                $faker,
                $users,
                PostType::PRODUCT,
                $i <= 3 // Make first 3 featured
            );

            // Save to get ID first
            $postModel = Post::create($post);

            // Attach relationships
            $this->attachRelationships($postModel, $tags, $topics, $productCategories);
        }

        // 2. Generate 4 technology posts
        for ($i = 1; $i <= 8; $i++) {
            $post = $this->createPost(
                $faker,
                $users,
                PostType::TECHNOLOGY,
                $i <= 3 // Make first 3 featured
            );
            $posts[] = $post;

            $postModel = Post::create($post);
            $this->attachRelationships($postModel, $tags, $topics);
        }

        // 3. Generate remaining 41 posts with other types
        $otherTypes = [PostType::ARTICLE, PostType::NEWS, PostType::INNOVATION, PostType::PAGE];
        for ($i = 1; $i <= 100; $i++) {
            $type = Arr::random($otherTypes);
            $post = $this->createPost(
                $faker,
                $users,
                $type,
                $i <= 25 // Make first 25 featured
            );
            $posts[] = $post;

            $postModel = Post::create($post);
            $this->attachRelationships($postModel, $tags, $topics);
        }

        // Re-enable mass assignment protection
        Post::reguard();
    }

    private function createPost(
        $faker,
        array $users,
        PostType $type,
        bool $isFeatured = false
    ): array {
        // English content
        $titleEn = $faker->sentence(4);
        $summaryEn = $faker->paragraph(2);
        $bodyEn = $this->generateEnglishBody($faker);

        // Indonesian content
        $titleId = $this->generateIndonesianTitle($faker);
        $summaryId = $this->generateIndonesianSummary($faker);
        $bodyId = $this->generateIndonesianBody();

        $publishedAt = $faker->boolean(80)
            ? $faker->dateTimeBetween('-1 year', 'now')
            : null;

        return [
            'id' => Str::uuid(),
            'slug' => Str::slug($titleEn),
            'type' => $type->value,
            'is_featured' => $isFeatured,
            'title' => ['en' => $titleEn, 'id' => $titleId],
            'summary' => ['en' => $summaryEn, 'id' => $summaryId],
            'body' => ['en' => $bodyEn, 'id' => $bodyId],
            'published_at' => $publishedAt,
            'featured_image' => null,
            'featured_image_caption' => $faker->sentence(),
            'user_id' => Arr::random($users),
            'indexable' => $faker->boolean(90),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    private function generateEnglishBody($faker): string
    {
        $sections = [
            '<h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. ' . $faker->paragraph(5) . '</p>',
            '<h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ' . $faker->paragraph(6) . '</p>',
            '<h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. ' . $faker->paragraph(7) . '</p>',
            '<h2>Where can I get some?</h2><p>There are many variations of passages of Lorem Ipsum available. ' . $faker->paragraph(4) . '</p>'
        ];

        return implode('', $sections);
    }

    private function generateIndonesianTitle($faker): string
    {
        $templates = [
            'Solusi inovatif untuk ' . $faker->word,
            'Panduan lengkap tentang ' . $faker->word,
            'Teknologi terbaru di bidang ' . $faker->word,
            'Mengoptimalkan ' . $faker->word . ' dengan cara efektif',
            'Strategi ' . $faker->word . ' yang revolusioner'
        ];

        return Arr::random($templates);
    }

    private function generateIndonesianSummary($faker): string
    {
        $intro = "Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. ";
        $content = "Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. ";

        return $intro . $content . $faker->sentence();
    }

    private function generateIndonesianBody(): string
    {
        return '<h2>Apakah Lorem Ipsum itu?</h2><p><strong>Lorem Ipsum</strong> adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p><h2>Mengapa kita menggunakannya?</h2><p>Sudah merupakan fakta bahwa seorang pembaca akan terpengaruh oleh isi tulisan dari sebuah halaman saat ia melihat tata letaknya. Maksud penggunaan Lorem Ipsum adalah karena ia kurang lebih memiliki penyebaran huruf yang normal, ketimbang menggunakan kalimat seperti "Bagian isi disini, bagian isi disini", sehingga ia seolah menjadi naskah Inggris yang bisa dibaca. Banyak paket Desktop Publishing dan editor situs web yang kini menggunakan Lorem Ipsum sebagai contoh teks. Karenanya pencarian terhadap kalimat "Lorem Ipsum" akan berujung pada banyak situs web yang masih dalam tahap pengembangan. Berbagai versi juga telah berubah dari tahun ke tahun, kadang karena tidak sengaja, kadang karena disengaja (misalnya karena dimasukkan unsur humor atau semacamnya)</p><h2>Dari mana asalnya?</h2><p>Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah "de Finibus Bonorum et Malorum" (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, "Lorem ipsum dolor sit amet..", berasal dari sebuah baris di bagian 1.10.32.</p><h2>Dari mana saya bisa mendapatkannya?</h2><p>Ada banyak variasi tulisan Lorem Ipsum yang tersedia, tapi kebanyakan sudah mengalami perubahan bentuk, entah karena unsur humor atau kalimat yang diacak hingga nampak sangat tidak masuk akal. Jika anda ingin menggunakan tulisan Lorem Ipsum, anda harus yakin tidak ada bagian yang memalukan yang tersembunyi di tengah naskah tersebut. Semua generator Lorem Ipsum di internet cenderung untuk mengulang bagian-bagian tertentu. Karena itu inilah generator pertama yang sebenarnya di internet. Ia menggunakan kamus perbendaharaan yang terdiri dari 200 kata Latin, yang digabung dengan banyak contoh struktur kalimat untuk menghasilkan Lorem Ipsun yang nampak masuk akal. Karena itu Lorem Ipsun yang dihasilkan akan selalu bebas dari pengulangan, unsur humor yang sengaja dimasukkan, kata yang tidak sesuai dengan karakteristiknya dan lain sebagainya.</p>';
    }

    private function getRandomFeaturedImage(): string
    {
        $images = [
            'posts/image1.jpg',
            'posts/image2.jpg',
            'posts/image3.jpg',
            'posts/image4.jpg',
            'posts/image5.jpg',
        ];

        return Arr::random($images);
    }

    private function attachRelationships(
        Post $post,
        $tags,
        $topics,
        $productCategories = null
    ) {
        // Attach 1-3 random tags
        $post->tags()->attach(
            $tags->random(rand(1, 3))->pluck('id')
        );

        // Attach 1-2 random topics
        $post->topics()->attach(
            $topics->random(rand(1, 2))->pluck('id')
        );

        // For product posts only, attach 1-2 product categories
        if ($post->type === PostType::PRODUCT->value && $productCategories) {
            $post->productCategories()->attach(
                $productCategories->random(rand(1, 2))->pluck('id'),
                ['order' => rand(1, 10)]
            );
        }
    }
}
