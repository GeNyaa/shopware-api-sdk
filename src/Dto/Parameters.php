<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;


use GeNyaa\ShopwareApiSdk\ShopwareApiClient;

final class Parameters extends DtoAbstract
{
    /**
     * Filter types
     */
    public const FILTER_TYPE_EQUALS = 'equals';
    public const FILTER_TYPE_EQUALS_ANY = 'equalsAny';
    public const FILTER_TYPE_CONTAINS = 'contains';
    public const FILTER_TYPE_RANGE = 'range';
    public const FILTER_TYPE_NOT = 'not';
    public const FILTER_TYPE_MULTI = 'multi';
    public const FILTER_TYPE_PREFIX = 'prefix';
    public const FILTER_TYPE_SUFFIX = 'suffix';

    /**
     * Sort direction options
     */
    public const SORT_ASC = 'ASC';
    public const SORT_DESC = 'DESC';

    /**
     * Count modes
     */
    public const COUNT_MODE_NO_TOTAL = 0;
    public const COUNT_MODE_TOTAL = 1;
    public const COUNT_MODE_NEXT_PAGE = 2;

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

    public function get(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
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

    public function getLimit(): ?int
    {
        return $this->get('limit');
    }

    public function getCountMode(): ?int
    {
        return $this->get('total-count-mode');
    }

    public function getSort(string $key): ?array
    {
        return $this->get('sort')[$key] ?? null;
    }

    public function toArray(): array
     {
         return $this->parameters;
     }
}
