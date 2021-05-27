<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Resources\Category;
use GeNyaa\ShopwareApiSdk\Dto\Resources\CategoryCollection;
use GeNyaa\ShopwareApiSdk\Exceptions\ShopwareApiException;

class CategoryEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/category';

    protected string $resource = 'category';

    /**
     * @throws ShopwareApiException
     */
    public function all(): CategoryCollection
    {
        return (new CategoryCollection())->merge($this->restAll())->map(function (array $category) {
            return $this->mapInto($category);
        });
    }

    /**
     * @throws ShopwareApiException
     */
    public function first(): ?Category
    {
        $category = $this->restFirst();

        return is_null($category) ? null : $this->mapInto($category);
    }

    /**
     * @throws ShopwareApiException
     */
    public function create(Category $category): Category
    {
        $this->restCreate($category);
        return $category;
    }

    public function mapInto(array $category): Category
    {
        return new Category(
            $category['id'],
            $category['name'],
            $category['parentId'],
            $category['active'],
            $category['visible'],
        );
    }


}
