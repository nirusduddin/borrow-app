<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index() {
    $q = \App\Models\Equipment::with('category')->latest('updated_at');

    if ($s = request('search')) {
        $q->where(fn($qq)=> $qq->where('code','like',"%$s%")->orWhere('name','like',"%$s%"));
    }
    if ($cat = request('category_id')) $q->where('equipment_category_id',$cat);

    return \App\Http\Resources\Api\EquipmentResource::collection($q->paginate(10));
    }

    public function store(\App\Http\Requests\Api\EquipmentStoreRequest $request) {
    $data = $request->validated();
    if ($request->hasFile('photo')) {
        $data['photo_path'] = $request->file('photo')->store('equipment','public');
    }
    $e = \App\Models\Equipment::create($data);
    return new \App\Http\Resources\Api\EquipmentResource($e->load('category'));
    }

    public function show(\App\Models\Equipment $equipment) {
    return new \App\Http\Resources\Api\EquipmentResource($equipment->load('category'));
    }

    public function update(\App\Http\Requests\Api\EquipmentUpdateRequest $request, \App\Models\Equipment $equipment) {
    $data = $request->validated();
    if ($request->hasFile('photo')) {
        $data['photo_path'] = $request->file('photo')->store('equipment','public');
    }
    $equipment->update($data);
    return new \App\Http\Resources\Api\EquipmentResource($equipment->load('category'));
    }

    public function destroy(\App\Models\Equipment $equipment) {
    $equipment->delete();
    return response()->noContent();
    }
}