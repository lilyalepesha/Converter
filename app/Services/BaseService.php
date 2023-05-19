<?php

namespace App\Services;


use App\Contracts\BaseRepositoryInterface;

/**
 *
 */
abstract class BaseService
{
    /**
     * @var BaseRepositoryInterface
     */
    protected $repository;

    /**
     * @param BaseRepositoryInterface $repository
     */
    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

//    /**
//     * @param array $data
//     * @return mixed
//     */
//    public function create(array $data)
//    {
//        return $this->repository->create($data);
//    }
//
//    /**
//     * @param $id
//     * @param array $data
//     * @return mixed
//     */
//    public function update($id, array $data)
//    {
//        return $this->repository->update($id, $data);
//    }
//
//    /**
//     * @param $column
//     * @param $operator
//     * @param $param
//     * @param $pagination
//     * @return mixed
//     */
//    public function findByParamPaginate($column, $operator, $param, $pagination = 10)
//    {
//        return $this->repository->findByParamPaginate($column, $operator, $param);
//    }
//
//    /**
//     * @param $column
//     * @param $operator
//     * @param $param
//     * @return mixed
//     */
//    public function findByParamFirst($column, $operator, $param)
//    {
//        return $this->repository->findByParamFirst($column, $operator, $param);
//    }
//
//    /**
//     * @return mixed
//     */
//    public function all()
//    {
//        return $this->repository->all();
//    }
//
//    /**
//     * @param $search
//     * @param $pagination
//     * @return void
//     */
//    public function search($search, $pagination)
//    {
//        return $this->repository->search($search, $pagination);
//    }
//
//    /**
//     * @param $id
//     * @return mixed
//     */
//    public function delete($id)
//    {
//        return $this->repository->delete($id);
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getCount()
//    {
//        return $this->repository->getCount();
//    }
//
//    /**
//     * @param $count
//     * @return mixed
//     */
//    public function pagination($count)
//    {
//        return $this->repository->pagination($count);
//    }

    /**
     * @return BaseRepositoryInterface
     */
    public function getRepository(): BaseRepositoryInterface
    {
        return $this->repository;
    }

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call(string $name, array $args): mixed
    {
        return $this->getRepository()->{$name}(...$args);
    }
}
