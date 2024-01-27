<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class EloquentRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {

        return $this->_model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * get first data by condition
     *
     * @param [type] ...$params
     * @return Model|null
     */
    public function getFirstWhere(...$params): ?Model
    {
        return $this->_model->firstWhere(...$params);
    }

    /**
     * Check Exist Model By Id
     *
     * @param [type] $id
     * @return void
     */
    public function checkExistById($id)
    {
        return $this->_model->where('id', $id)->exists();
    }

    /**
     * Get Data From Columns
     *
     * @param [type] $columns: ['column1', 'column2']
     * @param [type] $params: ['column1' => $param1, ['column2', '=|<|>', $param2], ...]
     * @return Collection
     * 
     * Note: | is one of the separating conditions.; If $params is null, then there is no condition.
     */
    public function getColumnsData($columns, $params = [])
    {
        return $this->_model->query()->select(...$columns)->where($params)->get();
    }
}
