<?php

declare(strict_types=1);

return [
    'client_id' => env('SHOPWARE_CLIENT_ID','id'),
    'client_secret' => env('SHOPWARE_CLIENT_SECRET', 'secret'),
    'url' => env('SHOPWARE_API', 'http://shopware.com'),
];