<?php

namespace App\Repositories;

class BaseRepository implements IBaseRepository
{
    public function __construct()
    {
    }

    public function getPageDefault($model,$id)
    {
        $data =  ['item' => null,'type' => 'add', 'items' => []];
        return ($id == null) ? [...$data, 'items' => $model::take(1)->select(['id'])->get()] :  [...$data, 'type' => 'edit', 'item' => $model::find($id)];
    }
}
