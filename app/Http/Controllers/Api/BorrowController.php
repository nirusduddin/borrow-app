<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BorrowStoreRequest;
use App\Http\Resources\Api\BorrowResource;
use App\Models\Borrow;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    public function store(BorrowStoreRequest $request)
    {
        $userId = auth('api')->id();
        $data = $request->validated();

        return DB::transaction(function () use ($data, $userId) {

            // 1) เช็คห้ามยืมซ้ำชิ้นเดิมถ้ายังไม่คืน
            $exists = Borrow::whereNull('returned_at')
                ->where('user_id', $userId)
                ->where('equipment_id', $data['equipment_id'])
                ->exists();
            if ($exists) {
                return response()->json(['message'=>'คุณค้างยืมอุปกรณ์ชิ้นนี้อยู่แล้ว'], 422);
            }

            // 2) ล็อกแถวอุปกรณ์ แล้วเช็ค stock
            /** @var Equipment $eq */
            $eq = Equipment::lockForUpdate()->findOrFail($data['equipment_id']);
            if ($eq->stock <= 0) {
                return response()->json(['message'=>'สต็อกไม่พอ'], 422);
            }

            // 3) สร้างรายการ + หัก stock
            $eq->decrement('stock');

            $borrow = Borrow::create([
                'user_id'      => $userId,
                'equipment_id' => $eq->id,
                'borrowed_at'  => now(),
                'due_at'       => $data['due_at'] ?? now()->addDays(7),
                'status'       => 'borrowed',
                'note'         => $data['note'] ?? null,
            ]);

            return (new BorrowResource($borrow->load(['user','equipment'])))
                    ->response()
                    ->setStatusCode(201);
        });
    }

    public function return(\App\Models\Borrow $borrow): JsonResponse
    {
        // เช็คก่อน: ถ้าคืนแล้ว ไม่ควรทำซ้ำ
        if ($borrow->returned_at) {
            return response()->json(['message' => 'รายการนี้คืนแล้ว'], 409);
        }

        return DB::transaction(function () use ($borrow) {
            // ล็อกแถวอุปกรณ์ป้องกันแข่งกัน
            $eq = \App\Models\Equipment::lockForUpdate()->findOrFail($borrow->equipment_id);

            // อัปเดตสถานะคืน
            $borrow->update([
                'returned_at' => now(),
                'status'      => 'returned',
            ]);

            // คืนสต็อก
            $eq->increment('stock');

            return (new \App\Http\Resources\Api\BorrowResource(
                $borrow->fresh()->load(['user','equipment'])
            ))->response()->setStatusCode(200);
        });
    }
}