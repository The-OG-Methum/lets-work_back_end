<?php

return [

    'paths' => ['api/*', 'login', 'logout', 'register'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:3000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => ['Authorization'], // Optional: expose token if needed

    'max_age' => 0,

    'supports_credentials' => false, //  No cookies/sessions, so this is false
];
