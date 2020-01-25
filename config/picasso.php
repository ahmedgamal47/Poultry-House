<?php

return [
    'dimensions' => [
        'xlarge' => [
            'width' => 1920,
            'height' => 1080
        ],
        'large' => [
            'width' => 1200,
            'height' => 750
        ],
        'medium' => [
            'width' => 600,
            'height' => 500
        ],
        'small' => [
            'width' => 300,
            'height' => 300
        ],
        'xsmall' => [
            'width' => 150,
            'height' => 150
        ],

        // Dot notation example.
        // Usage: frontend.categories.index
        'frontend' => [
            'categories' => [
                'index' => [
                    'width' => 1280,
                    'height' => 720,
                    'format' => 'png'
                ],
                'show' => [
                    'width' => 1920,
                    'height' => 1080,
                    'quality' => 90
                ],
            ]
        ]

        // ...
    ],

    // Use this variable to set the default image quality.
    // 0-100
    'quality' => 60,

    /**
     * The readable image formats depend on the choosen driver (GD or Imagick) and your local configuration.
     * By default Intervention Image currently supports the following major formats.
     *
     * Image Formats:
     * JPEG, PNG, GIF, TIF, BMP, ICO, PSD, WebP*
     *
     * For WebP support GD driver must be used with PHP 5 >= 5.5.0 or PHP 7 in order to use imagewebp().
     * If Imagick is used, it must be compiled with libwebp for WebP support.
     */
    'format' => 'webp'
];