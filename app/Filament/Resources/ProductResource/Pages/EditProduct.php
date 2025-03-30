<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Preenche o formulário com os dados do registro.
     *
     * @return void
     */
    protected function fillForm(): void
    {
        $product = $this->getRecord();

        $this->form->fill([
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'status' => $product->status->value,
        ]);
    }
}
