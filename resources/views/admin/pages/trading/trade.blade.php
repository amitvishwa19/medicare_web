@extends('admin.layout.admin')

@section('title','Trading')

@section('trading','active')


@section('style')
    {{-- Datatable --}}
    <link href="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    {{-- Datatable --}}
@endsection



@section('content')
    <div class="content-area">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Trade</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item"><a href="{{route('trading.index')}}">Trade Book</a></li>
                                <li class="breadcrumb-item active">{{$trading->date}}</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="{{route('trade.create',$trading->id)}}"  class="btn btn-info waves-effect waves-light btn-sm" >
                                Add New Trade
                            </a>
                        </div>
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="">

                    @if($trades->count() > 0)
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th style=""><label for=""><b>Script</b></label></th>
                                    <th style=""><label for=""><b>Instument</b></label></th>
                                    <th style=""><label for=""><b>Trade Type</b></label></th>
                                    <th style=""><label for=""><b>Avg Buy</b></label></th>
                                    <th style=""><label for=""><b>Avg Sell</b></label></th>
                                    <th style=""><label for=""><b>Quantity</b></label></th>
                                    <th style=""><label for=""><b>Total Buy Value</b></label></th>
                                    <th style=""><label for=""><b>Total Sell Value</b></label></th>
                                    <th style=""><label for=""><b>Returns</b></label></th>
                                    <th style=""><label for=""><b>ROI</b></label></th>
                                    <th style="width:8%"><label for=""><b>Actions</b></label></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trades as $trade)
                                <tr>
                                    <td>
                                        {{$trade->script}}
                                    </td>
                                    <td>
                                        {{ucfirst($trade->instument)}}
                                    </td>
                                    <td>
                                    {{ucfirst($trade->buy_sell)}}
                                    </td>
                                    <td>
                                        {{$trade->average_entry_price}}
                                    </td>
                                    <td>
                                        {{$trade->average_exit_price}}
                                    </td>
                                    <td>
                                        {{$trade->quantity}}
                                    </td>
                                    <td>
                                        {{$trade->average_entry_price * $trade->quantity}}
                                        
                                    </td>
                                    <td>
                                        {{$trade->average_exit_price * $trade->quantity}}
                                    </td>
                                    <td>
                                        {{($trade->average_exit_price * $trade->quantity) - ($trade->average_entry_price * $trade->quantity)}}
                                    </td>
                                    <td>
                                        {{ round( (($trade->average_exit_price * $trade->quantity) - ($trade->average_entry_price * $trade->quantity)) / ($trade->average_entry_price * $trade->quantity) * 100,0 ) }} %
                                    </td>
                                    <td>
                                        <a href="{{route('trade.edit',[$trade->id,'trading_id'=>$trading->id])}}" class="badge badge-soft-success mr-2"><small>Edit</small></a>
                                        <a href="javascript:void(0);" id="{{$trade->id}}" class="badge badge-secondary delete mr-2 delete"><small>Delete</small></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger border-0 p-3" role="alert">
                            <strong>Oh Snap!</strong> No Trade(s) found for date, <a href="{{route('trade.create',$trading->id)}}">Add new Trade</a>.
                        </div>
                    @endif
                </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



@section('scripts')

    {{-- Datatable JS --}}
        <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    {{-- Datatable JS --}}



    <script>

        $(function(){
            'use strict'

            //Datatable
           


            //Action Delete function
            $(document).on('click','.delete',function(){
                 var tradeid =  $(this).attr('id');
                 swalWithBootstrapButtons({
                     title: "Delete Selected Trade?",
                     text: "You won't be able to revert this!",
                     type: "warning",
                     showCancelButton: true,
                     confirmButtonText: "Delete",
                     cancelButtonText: "Cancel",
                     reverseButtons: true
                 }).then(result => {
                     if (result.value) {
                     $.ajax({
                         url: "trade/"+tradeid,
                         type:"post",
                         data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                         success: function(result){
                           
                            location.reload();
                            toast({
                                type: "success",
                                title: "Trade Deleted Successfully"
                            });
                         }
                     });
                     }
                 });
            });

        });

    </script>

@endsection
