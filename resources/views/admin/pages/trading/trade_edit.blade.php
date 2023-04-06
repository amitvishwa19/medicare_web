@extends('admin.layout.admin')

@section('title','Edit Trade')

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
                            <li class="breadcrumb-item"><a href="{{route('trade.index',['trading_id'=>request('trading_id')])}}">Trades</a></li>
                            <li class="breadcrumb-item active">Add Trade</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">
        
        <form role="form" method="post" action="{{route('trade.update',['trading_id'=>request('trading_id'), $trade->id])}}" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label for="pro-end-date"><b>Instument</b></label>
                        <select class="form-control" name="instument">
                            <option value="">-Select Instument-</option>
                            <option value="stock" {{$trade->instument == 'stock' ? 'selected' : "" }}>Stocks</option>
                            <option value="option" {{$trade->instument == 'option' ? 'selected' : "" }}>Options</option>
                            <option value="future" {{$trade->instument == 'future' ? 'selected' : "" }}>Futures</option>
                        </select>
                    </div><!--end col-->
                    <div class="col-md-2">
                        <label for="projectName"><b>Script</b></label>
                        <input type="text" class="form-control" name="script"  placeholder="Script name" value="{{$trade->script}}{{old("script")}}">
                    </div>

                    <div class="col-md-2">
                        <label for="pro-end-date"><b>Market Condition</b></label>
                        <select class="form-control" name="market_condition">
                            <option value="">-Select-</option>
                            <option value="Up Trend" {{$trade->market_condition == 'Up Trend' ? 'selected' : "" }}>Up Trend</option>
                            <option value="Down Trend" {{$trade->market_condition == 'Down Trend' ? 'selected' : "" }}>Down Trend</option>
                            <option value="Sideways" {{$trade->market_condition == 'Sideways' ? 'selected' : "" }}>Sideways</option>
                        </select>
                    </div><!--end col-->
                    
                    <div class="col-md-2">
                        <label for="pro-end-date"><b>Buy/Sell</b></label>
                        <select class="form-control" name="buy_sell">
                            <option value="">-Select-</option>
                            <option value="buy" {{$trade->buy_sell == 'buy' ? 'selected' : "" }}>Buy</option>
                            <option value="sell" {{$trade->buy_sell == 'sell' ? 'selected' : "" }}>Sell</option>
                        </select>
                    </div><!--end col-->

                    <div class="col-md-2">
                        <label for="projectName"><b>Quantity</b></label>
                        <input type="text" class="form-control" name="quantity"  placeholder="Quantity" value="{{$trade->quantity}}{{old("quantity")}}">
                    </div>

                    

                </div>
            </div>

            <div class="form-group">
                <div class="row">

                    <div class="col-md-2">
                        <label for="pro-end-date"><b>Stratergy/Setup</b></label>
                        <input type="text" class="form-control" name="stratergy"   value="{{$trade->stratergy}}{{old("stratergy")}}">
                    </div><!--end col-->

                    <div class="col-md-2">
                        <label for="projectName"><b>Entry Price</b></label>
                        <input type="number"  step="any" class="form-control" name="average_entry_price"   value="{{$trade->average_entry_price}}{{old("average_entry_price")}}">
                    </div>
                    <div class="col-md-2">
                        <label for="projectName"><b>Entry Time</b></label>
                        <input type="time" class="form-control" name="entry_time"   value="{{old("entry_time")}}">
                    </div>
                    
                    <div class="col-md-2">
                        <label for="projectName"><b>Exit Price</b></label>
                        <input type="number" step="any" class="form-control" name="average_exit_price"  value="{{$trade->average_exit_price}}{{old("average_exit_price")}}">
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
                <button class="btn btn-info waves-effect waves-light btn-sm">Update Trade</button>
                <a href="{{route('trade.index',['trading_id'=>request('trading_id')])}}" class="btn btn-secondary waves-effect waves-ligh btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
