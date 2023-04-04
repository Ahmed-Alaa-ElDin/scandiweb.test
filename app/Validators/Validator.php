<?php

namespace App\Validators;

use App\App;

class Validator
{
    public static function unique(string $value, string $field, string $table): bool
    {
        $stat = App::db()->prepare("SELECT * FROM $table WHERE $field = :value");

        $stat->execute([
            ':value' => $value,
        ]);

        if ($stat->rowCount()) {
            return false;
        }

        return true;
    }

    public static function min(mixed $value, int|float $min): bool
    {
        if (is_string($value) && strlen($value) < $min) {
            return false;
        } elseif (is_numeric($value) && $value < $min) {
            return false;
        }

        return true;
    }

    public static function max(mixed $value, int|float $max): bool
    {
        if (is_string($value) && strlen($value) > $max) {
            return false;
        } elseif (is_numeric($value) && $value > $max) {
            return false;
        }

        return true;
    }

    public static function numeric(mixed $value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        return true;
    }

}
