<?php

namespace App\Modules\Users\Services;

use App\Models\User;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;


class UserService extends Service {

    protected $fields = ["id", "name", "email"];

    protected $rules = [];


    protected function getRelationFields()
    {
        return [
        ];
    }


    public function __construct(User $model){
        parent::__construct($model);
    }

    public function ratings($id)
    {
        return $this->model
            ->select($this->fields)
            ->with("ratings")
            ->find($id);
    }

    public function all($perPage, $search)
    {
        $model = $this->model;
        if ($search) {
            $model =  $model->where('name', 'like', "%$search%");
        }

        return $model
            ->select($this->fields)
            ->with($this->getRelationFields())
            ->paginate($perPage)
            ->withQueryString();
    }
}
