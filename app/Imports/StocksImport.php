<?php

namespace App\Imports;

use App\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
class StocksImport implements ToCollection
{
    use Importable,SkipsFailures;
    private $rows = 0;
    /**
     * validating data
     */
    public function withValidation(){

    }
    
    public function getAmount($money)
    {
        $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);
    
        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;
    
        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);
    
        return (float) str_replace(',', '.', $removedThousandSeparator);
    }
    /**
     * collection
     */
    public function collection(Collection $collection)
    {
        Validator::make($collection->toArray(),
        [
            
            
        ]
    )->validate();
       foreach ($collection as $datarow) {
        
            $curr = $this->getAmount($datarow[4]);

            if($datarow[3] < 10){
                continue;
            }elseif($curr < 5 || $curr > 1000)
            {
                continue;
            }elseif($datarow[5] != 'yes'){
                continue;
            }
            ++$this->rows;
           $model = Stock::create([
                'productCode' => $datarow[0],
                'productName' => $datarow[1],
                'productDescription' => $datarow[2],
                'stock' => $datarow[3], 
                'costInGbp' => $curr, 
                'discontinued' => $datarow[5]
            ]);
    }
    return $model;
    }
/**
     * headings
     */
    public function withHeadingRow(){

    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
    public function onFailure(Failure ...$failures)
{
    // Handle the failures how you'd like.
}
   
}
