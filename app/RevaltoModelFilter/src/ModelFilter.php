<?php

namespace App\RevaltoModelFilter\src;
use App\RevaltoModelFilter\src\Interfaces\Composition;
use App\RevaltoModelFilter\src\Interfaces\ModelFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
/**
 * Class ModelFilter
 * Example: \App\Filters\ExampleFilter.php
 * @package App\Logic\RevaltoModelFilter
 */
abstract class ModelFilter implements ModelFilterInterface, Composition
{
    /**
     * @var Builder
     */
    protected Builder $query;

    /**
     * @var string
     */
    protected string $tableName;

    /**
     * @var array
     */
    protected array $params = [];

    /**
     * @var array
     */
    protected array $defaults = [];

    /**
     * @var array
     */
    protected array $addition = [];

    /**
     * RevaltoModelFilter constructor.
     * @param Builder $query
     * @param array $params
     */
    public function __construct(Builder $query, array $params = [])
    {
        $this->query = $query;
        $this->tableName = $query->getModel()->getTable();
        $this->params = $params;
    }

    /**
     * @return Builder
     * @throws \Exception
     */
    public function filter(): Builder
    {
        $this->prepareFilter();

        foreach ($this->params as $key => $value) {
            if ($this->hasDefault($key)) {
                $this->callDefault($key, $value);
            } elseif($this->hasFunction($key)) {
                $this->callFunction($key, $value);
            }
        }

        if (!empty($this->addition)) {
            foreach ($this->addition as $value) {
                if($this->hasFunction($value)) {
                    $this->callFunction($value, isAdditional: true);
                }
            }
        }

        $this->prepareResult();

        return $this->query;


    }

    /**
     * @param string $key
     * @return bool
     */
    protected function hasDefault(string $key): bool
    {
        return isset($this->defaults[$key]);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    protected function callDefault(string $key, mixed $value): void
    {
        $this->query->where(
            $this->tableName . '.' . $key,
            $this->defaults[$key],
            $this->defaults[$key] === self::COMPOSITION_LIKE
                ? ('%' . $value . '%')
                : $value
        );
    }

    /**
     * @param string $key
     * @return string
     */
    protected function getFunctionName(string $key): string
    {
        return Str::camel($key);
    }

    /**
     * @param string $key
     * @return bool
     */
    protected function hasFunction(string $key): bool
    {
        return method_exists($this, $this->getFunctionName($key));
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param bool $isAdditional
     * @return void
     */
    protected function callFunction(string $key, mixed $value = null, bool $isAdditional = false): void
    {
        $isAdditional
            ? $this->{$this->getFunctionName($key)}()
            : $this->{$this->getFunctionName($key)}($value);
    }

    /**
     * @return void
     */
    protected function prepareResult(): void
    {
        $this->query->select($this->tableName . '.*');
    }

    /**
     * @return void
     */
    protected function prepareFilter(): void
    {
        //
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->params[$key]);
    }
}
