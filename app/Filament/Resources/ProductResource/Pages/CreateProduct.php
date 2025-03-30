<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\DTO\CreateProductData;
use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    /**
     * Manipula a criação de registros através do formulário, utilizando o DTO.
     *
     * @param array $data
     * @return Product
     */
    protected function handleRecordCreation(array $data): Product
    {
        try {
            $dto = new CreateProductData(...$data);
            return Product::createFromDTO($dto);
        } catch (\Throwable $e) {
            // Log do erro completo para debug
            Log::error('Falha ao criar produto', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            throw $e;
        }
    }
}
