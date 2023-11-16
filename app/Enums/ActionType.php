<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ActionType: string implements HasLabel,HasColor,HasIcon
{
    case ASSIGN = 'assign';
    case UNASSIGN = 'unassign';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ASSIGN => __('car.assign'),
            self::UNASSIGN => __('car.unassign'),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::ASSIGN => '',
            self::UNASSIGN => '',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ASSIGN => 'success',
            self::UNASSIGN => 'danger',
        };
    }
}