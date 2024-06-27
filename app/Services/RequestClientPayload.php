<?php declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;

final readonly class RequestClientPayload
{
    public function __construct(
        public array $payload,
        public string $method,
        public string $url,
        public Client $client,
        public array $headers,
        public null|string $token = null,
    ){}


}
