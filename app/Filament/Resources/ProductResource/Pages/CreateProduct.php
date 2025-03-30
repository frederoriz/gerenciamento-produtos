<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\DTO\CreateProductData;
use App\Enums\ProductStatus;
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
            // Converte o status de string para o enum ProductStatus
            $data['status'] = ProductStatus::from($data['status']);

            $dto = new CreateProductData(...$data);

            return Product::createFromDTO($dto);

        } catch (\Throwable $e) {
            
            Log::error('Falha ao criar produto', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            throw $e;
        }
    }
}
