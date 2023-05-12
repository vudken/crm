<?php

namespace App\Service;

use DateTime;
use Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;

class Util
{
    public static function formatTaskAddress(String $address): String
    {
        return trim(explode(',', $address)[0]);
    }

    public static function formatTaskDate(String $timestamp): String
    {
        $dateTime = new DateTime($timestamp);
        return $dateTime->format('d.m.Y');
    }

    public static function formatDateForFC(string $timestamp): string
    {
        $dateTime = DateTime::createFromFormat('d.m.Y', $timestamp);

        if (!$dateTime) {
            throw new Exception('Invalid date format: ' . $timestamp . PHP_EOL . 'Proper date format: d.m.Y' . PHP_EOL . 'An example of a proper date: 01.12.2022 or 1.12.22');
        }

        $date = $dateTime->format('Y-m-d');
        $year = $dateTime->format('y');

        return '20' . $year . substr($date, 4);
    }

    public static function formatTaskTime(String $timestamp): String
    {
        $dateTime = new DateTime($timestamp);
        return $dateTime->format('H:i');
    }

    public static function getPostalCodeFromAddress(String $address): String
    {
        $postalCode = 'No info';
        if (preg_match('/[Ll][Vv]-[0-9]{4}/', $address, $matches)) {
            $postalCode = $matches[0];
        }

        return mb_strtoupper($postalCode);
    }

    public function getColumnLetterByValue(Row $row, String $value): String
    {
        foreach ($row->getCellIterator() as $cell) {
            if ($cell->getValue() == $value) {
                $column = $cell->getColumn();
                return $column;
            }
        }

        throw new Exception('Column not found');
    }
}
