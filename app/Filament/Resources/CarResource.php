<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('models.car');
    }

    public static function getPluralModelLabel(): string
    {

        return __('models.cars');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([

                Group::make()
                    ->columnSpan(2)
                    ->schema([

                        Section::make(__('car.manufacture_details'))
                            ->collapsible()
                            ->columns(4)
                            ->schema([

                                Forms\Components\Select::make('brand_id')
                                    ->translateLabel()
                                    ->label('car.brand')
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Select::make('type_id')
                                    ->translateLabel()
                                    ->label('car.type')
                                    ->relationship('type', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\TextInput::make('year')
                                    ->translateLabel()
                                    ->label('car.year')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('passengers_no')
                                    ->translateLabel()
                                    ->label('car.passengers_no')
                                    ->required()
                                    ->numeric(),

                            ]),

                        Section::make(__('car.license_details'))
                            ->collapsible()
                            ->columns(4)
                            ->schema([

                                Forms\Components\Select::make('company_id')
                                    ->translateLabel()
                                    ->label(__('car.company'))
                                    ->relationship('company', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\TextInput::make('management_no')
                                    ->translateLabel()
                                    ->label('car.management_no')
                                    ->numeric(),
                                Forms\Components\TextInput::make('plate_no')
                                    ->translateLabel()
                                    ->label('car.plate_no')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\DatePicker::make('insurance_expiration_date')
                                    ->translateLabel()
                                    ->label('car.insurance_expiration_date')
                                    ->required(),
                                Forms\Components\DatePicker::make('adv_expiration_date')
                                    ->translateLabel()
                                    ->label('car.adv_expiration_date'),
                            ]),

                        Section::make(__('car.financial_details'))
                            ->collapsible()
                            ->schema([
                                Forms\Components\Toggle::make('has_installment')
                                    ->translateLabel()
                                    ->label('car.has_installment')
                                    ->required(),
                                Forms\Components\TextInput::make('installment_company')
                                    ->translateLabel()
                                    ->label('car.installment_company')
                                    ->maxLength(255),
                            ]),

                    ]),

                Group::make()
                    ->columnSpan(1)
                    ->schema([

                        Section::make(__('car.driver_details'))
                            ->collapsible()
                            ->schema([
                                Forms\Components\Select::make('driver_id')
                                    ->translateLabel()
                                    ->label('car.driver')
                                    ->relationship('driver', 'name')
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('technician_id')
                                    ->translateLabel()
                                    ->label('car.technician')
                                    ->relationship('technician', 'name')
                                    ->searchable()
                                    ->preload(),

                            ]),

                        Forms\Components\TextInput::make('notes')
                            ->translateLabel()
                            ->label('car.notes')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('active')
                            ->translateLabel()
                            ->label('car.active')
                            ->required(),
                    ]),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->translateLabel()
                    ->label('car.car_no')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->translateLabel()
                    ->label('car.company')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->translateLabel()
                    ->label('car.brand')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type.name')
                    ->translateLabel()
                    ->label('car.type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver.department.name')
                    ->translateLabel()
                    ->label('car.department')
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver.name')
                    ->translateLabel()
                    ->label('car.driver')
                    ->searchable()
                    ->description(fn (Car $record): string => $record->technician->name ?? '')
                    ->sortable(),
                Tables\Columns\TextColumn::make('management_no')
                    ->translateLabel()
                    ->label('car.management_no')
                    ->sortable(),
                Tables\Columns\TextColumn::make('plate_no')
                    ->translateLabel()
                    ->label('car.plate_no')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->translateLabel()
                    ->label('car.year')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('insurance_expiration_date')
                    ->translateLabel()
                    ->label('car.insurance_expiration_date')
                    ->date('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('passengers_no')
                    ->translateLabel()
                    ->label('car.passengers_no')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('adv_expiration_date')
                    ->translateLabel()
                    ->label('car.adv_expiration_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_installment')
                    ->translateLabel()
                    ->label('car.has_installment')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\TextColumn::make('installment_company')
                    ->translateLabel()
                    ->label('car.installment_company')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('notes')
                    ->translateLabel()
                    ->label('car.notes')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->translateLabel()
                    ->label('car.active')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
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
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
