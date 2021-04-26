<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk;

use Carbon\Carbon;
use GeNyaa\ShopwareApiSdk\Dto\Arrayable;
use GeNyaa\ShopwareApiSdk\Endpoints\CategoryEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\CurrencyEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\LanguageEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\PropertyEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\TaxEndpoint;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiAuthenticationException;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use GeNyaa\ShopwareApiSdk\Dto\Header;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Endpoints\ProductEndpoint;

class ShopwareApiClient
{
    public Http $http;
    public string $domain;
    public ?string $bearer;
    public ?Carbon $expiresTime;

    public CategoryEndpoint $category;
    public ProductEndpoint $product;
    public TaxEndpoint $tax;
    public LanguageEndpoint $language;
    public CurrencyEndpoint $currency;
    public PropertyEndpoint $property;

    public function __construct(Http $http)
    {
        $this->http = $http;
        $this->domain = config('shopware.url');
        $this->getBearerToken();
        $this->initializeEndpoints();
    }

    public function initializeEndpoints(): void
    {
        $this->category = new CategoryEndpoint($this);
        $this->product = new ProductEndpoint($this);
        $this->tax = new TaxEndpoint($this);
        $this->language = new LanguageEndpoint($this);
        $this->currency = new CurrencyEndpoint($this);
        $this->property = new PropertyEndpoint($this);
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
        $response = $this->http::post($this->domain . '/api/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('shopware.client_id'),
            'client_secret' => config('shopware.client_secret'),
        ])->onError(function ($exception) {
            throw new ShopwareApiAuthenticationException('client_id and/or client_secret are not authorized to access this domain.');
        });

        $data = $response->json();

        $this->bearer = $data['access_token'] ?? null;
        $this->expiresTime = $currentTime->addSeconds($data['expires_in'] ?? 0);
    }

    public function performGetRequest(string $uri, Parameters $parameters = null, Header $header = null): Response
    {
        if (is_null($header)) {
            $header = new Header();
        }

        if (is_null($parameters)) {
            $parameters = new Parameters();
        }

        return $this->http::withToken($this->bearer)
            ->withHeaders($header->toArray())
            ->get(
                sprintf('%s%s',
                    $this->domain,
                    $uri
                ),
                $parameters->toArray()
            );
    }

    public function performSyncRequest(array $data, Header $header = null): Response
    {
        if (is_null($header)) {
            $header = new Header();
        }

        return $this->http::withToken($this->bearer)
            ->withHeaders($header->toArray())
            ->post(
                sprintf('%s/api/_action/sync',
                    $this->domain
                ),
                $data,
            );
    }
}
