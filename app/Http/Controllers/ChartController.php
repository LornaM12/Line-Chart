<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class ChartController extends Controller
{
    

    public function LineChart()
    {
        $result = DB::select(DB::raw("SELECT storeinfo.store_name,SUM(sales.total_amount) as SALES,SUM(expenses.amount) AS EXPENSE FROM storeinfo
        LEFT JOIN sales ON sales.store_id = storeinfo.store_id
        LEFT JOIN expenses ON expenses.store_id = storeinfo.store_id
        GROUP BY storeinfo.store_id"));
        $data = "";
        foreach ($result as $val){
            $data.=" ['".$val->store_name."',".$val->SALES.", ".$val->EXPENSE."],";
        }
        dd($data);
        return view('line-chart');

    }
}
