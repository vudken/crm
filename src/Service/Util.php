<?php

namespace App\Service;

use App\Entity\Task;
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
    
    // public static function formatFcTaskForView(Task $task): Task
    // {
    //     // $task = $task->setAddress(explode(",", $task->getAddress())[1]);
    //     $task = $task->setAddress(self::getPostalCodeFromAddress($task->getAddress()));
    //     // $task = $task->setTimestamp(self::formatDate($task->getTimestamp()));
    //     // $task = $task->setCreatedAtTimestamp(self::formatDate($task->getCreatedAtTimestamp()));

    //     return $task;
    // }
}
