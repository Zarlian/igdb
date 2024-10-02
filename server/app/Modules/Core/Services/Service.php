<?php
namespace App\Modules\Core\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

abstract class Service {
    protected $model;
    protected $fields;
    protected $searchField;
    protected $translatable = false;
    protected $errors;
    protected $rules;

    public function __construct($model)
    {
        $this->model = $model;
        $this->errors = new MessageBag();
    }

    protected function getRelationFields(){
        return [];
    }

    public function find($id)
    {
        return $this->model
            ->select($this->fields)
            ->with($this->getRelationFields())
            ->find($id);
    }

    public function create($data, $ruleKey = "add")
    {
        if(! $this->validate($data, $ruleKey)){
            return;
        }

        $result = $this->model->create($data);
        return $result;
    }

    public function all($perPage, $search){
        $result = $this->model
            ->select($this->fields)
            ->with($this->getRelationFields())
            ->get();
        return $result;
    }

    public function update($data, $id)
    {
        if(! $this->validate($data, "update")){
            return;
        }
        $result = $this->model->find($id);
        $result->update($data);
        return $result;
    }

    public function delete($id)
    {
        $result = $this->model->find($id);
        $result->delete();
        return $result;
    }

    public function validate($data, $ruleKey)
    {
        $rules = $this->getRules($ruleKey);

        $this->errors = new MessageBag();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    private function getRules($ruleKey){
        $rules = $this->rules;
        if(isset($this->rules[$ruleKey])){
            $rules = $this->rules[$ruleKey];
        }

        return $rules;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function hasErrors(){
        return $this->errors->isNotEmpty();
    }

    public function setLanguage($language){
        App::setLocale($language);
    }
}
