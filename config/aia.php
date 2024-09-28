<?php

return [
    'base_url' => env('AIA_URL'),
    'token' => env('AIA_TOKEN'),
    'image_callback_url' => env('AIA_IMAGE_CALLBACK_URL'),
    'face_image_callback_url' => env('AIA_FACE_IMAGE_CALLBACK_URL'),
    'profile_image_callback_url' => env('AIA_PROFILE_IMAGE_CALLBACK_URL'),
    'ignore_ssl' => env('AIA_IGNORE_SSL', false),
];
