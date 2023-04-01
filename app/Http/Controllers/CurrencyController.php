<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CurrencyResource;

class CurrencyController extends Controller
{
    public function pingCheck(){

        try {
            // $state = DB::connection()->getSchemaGrammar();
            $dbName = DB::connection()->getName();
            // $dbName->in_array();
            // $dbName = DB::connection()->getDatabaseName();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return response()->json(['error'=>$error , 'status'=>'failed'],202);
            //throw $th;
        }
        return response()->json(['Database'=>$dbName,'version'=>'0.1' , 'status'=>'done'],200) ;

        return CurrencyResource::collection(Currency::all())->additional([ "result" =>["ready"=> "true"]]);
    }

    public function getPair(){

        return CurrencyResource::collection(Currency::with("ConvertionRate:currency_id,value")
                                ->get(["firstCurrency" ,"secondCurrency","id"]))
                                ->additional(['error'=>"" , 'status'=>'done']);
    }

    public function addPair(Request $request) {
        // $currency = Currency::find()
        // $request = request();
        // $currency = Currency::find($request->input('currency_id'));
        // $results = $request->all();
        try {
            $request->validate([

                'firstCurrency'=>'required|string|max:3',
                'secondCurrency'=>'required|string|max:3',
                'convertion_rates'=>'required|array',

            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return response()->json(['error'=>$error , 'status'=>'failed'],202);
            //throw $th;
        }

        $currency = Currency::create([
            'firstCurrency'=>$request->firstCurrency,
            'secondCurrency'=>$request->secondCurrency
        ]);

        $convertion_rates = $currency->ConvertionRate()->create($request->convertion_rates);

        return response()->json(['error'=>'' ,'message'=>"la paire {$currency} à ete enregistrées", 'status'=>'done'],200) ;




    }
}
