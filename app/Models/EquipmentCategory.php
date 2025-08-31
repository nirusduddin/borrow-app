<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
