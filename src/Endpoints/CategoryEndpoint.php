<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Endpoints;


use GeNyaa\ShopwareApiSdk\Dto\Arrayable;
use GeNyaa\ShopwareApiSdk\Dto\Category;
use GeNyaa\ShopwareApiSdk\Dto\Parameters;
use GeNyaa\ShopwareApiSdk\Dto\Product;
use Illuminate\Support\Collection;

class CategoryEndpoint extends EndpointAbstract
{
    protected string $resourcePath = '/api/v3/category';

    protected string $resource = 'category';

    public function all(): Collection
    {
        return parent::all()->mapInto(Category::class);
    }

    public function first(): ?Category
    {
        $category = parent::first();

        return is_null($category) ? null : $this->mapInto($category);
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
