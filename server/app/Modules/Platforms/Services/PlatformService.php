<?php

namespace App\Modules\Platforms\Services;

use App\Models\Platform;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;


class PlatformService extends Service {

    protected $fields = ["id", "name"];

    protected $rules = [
        'add' => ['name' => 'required|string|max:50'],
        'update' => ['name' => 'required|string|max:50']
    ];


    public function __construct(Platform $model){
        parent::__construct($model);
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
