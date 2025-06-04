<?php

return [
    'allowed_extensions' => explode(',', env('UPLOAD_ALLOWED_EXTENSIONS', 'jpg,jpeg,png,pdf')),
    'max_size' => env('UPLOAD_MAX_SIZE', 2048),
];
