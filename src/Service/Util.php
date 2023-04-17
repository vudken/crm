<?php

namespace App\Service;

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
}
