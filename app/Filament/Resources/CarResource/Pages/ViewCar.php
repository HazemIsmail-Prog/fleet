<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use App\Models\Action as ModelsAction;
use App\Models\Driver;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Infolists\Components\Actions as ComponentsActions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewCar extends ViewRecord
{
    protected static string $resource = CarResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ComponentsActions::make([
                    Action::make('assign')
                        ->button()
                        ->outlined()
                        ->color('success')
                        ->translateLabel()
                        ->label('car.assign')
                        ->modalSubmitActionLabel(__('car.save'))
                        ->slideOver()
                        ->modalWidth('lg')
                        ->visible(fn ($record) => $record->driver_id == null)
                        ->form([
                            DatePicker::make('date')
                                ->translateLabel()
                                ->label('car.date')
                                ->default(today())
                                ->required(),
                            TimePicker::make('time')
                                ->translateLabel()
                                ->label('car.time')
                                ->default(now())
                                ->seconds(false)
                                ->required(),
                            Select::make('driver_id')
                                ->translateLabel()
                                ->label('car.driver')
                                ->required()
                                ->options(Driver::pluck('name', 'id'))
                                ->searchable(),
                            TextInput::make('kilos')
                                ->translateLabel()
                                ->label('car.kilos')
                                ->required()
                                ->numeric(),
                            Radio::make('fuel')
                                ->translateLabel()
                                ->label('car.fuel')
                                ->required()
                                ->options([
                                    '0' => __('car.empty'),
                                    '1' => '1/4',
                                    '2' => '1/2',
                                    '3' => __('car.full'),
                                ])
                                ->default('1'),
                            TextInput::make('notes')
                                ->translateLabel()
                                ->label('car.notes'),
                        ])->action(function ($record, $data) {
                            ModelsAction::create([
                                'car_id' => $record->id,
                                'driver_id' => $data['driver_id'],
                                'user_id' => auth()->id(),
                                'type' => 'assign',
                                'notes' => $data['notes'],
                                'date' => $data['date'],
                                'time' => $data['time'],
                                'fuel' => $data['fuel'],
                                'kilos' => $data['kilos'],
                            ]);

                            $record->driver_id = $data['driver_id'];
                            $record->save();

                            $this->refreshFormData([
                                'actions',
                            ]);
                        }),




                    Action::make('unassign')
                        ->button()
                        ->outlined()
                        ->color('danger')
                        ->translateLabel()
                        ->label('car.unassign')
                        ->modalDescription(function ($record) {
                            return $record->driver->name;
                        })
                        ->modalSubmitActionLabel(__('car.save'))
                        ->slideOver()
                        ->modalWidth('lg')
                        ->visible(fn ($record) => $record->driver_id != null)
                        ->form([
                            DatePicker::make('date')
                                ->translateLabel()
                                ->label('car.date')
                                ->default(today())
                                ->required(),
                            TimePicker::make('time')
                                ->translateLabel()
                                ->label('car.time')
                                ->default(now())
                                ->seconds(false)
                                ->required(),
                            TextInput::make('kilos')
                                ->translateLabel()
                                ->label('car.kilos')
                                ->required()
                                ->numeric(),
                            Radio::make('fuel')
                                ->translateLabel()
                                ->label('car.fuel')
                                ->required()
                                ->options([
                                    '0' => __('car.empty'),
                                    '1' => '1/4',
                                    '2' => '1/2',
                                    '3' => __('car.full'),
                                ])
                                ->default('1'),
                            TextInput::make('notes')
                                ->translateLabel()
                                ->label('car.notes'),
                        ])->action(function ($record, $data) {
                            ModelsAction::create([
                                'car_id' => $record->id,
                                'driver_id' => $record->driver_id,
                                'user_id' => auth()->id(),
                                'type' => 'unassign',
                                'notes' => $data['notes'],
                                'date' => $data['date'],
                                'time' => $data['time'],
                                'fuel' => $data['fuel'],
                                'kilos' => $data['kilos'],
                            ]);

                            $record->driver_id = null;
                            $record->technician_id = null;
                            $record->save();
                        }),
                ])
                    ->columnSpanFull(),
                Group::make()
                    ->columns(2)
                    ->columnSpan(1)
                    ->schema([
                        TextEntry::make('notes')
                            ->translateLabel()
                            ->label('car.notes'),
                        TextEntry::make('active')
                            ->translateLabel()
                            ->label('car.active'),


                    ]),

                Tabs::make('Label')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make(__('car.manufacture_details'))
                            ->columns(4)
                            ->schema([
                                TextEntry::make('brand.name')
                                    ->translateLabel()
                                    ->label('car.brand'),
                                TextEntry::make('type.name')
                                    ->translateLabel()
                                    ->label('car.type'),
                                TextEntry::make('year')
                                    ->translateLabel()
                                    ->label('car.year'),
                                TextEntry::make('passengers_no')
                                    ->translateLabel()
                                    ->label('car.passengers_no'),
                            ]),
                        Tabs\Tab::make(__('car.license_details'))
                            ->columns(5)
                            ->schema([
                                TextEntry::make('company.name')
                                    ->translateLabel()
                                    ->label(__('car.company')),
                                TextEntry::make('management_no')
                                    ->translateLabel()
                                    ->label('car.management_no'),
                                TextEntry::make('plate_no')
                                    ->translateLabel()
                                    ->label('car.plate_no'),
                                TextEntry::make('insurance_expiration_date')
                                    ->translateLabel()
                                    ->label('car.insurance_expiration_date'),
                                TextEntry::make('adv_expiration_date')
                                    ->translateLabel()
                                    ->label('car.adv_expiration_date'),
                            ]),
                        Tabs\Tab::make(__('car.financial_details'))
                            ->columns(2)
                            ->schema([
                                TextEntry::make('has_installment')
                                    ->translateLabel()
                                    ->label('car.has_installment'),
                                TextEntry::make('installment_company')
                                    ->translateLabel()
                                    ->label('car.installment_company'),
                            ]),
                        Tabs\Tab::make(__('car.driver_details'))
                            ->visible(fn ($record) => $record->driver_id)
                            ->columns(2)
                            ->schema([
                                TextEntry::make('driver.name')
                                    ->translateLabel()
                                    ->label('car.driver'),
                                TextEntry::make('technician.name')
                                    ->translateLabel()
                                    ->label('car.technician'),
                            ]),
                    ]),

            ]);
    }
}
