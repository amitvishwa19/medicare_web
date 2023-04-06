<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Trading;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\TradingRequest;

class TradingController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {
        //return 'ok';
        // $total_trades = 5;
        // $tradings = Trading::orderby('date','desc')->get();

       
        // foreach($tradings as $trading){
        //     $total_trades += $trading->trades->count();
        //     return $total_trades;
        // };
       

        if ($request->ajax()) {
            $tradings = Trading::orderby('date','desc')->latest('id');

            return Datatables::of($tradings)
            ->editColumn('created_at',function(Trading $trading){
                return $trading->created_at->diffForHumans();
            })
            ->editColumn('date',function(Trading $trading){
                return '<a href="'.route('trade.index',['trading_id'=>$trading->id]).'">'.date('d M Y', strtotime($trading->date)).'</a>';
            })
            ->addColumn('trades',function(Trading $trading){
                return $trading->trades->count();
            })
            ->addColumn('traded_amount',function(Trading $tradings){
                //$total_buy_price = $tradings->trades()->sum('average_entry_price');
                //$total_quantity = 50;
                //$total_traded_capital = $total_buy_price;
                $total_buy_price = 0;
                
                $buy_price = 0;
                $buy_quantity = 0;
                $loop_count = 0;
                //return $tradings->trades;

                foreach($tradings->trades as $trade){
                    $total_buy_price +=  $trade->average_entry_price * $trade->quantity;
                    //$buy_quantity+=  $trade->quantity;
                    //$loop_count = +1;
                };

                //return 5;
                $total_traded_capital = 0;
                return '₹ '.  round($total_buy_price,0);
            })
            ->addColumn('t_pnl',function(Trading $tradings){
                
                $total_pnl = 0;
                foreach($tradings->trades as $trade){
                    $total_pnl += ($trade->average_exit_price * $trade->quantity) - ($trade->average_entry_price * $trade->quantity);


                };
               
                if(round($total_pnl,0) < 0 ){
                    return '<span class="badge badge-soft-danger">₹ ' . round($total_pnl,0) . '</span>';
                }elseif(round($total_pnl,0) > 0 ){
                    return '<span class="badge badge-soft-success">₹ ' . round($total_pnl,0) . '</span>';
                }else{
                    return '<span class="badge badge-soft-primary">₹ ' . round($total_pnl,0) . '</span>';
                }


                
            })
            ->addColumn('n_pnl',function(Trading $tradings){

                $net_pnl = 0;
                $total_pnl = 0;
                foreach($tradings->trades as $trade){
                    $total_pnl += ($trade->average_exit_price * $trade->quantity) - ($trade->average_entry_price * $trade->quantity);
                };


                $net_pnl = round($total_pnl - $tradings->t_charges,0);

                if(round($net_pnl,0) < 0 ){
                    return '<span class="badge badge-soft-danger">₹ ' . round($net_pnl,0) . '</span>';
                }elseif(round($net_pnl,0) > 0 ){
                    return '<span class="badge badge-soft-success">₹ ' . round($net_pnl,0) . '</span>';
                }else{
                    return '<span class="badge badge-soft-primary">₹ ' . round($net_pnl,0) . '</span>';
                }
                
                
            })
            ->addColumn('roi',function(Trading $tradings){


                $total_buy_amount = 0;
                $total_sell_amount = 0;
                $roi = 0;
              
                foreach($tradings->trades as $trade){
                    $roi +=  (($trade->average_exit_price * $trade->quantity) - ($trade->average_entry_price * $trade->quantity)) / ($trade->average_entry_price * $trade->quantity) * 100;
                    $total_buy_amount += $trade->average_entry_price * $trade->quantity ;
                    $total_sell_amount += $trade->average_exit_price * $trade->quantity;
                };

                //$profit = ($total_sell_amount - $total_buy_amount);
                //$net_traded_value = 0 ? 0 : (($total_sell_amount - $total_buy_amount) / $total_buy_amount);

                $roi = $total_buy_amount == 0 ? 0 : (($total_sell_amount - $total_buy_amount) / $total_buy_amount) * 100 ;



                //$roi = 'LOL';
                //$roi = (($total_sell_amount - $total_buy_amount) / $total_buy_amount) * 100;
                //$roi = round(($total_sell_amount - $total_buy_amount)  / ($total_buy_amount),0);
                // if(round($roi,0) < 0 ){
                //     return '<span class="badge badge-soft-danger">' . round($roi,0) . '% </span>';
                // }else{
                //     return '<span class="badge badge-soft-success">' . round($roi,0) . '% </span>';
                // }
                return round($roi,1.0) . ' %';
                
            
            })
            ->addColumn('t_charges',function(Trading $tradings){

                if($tradings->t_charges <= 0){
                    return '₹ 0';
                }else{
                    return '₹ ' . $tradings->t_charges;
                }

                
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('trading.edit',$data->id).'" class="badge badge-soft-success mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-secondary delete mr-2 delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','date','trades','roi','t_pnl','n_pnl','roi'])
            ->make(true);


        }

        $tradings = Trading::orderby('date','desc')->get();

        $total_trades = 0;
        $total_pnl = 0;
        $total_charges = 0;

        
        foreach($tradings as $trading){
            $total_trades += $trading->trades->count();
            
            foreach($trading->trades as $trade){
                $total_pnl += ($trade->average_exit_price - $trade->average_entry_price) * $trade->quantity;
            }

            $total_charges += $trading->t_charges;
        };


        return view('admin.pages.trading.trading')->with('tradings',$tradings)
                                                  ->with('trades',$total_trades)
                                                  ->with('t_pnl',round($total_pnl,0))
                                                  ->with('t_charges',$total_charges);

    }

    public function create()
    {
        return view('admin.pages.trading.trading_add');
    }

    public function store(Request $request)
    {
        // $validate = $request->validate([
        //     'date' => 'required'
        // ]);

        $trading = New Trading;
        $trading->user_id = auth()->user()->id;
        $trading->date = $request->date;
        $trading->save();

        return redirect()->route('trading.index')
        ->with([
            'message'    =>'Trading Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show(Request $request, $id)
    {
        
        $trading = Trading::findOrFail($request->trading_id);
        $trades = $trading->trades;
        return view('admin.pages.trading.trade')->with('trading',$trading)->with('trades',$trades);
        return response()->json($trading);
    }

    public function edit($id)
    {
        $trading = Trading::findOrFail($id);

        //return response()->json($trading);

        return view('admin.pages.trading.trading_edit',compact('trading'));
    }

    public function update(Request $request, $id)
    {

        //dd($request->all());
        // $validate = $request->validate([
        //     'name' => 'required'
        // ]);

        $trading = Trading::findOrFail($id);
        $trading->date = $request->date;
        $trading->t_charges = $request->t_charges;
        $trading->save();

        return redirect()->route('trading.index')
        ->with([
            'message'    =>'Trading Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        
        

        $trading = Trading::destroy($id);

        if($trading){
            return redirect()->route('trading.index')
            ->with([
                'message'    =>'Trading Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }

    
}
