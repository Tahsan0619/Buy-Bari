<?php

return [
    /*
    | Catalog GET endpoints work without credentials.
    | App Key / App Secret / Username are required only for POST place-order.
    | Placeholder values (starting with "paste-your") mean order transfer is not ready yet.
    */
    'base_url' => env('NITTOZ_BASE_URL', 'https://dropshipper.nittoz.com/api/v1/dropshippers'),
    'order_url' => env('NITTOZ_ORDER_URL', 'https://dropshipper.nittoz.com/api/v1/dropshippers/place-order'),
    'app_key' => env('NITTOZ_APP_KEY', 'paste-your-app-key-here'),
    'app_secret' => env('NITTOZ_APP_SECRET', 'paste-your-app-secret-here'),
    'username' => env('NITTOZ_USERNAME', 'paste-your-username-here'),
    'per_page' => (int) env('NITTOZ_PER_PAGE', 100),
];
