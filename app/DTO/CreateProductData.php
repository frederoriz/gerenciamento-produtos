<?php

namespace App\DTO;

use App\Enums\ProductStatus;
use Illuminate\Validation\Rules\Enum;

class CreateProductData
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly float $price,
        #[Enum(ProductStatus::class)]
        public readonly ProductStatus $status,
    ) {}

    /**
     * Regras de validação para os dados de criação de um produto.
     *
     * @return array
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|max:65535',
            'price' => 'required|numeric|min:0.01',
            'status' => ['required'],
        ];
    }
}
