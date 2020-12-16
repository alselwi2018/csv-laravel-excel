<?php

namespace App\Exports;

use App\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StocksExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Stock::all();
    }

    /**
     * headings
     */
    public function headings(): array
    {
        return [
            'product Data Id',
           'product Code',
            'product Name',
            'product Description',
            'stock',
           'cost In Gbp',
           'discontinued',
            'dtm Added', 
            'dtm Discontinued',
            'created At',
            'updated At'
        ];
    }
}
