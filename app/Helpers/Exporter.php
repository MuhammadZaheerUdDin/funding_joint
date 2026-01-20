<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/8/2018
 * Time: 3:49 PM
 */

namespace App\Helpers;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

/**
 * Class Exporter
 * @package App\Helpers
 */
class Exporter implements FromCollection, WithHeadings
{
    use Exportable;

    private $data;

    private $headings;


    /**
     * Exporter constructor.
     * @param $data
     * @param $headings
     */
    public function __construct($data, $headings)
    {
        $this->data = $data;

        $this->headings = $headings;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect([$this->data]);
    }


    /**
     * @method headings
     * @description Display the export header fro the file .Accepts an array of strings
     * @return array
     */
    public function headings(): array
    {
       return $this->headings;
    }

}