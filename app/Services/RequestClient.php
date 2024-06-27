<?php declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Psr7\Request;
use JsonException;

final readonly class RequestClient
{
    const API_TOKEN = '';
    private mixed $response;

    public function __construct(private RequestClientPayload $request){}

    /**
     * @return $this
     * @throws JsonException
     */
    public function send(): RequestClient
    {
        $body = json_encode($this->request->payload, JSON_THROW_ON_ERROR);
        $request = new Request(
            method: $this->request->method,
            uri: $this->request->url,
            headers: $this->request->headers ?? $this->httpHeader(),
            body: $body );
        $this->response = $this->request->client->sendAsync($request)->wait()->getBody()->getContents();
        return $this;
    }

    /**
     * @return mixed
     */
    public function response(): mixed
    {
        return $this->response;
    }

    /**
     * @return string[]
     */
    protected function httpHeader(): array
    {
        return [
            "Content-Type" => "application/json",
            "Accept: application/json",
            "Authorization" => self::API_TOKEN
        ];
    }

}

