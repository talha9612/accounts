<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NetProfit;
class NetProfitController extends Controller
{
    public function saveData(Request $request)
    {
        
        $data = new NetProfit();
        $data->value = $request->input('key1');
        // Add more fields as needed
        $data->save();

        return response()->json(['message' => 'Data saved successfully']);
    }
}
