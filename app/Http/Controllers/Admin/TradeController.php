<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Trade;
use App\Models\Trading;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\TradingRequest;

class TradeController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {
        
        //return $request->trading_id;
        //return request('trading_id');
        $trading = Trading::findOrFail($request->trading_id);
        $trades = $trading->trades;
    
        return view('admin.pages.trading.trade')->with('trading',$trading)->with('trades',$trades);

    }

    public function create(Request $request)
    {
        $trading = Trading::findOrFail($request->trading_id);
        return view('admin.pages.trading.trade_add')->with('trading',$trading);
    }

    public function store(Request $request)
    {
        
        // $validate = $request->validate([
        //     'date' => 'required'
        // ]);
        ///dd($request->all);
        $trade = New Trade;
        $trade->trading_id = $request->trading_id;
        $trade->date = $request->date;
        $trade->instument = $request->instument;
        $trade->script = $request->script;
        $trade->buy_sell = $request->buy_sell;
        $trade->market_condition = $request->market_condition;

        $trade->average_entry_price = $request->average_entry_price;
        $trade->average_exit_price = $request->average_exit_price;
        $trade->quantity = $request->quantity;

        $trade->save();

        return redirect()->route('trade.index',['trading_id'=>$request->trading_id])
        ->with([
            'message'    =>'Trade Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $trading = Trading::findOrFail($id);
        $date = $trading->date;
        return view('admin.pages.trading.trade',compact('date'));
        return response()->json($trading);
    }

    public function edit($id,$trading_id)
    {
        
        $trade = Trade::findOrFail($trading_id);
       
        

        //return response()->json($trading);

        return view('admin.pages.trading.trade_edit')->with('trade',$trade);
    }

    public function update(Request $request, $id,$trade_id)
    {
        
        //return $request->trading_id;
        //return $trade_id;
        
       
        $trade = Trade::findOrFail($trade_id);
        $trade->instument = $request->instument;
        $trade->script = $request->script;
        $trade->buy_sell = $request->buy_sell;
        $trade->market_condition = $request->market_condition;

        $trade->average_entry_price = $request->average_entry_price;
        $trade->average_exit_price = $request->average_exit_price;
        $trade->quantity = $request->quantity;
        $trade->save();

        

        return redirect()->route('trade.index',['trading_id'=>$id])
        ->with([
            'message'    =>'Trade Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy(Request $request, $id)
    {
        //return $tradeid;
        $trade_id =  last($request->segments());

        

        $trading = Trade::destroy($trade_id);

        return  $trading;

        if($trading){
            return redirect()->route('trade.index')
            ->with([
                'message' =>'Trade  deleted Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }

    
}
