<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EquipmentCategoryController extends Controller
{
    public function __construct() { 
    $this->middleware('auth:api'); 
}

public function index() {
  $data = \App\Models\EquipmentCategory::query()->latest('updated_at')->paginate(10);
  return \App\Http\Resources\Api\CategoryResource::collection($data);
}

public function store(\App\Http\Requests\Api\CategoryStoreRequest $request) {
  $cat = \App\Models\EquipmentCategory::create($request->validated());
  return new \App\Http\Resources\Api\CategoryResource($cat);
}

public function show(\App\Models\EquipmentCategory $category) {
  return new \App\Http\Resources\Api\CategoryResource($category);
}

public function update(\App\Http\Requests\Api\CategoryUpdateRequest $request, \App\Models\EquipmentCategory $category) {
  $category->update($request->validated());
  return new \App\Http\Resources\Api\CategoryResource($category);
}

public function destroy(\App\Models\EquipmentCategory $category) {
  $category->delete();
  return response()->noContent();
}
}
