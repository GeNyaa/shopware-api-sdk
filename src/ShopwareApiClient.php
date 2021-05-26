<?php

declare(strict_types=1);

namespace GeNyaa\ShopwareApiSdk;

use Carbon\Carbon;
use GeNyaa\ShopwareApiSdk\Dto\Arrayable;
use GeNyaa\ShopwareApiSdk\Endpoints\CategoryEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\CountryEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\CurrencyEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\CustomerAddressEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\CustomerEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\CustomerGroupEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\LanguageEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\ManufacturerEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\PaymentMethodEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\PropertyEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\PropertyOptionEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\SalesChannelEndpoint;
use GeNyaa\ShopwareApiSdk\Endpoints\SalutationEndpoint;
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
    protected string $domain;
    protected ?string $bearer = null;
    protected string $clientId;
    protected string $clientSecret;
    protected ?Carbon $expiresTime = null;

    public CategoryEndpoint $category;
    public ProductEndpoint $product;
    public TaxEndpoint $tax;
    public LanguageEndpoint $language;
    public CurrencyEndpoint $currency;
    public PropertyEndpoint $property;
    public PropertyOptionEndpoint $propertyOption;
    public ManufacturerEndpoint $manufacturer;
    public CustomerEndpoint $customer;
    public SalutationEndpoint $salutation;
    public SalesChannelEndpoint $salesChannel;
    public CustomerGroupEndpoint $customerGroup;
    public PaymentMethodEndpoint $paymentMethod;
    public CustomerAddressEndpoint $customerAddress;
    public CountryEndpoint $country;

    public function __construct(Http $http)
    {
        $this->http = $http;
        $this->setDomain(config('shopware.url'));
        $this->setClientCredentials(config('shopware.client_id'), config('shopware.client_secret'));
        $this->initializeEndpoints();
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function setClientCredentials(string $clientId, string $clientSecret): self
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        return $this;
    }

    public function initializeEndpoints(): void
    {
        $this->category = new CategoryEndpoint($this);
        $this->product = new ProductEndpoint($this);
        $this->tax = new TaxEndpoint($this);
        $this->language = new LanguageEndpoint($this);
        $this->currency = new CurrencyEndpoint($this);
        $this->property = new PropertyEndpoint($this);
        $this->propertyOption = new PropertyOptionEndpoint($this);
        $this->manufacturer = new ManufacturerEndpoint($this);
        $this->customer = new CustomerEndpoint($this);
        $this->salutation = new SalutationEndpoint($this);
        $this->salesChannel = new SalesChannelEndpoint($this);
        $this->customerGroup = new CustomerGroupEndpoint($this);
        $this->paymentMethod = new PaymentMethodEndpoint($this);
        $this->customerAddress = new CustomerAddressEndpoint($this);
        $this->country = new CountryEndpoint($this);
    }

    public function checkBearer(): self
    {
        if (is_null($this->expiresTime) || $this->expiresTime->unix() <= Carbon::now()->unix()) {
            return $this->getBearerToken();
        }

        return $this;
    }

    /**
     * @throws ShopwareApiAuthenticationException
     */
    private function getBearerToken(): self
    {
        $currentTime = Carbon::now();
        $response = $this->http::baseUrl($this->domain)
            ->post('/api/oauth/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ])
            ->onError(function () {
                throw new ShopwareApiAuthenticationException('client_id and/or client_secret are not authorized to access this domain.');
            });

        $data = $response->json();

        $this->bearer = $data['access_token'] ?? null;
        $this->expiresTime = $currentTime->addSeconds($data['expires_in'] ?? 0);

        return $this;
    }

    public function performGetRequest(string $uri, Parameters $parameters = null, Header $header = null): Response
    {
        $this->checkBearer();

        if (is_null($header)) {
            $header = new Header();
        }

        if (is_null($parameters)) {
            $parameters = new Parameters();
        }

        return $this->http::baseUrl($this->domain)
            ->withToken($this->bearer)
            ->withHeaders($header->toArray())
            ->get($uri, $parameters->toArray());
    }

    public function performPostRequest(string $uri, array $data, Header $header = null): Response
    {
        $this->checkBearer();

        if (is_null($header)) {
            $header = new Header();
        }

        return $this->http::baseUrl($this->domain)
            ->withToken($this->bearer)
            ->withHeaders($header->toArray())
            ->post($uri, $data);
    }

    public function performSyncRequest(array $data, Header $header = null): Response
    {
        $this->checkBearer();

        if (is_null($header)) {
            $header = new Header();
        }

        return $this->http::baseUrl($this->domain)
            ->withToken($this->bearer)
            ->withHeaders($header->toArray())
            ->post('/api/_action/sync', $data);
    }

    public function copy(): self
    {
        return clone $this;
    }
}
