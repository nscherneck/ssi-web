<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Image Paths and Settings
    |--------------------------------------------------------------------------
    |
    |
    | We set the config here so that we can keep our controllers clean.
    | Configure each image type with an image path.
    |
    */

        'systemImage' => [

            'destinationFolder'     => '/customer-data/system_photos',
            'destinationThumbnail'  => '/customer-data/system_photos/thumbnails/',
            'thumbPrefix'           => 'thumb-',
            'imagePath'             => '/customer-data/system_photos/',
            'thumbnailPath'         => '/customer-data/system_photos/thumbnails/thumb-',
            'thumbHeight'           => 300,
            'thumbWidth'            => 300,

        ],


];
