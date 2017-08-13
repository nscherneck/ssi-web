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
            'destinationFullSizeImageFolder'        => '/customer-data/system_photos',
            'destinationThumbnailImageFolder'       => '/customer-data/system_photos/thumbnails/',
            'fullSizeImagePath'                     => '/customer-data/system_photos/',
            'thumbnailImagePath'                    => '/customer-data/system_photos/thumbnails/thumb-',
            'thumbnailImagePrefix'                   => 'thumb-',
            'thumbnailImageHeight'                  => 300,
            'thumbnailImageWidth'                   => 300,
        ],

];
