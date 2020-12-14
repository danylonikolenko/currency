<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakeCurrencyList extends Controller
{
    function makeCurrencyList(){

        $url = "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        echo "<pre>";
        print_r(json_decode($output));
        $currencyListStd = json_decode($output);
        $currencyList = array();
        $date = date('Y-m-d h:i:s');



        $result = DB::table('currency')->get()->toArray();
        if(count($result) == 0){
            foreach ($currencyListStd as $currency){
                DB::table('currency')->insert([
                    'ccy'=>$currency->ccy,
                    'base_ccy'=>$currency->base_ccy,
                    'buy'=>$currency->buy,
                    'sale'=>$currency->sale,
                    'created_at' => $date
                ]);
            }
            echo "inserted";
        }else{
            $id = 1;
            foreach ($currencyListStd as $currency){
                DB::table('currency')->where('id',$id)->update([
                    'ccy'=>$currency->ccy,
                    'base_ccy'=>$currency->base_ccy,
                    'buy'=>$currency->buy,
                    'sale'=>$currency->sale,
                    'updated_at'=>$date
                ]);
                $id++;
            }
            echo "updated";
        }

    }
}
