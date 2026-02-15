<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait GeneratesNumber
{
    /**
     * Generate unique number with prefix
     */
    public static function generateNumber(string $prefix, int $digits, string $table, string $column): string
    {
        $year = date('Y');
        $pattern = $prefix . '-' . $year . '-';

        // Get last number for this year
        $lastRecord = DB::table($table)
            ->where($column, 'like', $pattern . '%')
            ->orderBy($column, 'desc')
            ->first();

        if ($lastRecord) {
            // Extract number and increment
            $lastNumber = (int) substr($lastRecord->$column, strlen($pattern));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $pattern . str_pad($newNumber, $digits, '0', STR_PAD_LEFT);
    }
}
