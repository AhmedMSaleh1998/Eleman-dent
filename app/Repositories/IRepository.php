<?php

namespace App\Repositories;

use Illuminate\Container\Container as App;


interface IRepository
{

    /**
     * @param App $app
     */
    public function setModel(App $app);

    // public function find($id, $with = []);

    // public function show($id, $with = []);

    // public function orderBy($orderBy, $dir);

    // public function paginate(array $filters, $with = [], $order = []);

    // public function get();

    // public function first();

    // public function firstOrFail();

    // public function applyFilterQuery($filters, $query);

    // public function create($data);

    // public function update($id, $data);

    // public function count();

    // public function multipleUpdate($ids, $data);

    // public function deleteMany();

    // public function destroy($id);

    // public function makeTransAction($closure);

    // public function getActiveItems();
}
