<?php

namespace App\Http\Controllers;

use App\Exports\StocksExport;
use App\Imports\StocksImport;
use App\stock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class Wrencsv extends Controller
{
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExport(){
        $stocks = stock::all();
       
        
        return view('import')->with(compact('stocks'));
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export(){

        return Excel::download(new StocksExport, 'stocks.xlsx');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request){
        try
        {
            if($request->file('csv')){
        $file = $request->file('csv')->store('import');
            }else{

                return back()->withErrors('No File Selected');
            }
        $import = new StocksImport;
        
        //$import->import($file);
        Excel::import($import, $file);
         return back()->withStatus('CSV file imported the rows are '.$import->getRowCount());
        }catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            $failures = $e->failures();
     
     foreach ($failures as $failure) {
         $failure->row(); // row that went wrong
         $failure->attribute(); // either heading key (if using heading row concern) or column index
         $failure->errors(); // Actual error messages from Laravel validator
         $failure->values(); // The values of the row that has failed.
            
            foreach($failure->errors() as $fe){
            return back()->withErrors($failure->row().' '.$failure->attribute().' '.$fe);
            }
     }  
        }catch(\Exception $err){
            foreach($err as $er){
            return back()->withErrors($er[2]);
            }
        }
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
        stock::truncate();
        return back();
    }
    
}
