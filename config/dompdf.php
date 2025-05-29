<?php

return [
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => [
        'font_dir' => storage_path('fonts/'),
        'font_cache' => storage_path('fonts/'),
        'temp_dir' => storage_path('app/dompdf/temp/'),
        'chroot' => realpath(base_path()),
        'enable_font_subsetting' => true,
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_font' => 'sans-serif',
        'dpi' => 96,
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => true,
        'font_height_ratio' => 1.1,
    ]
];