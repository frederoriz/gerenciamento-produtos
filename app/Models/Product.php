<?php

namespace App\Models;

use App\DTO\CreateProductData; // Adicione esta importação
use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public string $name;
    public ?string $description;
    public float $price;
    public ProductStatus $status;

    protected $casts = [
        'status' => ProductStatus::class,
        'price' => 'decimal:2',
    ];

    protected $fillable = ['name', 'description', 'price', 'status'];

    /**
     * Cria um novo produto a partir de um DTO.
     *
     * @param CreateProductData $dto
     * @return self
     */
    public static function createFromDTO(CreateProductData $dto): self
    {
        try {
            return self::create([
                'name' => $dto->name,
                'description' => $dto->description,
                'price' => $dto->price,
                'status' => $dto->status,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Falha de banco ao criar produto', [
                'dto' => $dto,
                'error' => $e->getMessage()
            ]);

            throw new \RuntimeException('Falha na persistência do produto no banco.');
        }
    }
}
