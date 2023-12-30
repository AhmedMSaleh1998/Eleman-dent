<?php

namespace App\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements IRepository
{
    protected $model;

    public function __construct(App $app)
    {
        $this->setModel($app);
    }

    abstract public function model();

    public function setModel(App $app)
    {
        $this->model = $app->make($this->model());
    }

    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            return $this->model->{$name}(...$arguments);
        }
    }

    public function find($id, $with = [])
    {
        return $this->model->where($this->model->getKeyName(), $id)->with($with)->firstOrFail();
    }

    public function show($id, $with = [])
    {
        return $this->find($id, $with);
    }

    public function orderBy($orderBy, $dir)
    {
        $this->model->orderBy($orderBy, $dir);
    }

    public function paginate(array $filters, $with = [], $order = [])
    {
        $query = $this->model->query();
        $query->with($with);
        $query->orderBy($order[0] ?? 'id', $order[1] ?? 'desc');

        $data = $query->paginate();
        return $data;
    }

    public function get($with = [])
    {
        $query = $this->model->query();
        $query->with($with);
        $data = $query->get();
        return $data;
    }

    public function first()
    {
        $query = $this->model->query();
        $data = $query->first();
        return $data;
    }

    public function firstOrFail()
    {
        $query = $this->model->query();
        $data = $query->firstOrFail();
        return $data;
    }

    public function applyFilterQuery($filters, $query)
    {
        foreach ($filters as $filter) {
            $filter->apply($query);
        }
    }

    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    public function update($id, $data)
    {
        return $this->model->where($this->getKeyName(), $id)->update($data);
    }

    public function count()
    {
        $query = $this->model->query();
        $count = $query->count();
        return $count;
    }

    public function multipleUpdate($ids, $data)
    {
        return $this->model->whereIn($this->getKeyName(), $ids)->update($data);
    }

    public function deleteMany()
    {
        $query = $this->model->query();
        $result = $query->delete();
        return $result;
    }

    public function destroy($id)
    {
        /* $record = $this->show($id); */

        // foreach ($this->getFileColsWithRelationName() as $col => $relation) {
        //     if ($record->{$relation}) {
        //         $record->{$relation}->deleteFile();
        //     }
        // }

        return $this->model->where($this->getKeyName(), $id)->delete();
    }

    public function makeTransAction($closure)
    {
        DB::transaction($closure);
    }

    public function getActiveItems()
    {
        return $this->model->where('status', 1)->get();
    }

    // public function getFileColsWithRelationName()
    // {
    //     return $this->model->files??[];
    // }

    public function tempDestroy($id)
    {
        $data = $this->model->find($id);
        $data->status = 2;
        $data->update();
        /* $status = 2;
        DB::table($db)->where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with(['success' => 'تم حذف المنتج بنجاح ']);
     */
    }
}
