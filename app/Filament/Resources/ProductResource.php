<?php

namespace App\Filament\Resources;

use App\DTO\CreateProductData;
use App\Filament\Resources\ProductResource\Pages;
use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    /**
     * Manipula a criação de registros através do formulário, utilizando o DTO.
     *
     * @param array $data
     * @return Product
     */
    protected function handleRecordCreation(array $data): Product
    {
        $dto = new CreateProductData(...$data);
        return Product::createFromDTO($dto);
    }

    /**
     * Define as páginas disponíveis para o recurso.
     *
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    /**
     * Define os campos do formulário para criar e atualizar registros.
     *
     * @param Forms\Form $form
     * @return Forms\Form
     */
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->placeholder('Nome do Produto')
                    ->minLength(3)
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('price')
                    ->label('Preço')
                    ->required()
                    ->numeric()
                    ->minValue(0.01)
                    ->maxValue(1000000)
                    ->placeholder('0,00')
                    ->prefix('R$'),

                Forms\Components\Select::make('status')
                    ->required()
                    ->options(
                        collect(ProductStatus::cases())->mapWithKeys(fn ($status) => [
                            $status->value => $status->label(),
                        ])->toArray()
                    )
                    ->placeholder('Selecione um Status')
                    ->native(false),
            ]);
    }

    /**
     * Define as colunas da tabela e cria seus filtros.
     *
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('BRL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(ProductStatus $state): string => match ($state) {
                        ProductStatus::ACTIVE => 'success',
                        ProductStatus::INACTIVE => 'danger',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Excluído em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            // Criar filtros para a tabela
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(ProductStatus::class),

                Tables\Filters\Filter::make('search')
                    ->form([
                        Forms\Components\TextInput::make('query')
                            ->label('Busca')
                            ->placeholder('Nome ou descrição'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['query'],
                                fn(Builder  $query, string $search) => $query
                                    ->where('name', 'like', "%{$search}%")
                                    ->orWhere('description', 'like', "%{$search}%")
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }
}
