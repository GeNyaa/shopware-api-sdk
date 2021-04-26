<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Language;

class LanguageEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/language';

    protected string $resource = 'language';

    public  function first(): ?Language
    {
        $language = parent::first();

        return is_null($language) ? null : $this->mapInto($language);
    }
    private function mapInto(array $language): Language
    {
        return new Language(
            $category['id'],
            $category['name'],
            $category['parentId'],
            $category['active'],
            $category['visible'],
        );
    }
}
