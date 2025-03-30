<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        Log::info("Novo produto criado: {$product->name} (ID: {$product->id})");
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Log::info("Produto atualizado: {$product->name} (ID: {$product->id})");
        
        // Exemplo: Verificar se o preço mudou
        if ($product->wasChanged('price')) {
            Log::info("Preço do produto alterado de {$product->getOriginal('price')} para {$product->price}");
        }

        if ($product->wasChanged('status')) {
            Log::info("Status do produto alterado para {$product->status}");
        }

        if ($product->wasChanged('name')) {
            Log::info("Nome do produto alterado para {$product->name}");
        }

        if ($product->wasChanged('description')) {
            Log::info("Descrição do produto alterada.");
        }

    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Log::info("Produto deletado: {$product->name} (ID: {$product->id})");
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        Log::info("Produto restaurado: {$product->name} (ID: {$product->id})");
    }

    /**
     * Handle the Product "forceDeleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        Log::info("Produto removido permanentemente: {$product->name} (ID: {$product->id})");
    }
    
}