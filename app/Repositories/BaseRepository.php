<?php

namespace App\Repositories;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent;

/**
 *
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        return $this->model = $model;
    }

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model
    {
        return $this->modelQuery()->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $record = $this->findById($id);
        return $record->update($data);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): ?Model
    {
        return $this->modelQuery()->findOrFail($id);
    }

    /**
     * @param string $column
     * @param $operator
     * @param mixed $param
     * @return Model|null
     */
    public function findByParamFirst(string $column, $operator, mixed $param): ?Model
    {
        return $this->createQuery($column, $operator, $param)->first();
    }

    /**
     * @param string $column
     * @param $operator
     * @param mixed $param
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findByParamPaginate(string $column, $operator, mixed $param, int $pagination = 10): LengthAwarePaginator
    {
        return $this->createQuery($column, $operator, $param)->paginate($pagination);
    }

    /**
     * @param string $column
     * @param $operator
     * @param mixed $param
     * @return Builder
     */
    private function createQuery(string $column, $operator, mixed $param): Builder
    {
        return $this->modelQuery()->where($column, $operator, $param);
    }


    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->modelQuery()->all();
    }

    /**
     * @param string $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $search, int $perPage = 100): LengthAwarePaginator
    {
        return $this->model::search($search)->paginate($perPage);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->findById($id)->delete();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function pagination(int $perPage = 100): LengthAwarePaginator
    {
        return $this->modelQuery()->paginate($perPage);
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->modelQuery()->count();
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model::class;
    }


    /**
     * @param int $id
     * @param array|string $relation
     * @param array $select
     * @return Model|null
     */
    public function loadRelationship(int $id, array|string $relation, array $select = ["*"]): ?Model
    {
        return $this->findById($id)->load([$relation => function ($query) use ($select) {
            $query->select($select);
        }]);
    }

    /**
     * @return Builder
     */
    private function modelQuery(): Builder
    {
        return $this->model::query();
    }


    /**
     * @param array $columns
     * @return Collection
     */
    public function get(array $columns = ["*"]): Collection
    {
        return $this->modelQuery()->get($columns);
    }

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
                                          int          $perPage): LengthAwarePaginator
    {
        return $this->withRelation($relation, $modelColumns, $relationsColumns)->paginate($perPage);
    }

    /**
     * @param array|string $relation
     * @param array $modelsColumns
     * @param array $relationsColumns
     * @return Builder
     */
    private function withRelation(array|string $relation,
                                  array        $modelsColumns = ["*"],
                                  array        $relationsColumns = ["*"],

    ): Builder
    {
        return $this->modelQuery()->select($modelsColumns)
            ->with([$relation => function ($query) use ($relationsColumns) {
                $query->select($relationsColumns);
            }]);
    }


    /**
     * @param array|string $relation
     * @param array $relationsColumns
     * @param array $modelsColumns
     * @return Builder
     */
    private function withRelationCount(array|string $relation,
                                       array        $modelsColumns = ["*"],
                                       array        $relationsColumns = ["*"],
    ): Builder
    {
        return $this->withRelation($relation, $modelsColumns, $relationsColumns)->withCount($relation);
    }


    /**
     * @param array|string $relations
     * @param array $modelColumns
     * @return Builder
     */
    private function withCount(array|string $relations, array $modelColumns = ["*"]): Builder
    {
        return $this->modelQuery()->select($modelColumns)->withCount($relations);
    }

    /**
     * @param array|string $relations
     * @param array $modelColumns
     * @return Builder[]|Collection
     */
    public function getRelationsCount(array|string $relations, array $modelColumns = ["*"]): Collection|array
    {
        return $this->withCount($relations, $modelColumns)->get();
    }

    /**
     * @param array|string $relations
     * @param array $modelColumns
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getRelationsCountById(array|string $relations,
                                          array $modelColumns = ["*"], int $id): Model|Builder|Collection|array|null
    {
        return $this->withCount($relations, $modelColumns)->findOrFail($id);
    }

    /**
     * @param array|string $relation
     * @param array $modelColumns
     * @param array $relationsColumns
     * @return Builder[]|Collection
     */
    public function getModelWithRelation(array|string $relation,
                                         array        $modelColumns = ['*'],
                                         array        $relationsColumns = ['*']): Collection|array
    {
        return $this->withRelation($relation, $modelColumns, $relationsColumns)->get($modelColumns);
    }

    /**
     * @param array|string $relation
     * @param array $relationColumns
     * @param array $modelsColumns
     * @return Builder
     */
    private function loadModelWithCountRelation(array|string $relation,
                                                array        $modelsColumns = ["*"],
                                                array        $relationColumns = ["*"]

    ): Builder
    {
        return $this->withRelationCount($relation, $modelsColumns, $relationColumns);
    }


    /**
     * @param array|string $relation
     * @param array $relationColumns
     * @param array $modelsColumns
     * @return Builder[]|Collection
     */
    public function getModelWithCountRelation(array|string $relation,
                                              array        $modelsColumns = ["*"],
                                              array        $relationColumns = ["*"]): Collection|array
    {
        return $this->loadModelWithCountRelation($relation, $modelsColumns, $relationColumns)->get();
    }

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
    ): LengthAwarePaginator
    {
        return $this->loadModelWithCountRelation($relation, $modelsColumns, $relationColumns)->paginate($perPage);
    }

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
    ): LengthAwarePaginator

    {
        return $this->loadModelWithCountRelation($relation, $modelsColumns, $relationColumns)->paginate($perPage);
    }

    /**
     * @param int $id
     * @param array|string $relation
     * @param array $modelColumns
     * @param array $relationsColumns
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function loadRelationById(
        int   $id, array|string $relation, array $modelColumns = ['*'],
        array $relationsColumns = ['*']): Model|Builder|Collection|array|null
    {
        return $this->withRelation($relation, $modelColumns, $relationsColumns)->findOrFail($id);
    }

    /**
     * @param int $id
     * @param array|string $relation
     * @param array $modelColumns
     * @param array $relationsColumns
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function loadRelationWithCountById(int   $id, array|string $relation, array $modelColumns = ['*'],
                                              array $relationsColumns = ['*']): Model|Builder|Collection|array|null
    {
        return $this->withRelationCount($relation, $modelColumns, $relationsColumns)->findOrFail($id);
    }


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
                                                    string $direction): mixed
    {
        return $this->loadRelationById($id, $relation, $modelColumns, $relationsColumns)
            ->{$relation}()->orderBy($orderColumn, $direction);
    }

    /**
     * @param array $relations
     * @param int $id
     * @return Builder|Builder[]|Eloquent\Collection|Model|null
     */
    public function withRelationsCountById(array $relations, int $id): Model|Eloquent\Collection|Builder|array|null
    {
        return $this->modelQuery()->withCount($relations)->with($relations)->findOrFail($id);
    }
}
