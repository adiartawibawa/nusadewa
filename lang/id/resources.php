<?php

return [
    'resources' => [
        'posts' => [
            'label' => 'Posting',
            'single' => 'Posting',
            'plural' => 'Semua Posting',
            'navigation' => [
                'label' => 'Manajemen Posting',
                'icon' => 'heroicon-o-document-text',
            ],
            'fields' => [
                'title' => 'Judul',
                'slug' => 'Slug',
                'language' => 'Bahasa',
                'type' => 'Tipe',
                'summary' => 'Ringkasan',
                'body' => 'Konten',
                'published_at' => 'Tanggal Publikasi',
                'featured_image' => 'Gambar Unggulan',
                'featured_image_caption' => 'Keterangan Gambar',
                'is_featured' => 'Posting Unggulan',
                'is_landing_page' => 'Halaman Landing',
                'indexable' => 'Dapat Diindeks',
                'user_id' => 'Penulis',
                'tags' => 'Tag',
                'topics' => 'Topik',
                'product_categories' => 'Kategori Produk',
                'translation_group_id' => 'Grup Terjemahan',
            ],
            'types' => [
                'article' => 'Artikel',
                'news' => 'Berita',
                'page' => 'Halaman',
                'landing' => 'Halaman Landing',
            ],
        ],
    ],
];
