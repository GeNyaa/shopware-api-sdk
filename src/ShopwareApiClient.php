<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk;

use Carbon\Carbon;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiAuthenticationException;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use GeNyaa\ShopwareApiSdk\Dto\Header;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Endpoints\ProductEndpoint;

class ShopwareApiClient
{
    public string $domain;
    public ?string $bearer;
    public ?Carbon $expiresTime;

    public ProductEndpoint $product;

    public function __construct()
    {
        $this->domain = config('shopware.url');
        $this->getBearerToken();

        $this->product = app(ProductEndpoint::class);
    }

    public function checkBearer(): void
    {
        if ($this->expiresTime->unix() <= Carbon::now()->unix()) {
            $this->getBearerToken();
        }
    }

    /**
     * @throws ShopwareApiAuthenticationException
     */
    private function getBearerToken(): void
    {
        $currentTime = Carbon::now();
        $response = Http::post($this->domain . '/api/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('shopware.client_id'),
            'client_secret' => config('shopware.client_secret'),
        ])->onError(function ($exception) {
            dump($exception);
            throw new ShopwareApiAuthenticationException('client_id and/or client_secret are not authorized to access this domain.');
        });

        $data = $response->json();

        $this->bearer = $data['access_token'] ?? null;
        $this->expiresTime = $currentTime->addSeconds($data['expires_in'] ?? 0);
    }

    public function performGetRequest(string $uri, Parameters $parameters, Header $header = null): Response
    {
        if (is_null($header)) {
            $header = new Header();
        }

        return Http::withToken($this->bearer)
            ->withHeaders($header->toArray())
            ->get(
                sprintf('%Exceptions%Exceptions',
                    $this->domain,
                    $uri
                ),
                $parameters->toArray()
            );
    }
}