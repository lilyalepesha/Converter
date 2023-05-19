<?php

namespace App\RevaltoModelFilter\src\Traits;
use Illuminate\Database\Eloquent\Builder;

trait ModelFilterTrait
{
    /**
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $params): Builder
    {
        try {
            return app()->make(
                '\\App\\Filters\\' . class_basename($this) . 'Filter',
                compact('query', 'params')
            )->filter();
        } catch (\Throwable) {
            return $query;
        }
    }

    /**
     * @param Builder $query
     * @param string $table
     * @param string $firstColumn
     * @param string $eq
     * @param string $secondColumn
     * @return Builder
     */
    public function scopeAddJoin(Builder $query, string $table, string $firstColumn, string $eq, string $secondColumn): Builder
    {
        return $this->scopeHasJoin($query, $table, fn ($subQuery) => $subQuery->join($table, $firstColumn, $eq, $secondColumn));
    }

    /**
     * @param Builder $query
     * @param string $table
     * @param string $firstColumn
     * @param string $eq
     * @param string $secondColumn
     * @return Builder
     */
    public function scopeAddLeftJoin(Builder $query, string $table, string $firstColumn, string $eq, string $secondColumn): Builder
    {
        return $this->scopeHasJoin($query, $table, fn ($subQuery) => $subQuery->leftJoin($table, $firstColumn, $eq, $secondColumn));
    }

    /**
     * @param Builder $query
     * @param string $table
     * @param string $firstColumn
     * @param string $eq
     * @param string $secondColumn
     * @return Builder
     */
    public function scopeAddRightJoin(Builder $query, string $table, string $firstColumn, string $eq, string $secondColumn): Builder
    {
        return $this->scopeHasJoin($query, $table, fn ($subQuery) => $subQuery->rightJoin($table, $firstColumn, $eq, $secondColumn));
    }

    /**
     * @param Builder $query
     * @param string $table
     * @param $callback
     * @return Builder
     */
    public function scopeHasJoin(Builder $query, string $table, $callback): Builder
    {
        return $this->hasJoin($query, $table)
            ? $callback($query)
            : $query;
    }

    /**
     * @param Builder $query
     * @param string $table
     * @return bool
     */
    protected function hasJoin(Builder $query, string $table): bool
    {
        return collect($query->getQuery()->joins)->firstWhere('table', '=', $table) === null;
    }
}

