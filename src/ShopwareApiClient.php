<?php

declare(strict_types=1);

namespace ShopWorks\ShopwareApiSdk;

use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use ShopWorks\ShopwareApiSdk\Dto\Header;
use ShopWorks\ShopwareApiSdk\Dto\Parameters;
use ShopWorks\ShopwareApiSdk\Endpoints\ProductEndpoint;

class ShopwareApiClient
{
    private string $domain;
    private string $bearer;
    private ?Carbon $expiresTime;
    public const PAGE_LIMIT = 500;

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

    private function getBearerToken(): void
    {
        $currentTime = Carbon::now();
        $response = Http::post($this->domain . '/api/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('shopware.client_id'),
            'client_secret' => config('shopware.client_secret'),
        ]);

        $data = $response->json();

        $this->bearer = $data['access_token'];
        $this->expiresTime = $currentTime->addSeconds($data['expires_in']);
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