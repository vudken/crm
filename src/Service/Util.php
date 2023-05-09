<?php

namespace App\Service;

use DateTime;
use Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;

class Util
{
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

    public static function formatDate(String $date): String
    {
        $date = new DateTime($date);
        return $date->format('d.m.Y');
    }

    public static function getPostalCodeFromAddress(String $address): String
    {
        $postalCode = 'No info';
        if (preg_match('/[Ll][Vv]-[0-9]{4}/', $address, $matches)) {
            $postalCode = $matches[0];
        }

        return mb_strtoupper($postalCode);
    }

    public static function formatAddress(String $address): String
    {
        return explode(',', $address)[0];
    }

    public static function formatDateForFC(string $date): string
    {
        $dateTime = DateTime::createFromFormat('d.m.Y', $date);
        
        if (!$dateTime) {
            throw new Exception('Invalid date format: ' . $date . PHP_EOL . 'Proper date format: d.m.Y' . PHP_EOL . 'An example of a proper date: 01.12.2022 or 1.12.22');
        } 

        $formattedDate = $dateTime->format('Y-m-d');
        $year = $dateTime->format('y');

        return '20' . $year . substr($formattedDate, 4);
    }
}
