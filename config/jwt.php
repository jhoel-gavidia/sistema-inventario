<?php

return [
    'secret' => env('JWT_SECRET'),
    'ttl' => (int) env('JWT_TTL', 60),
    'algorithm' => 'HS256',
];
