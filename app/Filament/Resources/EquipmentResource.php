<?php
namespace App\Filament\Resources;

use App\Filament\Resources\EquipmentResource\Pages;
use App\Filament\Resources\EquipmentResource\RelationManagers;
use App\Models\Equipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Equipment Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('Unit_no')
                                    ->label('Unit No.')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Description')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Specifications')
                                    ->maxLength(255),
                                Forms\Components\Select::make('Facility_id')
                                    ->relationship('facility', 'name')
                                    ->required(),
                                Forms\Components\Select::make('Category_id')
                                    ->relationship('category', 'description')
                                    ->required(),
                                Forms\Components\Select::make('Status')
                                    ->required()
                                    ->options([
                                        'Working' => 'Working',
                                        'Out of Stock' => 'Out of Stock',
                                        'For Replacement' => 'For Replacement',
                                        'For Repair' => 'For Repair',
                                        'For Disposal' => 'For Disposal',
                                        'Disposed' => 'Disposed',
                                        'Excess and Working' => 'Excess and Working',
                                        'Returned' => 'Returned',
                                        'Borrowed' => 'Borrowed',
                                    ]),
                                Forms\Components\TextInput::make('Date_acquired')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Supplier')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Amount')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Estimated_life')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Item_no')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Property_no')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Control_no')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Serial_no')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('No_of_stocks')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Restocking_point')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Person_liable')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Remarks')
                                    ->maxLength(255),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Unit_no')
                    ->label('Unit No')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Specifications')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('facility.name')
                    ->label('Facility')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('category.description')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Status')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Date_acquired')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Supplier')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Amount')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Estimated_life')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Item_no')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Property_no')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Control_no')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Serial_no')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('No_of_stocks')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Restocking_point')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Person_liable')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Remarks')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEquipment::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }
}
