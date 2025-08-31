<?php

namespace App\Filament\Resources\EquipmentCategoryResource\Pages;

use App\Filament\Resources\EquipmentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEquipmentCategory extends EditRecord
{
    protected static string $resource = EquipmentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
