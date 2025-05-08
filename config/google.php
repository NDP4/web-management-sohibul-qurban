<?php

return [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'service_account_credentials' => [
        'type' => 'service_account',
        'project_id' => env('GOOGLE_PROJECT_ID'),
        'private_key_id' => env('GOOGLE_PRIVATE_KEY_ID'),
        'private_key' => env('GOOGLE_PRIVATE_KEY'),
        'client_email' => env('GOOGLE_CLIENT_EMAIL'),
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'auth_uri' => env('GOOGLE_AUTH_URI', 'https://accounts.google.com/o/oauth2/auth'),
        'token_uri' => env('GOOGLE_TOKEN_URI', 'https://oauth2.googleapis.com/token'),
        'auth_provider_x509_cert_url' => env('GOOGLE_AUTH_PROVIDER_CERT_URL', 'https://www.googleapis.com/oauth2/v1/certs'),
        'client_x509_cert_url' => env('GOOGLE_CLIENT_CERT_URL'),
        'universe_domain' => env('GOOGLE_UNIVERSE_DOMAIN', 'googleapis.com')
    ],
    'folder_id' => env('GOOGLE_DRIVE_FOLDER_ID'),
];
