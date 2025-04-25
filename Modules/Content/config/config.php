<?php

return [
    'name' => 'Content',
    
    // Default pagination settings
    'pagination' => [
        'per_page' => 10,
    ],
    
    // SEO defaults
    'seo' => [
        'meta_title_max_length' => 60,
        'meta_description_max_length' => 160,
        'keywords_max' => 10,
    ],
    
    // Storage paths for images
    'storage' => [
        'posts' => 'public/posts',
        'categories' => 'public/categories',
    ],
    
    // Validation
    'validation' => [
        'post_title_min' => 5,
        'post_title_max' => 100,
        'post_content_min' => 50,
        'category_title_min' => 3,
        'category_title_max' => 50,
        'tag_min' => 2,
        'tag_max' => 20,
    ],
]; 