<?php declare(strict_types=1);

namespace App\Services;

interface RequestInterface
{
    const GET_REQUEST = 'GET';

    const REQUEST_HEADERS = [
        'Content-Type' => 'application/json',
        'Accept: application',
    ];

    const VERIFY_REQUEST = [
        'verify' => true,
    ];

}
