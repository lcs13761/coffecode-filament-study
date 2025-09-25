<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum AlignmentEnum : string implements HasLabel
{
    case LEFT = 'left';
    case CENTER = 'center';
    case RIGHT = 'right';
    case FULL = 'full';


    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::LEFT => 'Esquerda',
            self::CENTER => 'Centro',
            self::RIGHT => 'Direita',
            self::FULL => 'Largura Total',
        };
    }
}
