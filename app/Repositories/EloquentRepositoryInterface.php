<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface EloquentRepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * get first data by condition
     *
     * @param [type] ...$params
     * @return Model|null
     */
    public function getFirstWhere(...$params);

    /**
     * Check Exist Model By Id, true if id existed
     *
     * @param [type] $id
     * @return void
     */
    public function checkExistById($id);

    /**
     * Get Data From Columns
     *
     * @param [type] $columns: ['column1', 'column2']
     * @param [type] $params: ['column1' => $param1, ['column2', '=|<|>', $param2], ...]
     * @return Collection
     * 
     * Note: | is one of the separating conditions.; If $params is null, then there is no condition.
     */
    public function getColumnsData($columns, $params = []);

    /**
     * Delete multiple record by array keys
     *
     * @param [Array] $ids
     * @return void
     */
    public function deleteMultiple($ids);
}
