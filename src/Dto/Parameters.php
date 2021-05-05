<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


use GeNyaa\ShopwareApiSdk\ShopwareApiClient;

class Parameters implements Arrayable
{
    /**
     * Filter types
     */
    const FILTER_TYPE_EQUALS = 'equals';
    const FILTER_TYPE_EQUALS_ANY = 'equalsAny';
    const FILTER_TYPE_CONTAINS = 'contains';
    const FILTER_TYPE_RANGE = 'range';
    const FILTER_TYPE_NOT = 'not';
    const FILTER_TYPE_MULTI = 'multi';
    const FILTER_TYPE_PREFIX = 'prefix';
    const FILTER_TYPE_SUFFIX = 'suffix';

    /**
     * Sort direction options
     */
    const SORT_ASC = 'ASC';
    const SORT_DESC = 'DESC';

    /**
     * Count modes
     */
    const COUNT_MODE_NO_TOTAL = 0;
    const COUNT_MODE_TOTAL = 1;
    const COUNT_MODE_NEXT_PAGE = 2;

    public function __construct(
        private array $parameters = []
    )
    {
    }

    public function set(string $key, mixed $value): self
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    public function setFilter(string $key, mixed $value, string $type = self::FILTER_TYPE_EQUALS): self
    {
        $this->parameters['filter'][] = [
            'type' => $type,
            'field' => $key,
            'value' => $value,
        ];

        return $this;
    }

    public function setSort(string $key, ?string $direction = null): self
    {
        $sort = [
            'property' => $key,
        ];

        if (!is_null($direction)) {
            $sort['direction'] = $direction;
        }

        $this->parameters['sort'][] = $sort;

        return $this;
    }

    public function setCountMode(int $mode = self::COUNT_MODE_NO_TOTAL): self
    {
        return $this->set('total-count-mode', $mode);
    }

    public function setLimit(int $limit): self
    {
        return $this->set('limit', $limit);
    }

    public function setPage(int $page): self
    {
        return $this->set('page', $page);
    }

    public function getPage(): int
    {
        $page = $this->get('page');

        return is_null($page) ? 1 : $page;
    }

    public function get(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }

    public function toArray(): array
     {
         return $this->parameters;
     }
}
