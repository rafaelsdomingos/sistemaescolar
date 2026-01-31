<?php

namespace App\Enums;

enum Shitf : string
{
    case manha = 'manha';
    case tarde = 'tarde';
    case noite = 'noite';

    public function label(): string
    {
        return match ($this) {
            self::manha => 'Manhã',
            self::tarde => 'Tarde',
            self::noite => 'Noite',
        };
    }
}
