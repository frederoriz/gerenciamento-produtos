<?php

namespace App\Enums;

enum ProductStatus: string
{
    case ACTIVE = 'Ativo';
    case INACTIVE = 'Inativo';

    /**
     * Retorna a label do status do produto.
     *
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo',
        };
    }
}