@extends('admin.layout.admin')

@section('title','Add Trading')

@section('trading','active')

@section('style')
@endsection


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Trades</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('trading.index')}}">Trade</a></li>
                            <li class="breadcrumb-item active">Add Trade</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">
        
        <form role="form" method="post" action="{{route('trade.store',['trading_id'=>$trading->id])}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <div class="row">
                <div class="col-md-2">
                        <label for="projectName"><b>Date</b></label>
                        <input type="date" class="form-control" name="date"  placeholder="Script name" value="{{$trading->date}}{{old("script")}}">
                    </div>
                    <div class="col-md-2">
                        <label for="pro-end-date"><b>Instument</b></label>
                        <select class="form-control" name="instument">
                            <option value="">-Select Instument-</option>
                            <option value="stock">Stocks</option>
                            <option value="option">Options</option>
                            <option value="future">Futures</option>
                        </select>
                    </div><!--end col-->
                    <div class="col-md-2">
                        <label for="projectName"><b>Script</b></label>
                        <input type="text" class="form-control" name="script"  placeholder="Script name" value="{{old("script")}}">
                    </div>

                    <div class="col-md-2">
                        <label for="pro-end-date"><b>Market Condition</b></label>
                        <select class="form-control" name="market_condition">
                            <option value="">-Select-</option>
                            <option value="Up Trend">Up Trend</option>
                            <option value="Down Trend">Down Trend</option>
                            <option value="Sideways">Sideways</option>
                        </select>
                    </div><!--end col-->
                    
                    <div class="col-md-2">
                        <label for="pro-end-date"><b>Buy/Sell</b></label>
                        <select class="form-control" name="buy_sell">
                            <option value="">-Select-</option>
                            <option value="buy">Buy</option>
                            <option value="sell">Sell</option>
                        </select>
                    </div><!--end col-->

                    <div class="col-md-2">
                        <label for="projectName"><b>Quantity</b></label>
                        <input type="text" class="form-control" name="quantity"  placeholder="Quantity" value="{{old("quantity")}}">
                    </div>

                    

                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label for="pro-end-date"><b>Stratergy/Setup</b></label>
                        <input type="text" class="form-control" name="stratergy"   value="{{old("stratergy")}}">
                    </div><!--end col-->

                    <div class="col-md-2">
                        <label for="projectName"><b>Entry Price</b></label>
                        <input type="number" step="any" class="form-control" name="average_entry_price"   value="{{old("average_entry_price")}}">
                    </div>
                    <div class="col-md-2">
                        <label for="projectName"><b>Entry Time</b></label>
                        <input type="time" class="form-control" name="entry_time"   value="{{old("entry_time")}}">
                    </div>
                    
                    <div class="col-md-2">
                        <label for="projectName"><b>Exit Price</b></label>
                        <input type="number" step="any" class="form-control" name="average_exit_price"  value="{{old("average_exit_price")}}">
                    </div>

                    <div class="col-md-2">
                        <label for="projectName"><b>Exit Time</b></label>
                        <input type="time" class="form-control" name="exit_time"   value="{{old("exit_time")}}">
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="projectName"><b>Entry Reason</b></label>
                        <textarea name="entry_reason" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="projectName"><b>Exit Reason</b></label>
                        <textarea name="exit_reason" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="projectName"><b>Pros</b></label>
                        <textarea name="trade_pros" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="projectName"><b>Cons</b></label>
                        <textarea name="trade_cons" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 mt-1">
                        <label for="projectName"><b>Remarks</b></label>
                        <textarea name="remarks" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Add Trade</button>
                <a href="{{route('trade.index',['trading_id'=>15,'date'=>request('date')])}}" class="btn btn-secondary waves-effect waves-ligh btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
