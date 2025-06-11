<?php

return [
    'resources' => [
        'posts' => [
            'label' => 'Posts',
            'single' => 'Post',
            'plural' => 'Posts',
            'navigation' => [
                'label' => 'Posts Management',
                'icon' => 'heroicon-o-document-text',
            ],
            'fields' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'language' => 'Language',
                'type' => 'Type',
                'summary' => 'Summary',
                'body' => 'Content',
                'published_at' => 'Publish Date',
                'featured_image' => 'Featured Image',
                'featured_image_caption' => 'Image Caption',
                'is_featured' => 'Featured Post',
                'is_landing_page' => 'Landing Page',
                'indexable' => 'Indexable',
                'user_id' => 'Author',
                'tags' => 'Tags',
                'topics' => 'Topics',
                'product_categories' => 'Product Categories',
                'translation_group_id' => 'Translation Group',
            ],
            'types' => [
                'article' => 'Article',
                'news' => 'News',
                'page' => 'Page',
                'landing' => 'Landing Page',
            ],
        ],
    ],
];
