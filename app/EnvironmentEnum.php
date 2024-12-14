<?php

namespace App;

enum EnvironmentEnum: string
{
    case PRODUCTION = 'PRODUCTION';
    case PREPRODUCTION = 'PRE-PRODUCTION';
    case UAT = 'UAT';

    public static function toArray(): array
    {
        return array_column(EnvironmentEnum::cases(), 'value');
    }
}
