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

        'image' => [

            'destinationFolder'     => '/customer-data/photos',
            'destinationThumbnail'  => '/customer-data/photos/thumbnails/',
            'thumbPrefix'           => 'thumb-',
            'imagePath'             => '/customer-data/photos/',
            'thumbnailPath'         => '/customer-data/photos/thumbnails/thumb-',
            'thumbHeight'           => 100,
            'thumbWidth'            => 100,

        ],


];
