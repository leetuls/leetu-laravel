<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

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
     * Check Exist Model By Id
     *
     * @param [type] $id
     * @return void
     */
    public function checkExistById($id);

    /**
     * Get Data From Columns
     *
     * @param [type] $columns: ['column1', 'column2']
     * @param [type] $params: [$param1 => $value1, [$param2, '=|<|>|in|...', $value2], ...]
     * @return void
     * 
     * Note: | is one of the separating conditions.
     */
    public function getColumnsData($columns, $params = []);
}
