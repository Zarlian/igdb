<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Core\Services\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

abstract class ApiServiceController extends Controller
{
    protected $service;


    public function find(Request $request, $id)
    {
        //todo refactor
        $locale = App::getLocale();
        $language = $request->input('lang', $locale);
        if($language != $locale){
            $this->service->setLanguage($language);
        }

        $result = $this->service->find($id);

        return response()->json($result);
    }

    public function all(Request $request)
    {
        $locale = App::getLocale();
        $language = $request->input('lang', $locale);
        if($language != $locale){
            $this->service->setLanguage($language);
        }

        $perPage = $request->query('per_page', 5);

        $search = $request->query('search', '');

        $result = $this->service->all($perPage, $search);
        return response()->json($result);
    }


    public function create(Request $request)
    {
        $result = $this->service->create($request->all());
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($result, Response::HTTP_CREATED);
    }

    public  function update(Request $request, $id)
    {
        $result = $this->service->update($request->all(), $id);
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($result);
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($result);
    }
}
