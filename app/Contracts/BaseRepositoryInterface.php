<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent;

/**
 *
 */
interface BaseRepositoryInterface
{

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): ?Model;

    /**
     * @param string $column
     * @param $operator
     * @param mixed $param
     * @return Model|null
     */
    public function findByParamFirst(string $column, $operator, mixed $param): ?Model;

    /**
     * @param string $column
     * @param $operator
     * @param mixed $param
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findByParamPaginate(string $column, $operator, mixed $param, int $pagination = 10): LengthAwarePaginator;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param string $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $search, int $perPage = 100): LengthAwarePaginator;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function pagination(int $perPage = 100): LengthAwarePaginator;

    /**
     * @return int
     */
    public function getCount(): int;

    /**
     * @return string
     */
    public function getModel(): string;


    /**
     * @param int $id
     * @param array|string $relation
     * @param array $select
     * @return Model|null
     */
    public function loadRelationship(int $id, array|string $relation, array $select = ["*"]): ?Model;

    /**
     * @param array $columns
     * @return Collection
     */
    public function get(array $columns = ["*"]): Collection;

    /**
     * @param array|string $relation
     * @param array $modelColumns
     * @param array $relationsColumns
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function withRelationsPaginate(array|string $relation,
                                          array        $modelColumns = ['*'],
                                          array        $relationsColumns = ['*'],
                                          int          $perPage): LengthAwarePaginator;



    /**
     * @param array|string $relations
     * @param array $modelColumns
     * @return Builder[]|Collection
     */
    public function getRelationsCount(array|string $relations, array $modelColumns = ["*"]): Collection|array;

    /**
     * @param array|string $relations
     * @param array $modelColumns
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getRelationsCountById(array|string $relations,
                                          array $modelColumns = ["*"], int $id): Model|Builder|Collection|array|null;

    /**
     * @param array|string $relation
     * @param array $modelColumns
     * @param array $relationsColumns
     * @return Builder[]|Collection
     */
    public function getModelWithRelation(array|string $relation,
                                         array        $modelColumns = ['*'],
                                         array        $relationsColumns = ['*']): Collection|array;

    /**
     * @param array|string $relation
     * @param array $relationColumns
     * @param array $modelsColumns
     * @return Builder[]|Collection
     */
    public function getModelWithCountRelation(array|string $relation,
                                              array        $modelsColumns = ["*"],
                                              array        $relationColumns = ["*"]): Collection|array;

    /**
     * @param array|string $relation
     * @param array $relationColumns
     * @param int $perPage
     * @param array $modelsColumns
     * @return LengthAwarePaginator
     */
    public function paginateModelWithCountRelation(array|string $relation,
                                                   array        $modelsColumns = ["*"],
                                                   array        $relationColumns = ["*"],
                                                   int          $perPage = 100,
    ): LengthAwarePaginator;

    /**
     * @param int $id
     * @param array|string $relation
     * @param array $modelColumns
     * @param array $relationsColumns
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function loadRelationById(
        int   $id, array|string $relation, array $modelColumns = ['*'],
        array $relationsColumns = ['*']): Model|Builder|Collection|array|null;

    /**
     * @param int $id
     * @param array|string $relation
     * @param array $modelColumns
     * @param array $relationsColumns
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function loadRelationWithCountById(int   $id, array|string $relation, array $modelColumns = ['*'],
                                              array $relationsColumns = ['*']): Model|Builder|Collection|array|null;


    /**
     * @param int $id
     * @param array|string $relation
     * @param array $modelColumns
     * @param array $relationsColumns
     * @param string $orderColumn
     * @param string $direction
     * @return mixed
     */
    public function loadRelationByIdOrderByRelation(int    $id, array|string $relation, array $modelColumns = ['*'],
                                                    array  $relationsColumns = ['*'], string $orderColumn,
                                                    string $direction): mixed;

    /**
     * @param array|string $relation
     * @param array $modelsColumns
     * @param array $relationColumns
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getModelWithCountRelationPaginate(array|string $relation,
                                                      array        $modelsColumns = ["*"],
                                                      array        $relationColumns = ["*"],
                                                      int          $perPage = 100,
    ): LengthAwarePaginator;

    /**
     * @param array $relations
     * @param int $id
     * @return Builder|Builder[]|Eloquent\Collection|Model|null
     */
    public function withRelationsCountById(array $relations, int $id): Model|Eloquent\Collection|Builder|array|null;
}
