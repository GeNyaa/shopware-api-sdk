<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\Language;
use GeNyaa\ShopwareApiSdk\Dto\Resources\LanguageCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class LanguageEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/language';

    protected string $resource = 'language';

    /**
     * @throws ShopwareApiException
     */
    public function all(): LanguageCollection
    {
        return (new LanguageCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    public function first(): ?Language
    {
        $language = parent::first();

        return is_null($language) ? null : $this->mapInto($language);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Language $language): Language
    {
        $this->restCreate($language);
        return $language;
    }

    public function mapInto(array $language): Language
    {
        return new Language(
            $language['id'],
            $language['name'],
            $language['isoCode'] ?? null,
            $language['locale'],
        );
    }
}
