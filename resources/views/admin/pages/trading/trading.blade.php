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
                            <h4 class="page-title">Trading Journal</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Trade Book </li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="{{route('trading.create')}}"  class="btn btn-info waves-effect waves-light btn-sm" >
                                Add New
                            </a>
                        </div>
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->


        <div class="row">  
            <div class="col-12">
                <div class="card calendar-cta">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <img src="assets/images/widgets/calendar.svg" alt="" class="" height="150">
                            </div><!--end col-->
                            <div class="col">
                                
                                <ul class="list-unstyled pro-features border-0">
                                    <li>Total Trading Sessions : {{$tradings->count()}}</li>
                                    <li>Total Trades : {{$trades}}</li>
                                    <li>Total P&L : ₹ {{$t_pnl}}</li>
                                    <li>Total Charges : ₹ {{$t_charges}}</li>
                                    <li>Net P&L : ₹ {{$t_pnl - $t_charges}}</li>
                                </ul>
                            </div><!--end col-->
                            
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div>

       

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="cards">
                    <div class="card-body table-responsive">
                        <div class="">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="">Date</th>
                                        <th style="">Trades</th>
                                        <th style="">Traded Capital</th>
                                        <th style="">Total P&L</th>
                                        <th style="">Total Charges</th>
                                        <th style="">Net P&L</th>
                                        <th style="">ROI</th>
                                        <th style="width:10%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>

                            </table>
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
            $('#datatable').DataTable({
                 processing: true,
                 serverSide: true,
                 ajax: '{!! route('trading.index') !!}',
                 columns:[
                     { data: 'date', name: 'date' },
                     { data: 'trades', name: 'trades' },
                     { data: 'traded_amount', name: 'traded_amount' },
                     { data: 't_pnl', name: 't_pnl' },
                     { data: 't_charges', name: 't_charges' },
                     { data: 'n_pnl', name: 'n_pnl' },
                     { data: 'roi', name: 'roi' },
                     { data: 'action', name: 'action' },
                ]
            });


            //Action Delete function
             $(document).on('click','.delete',function(){
                 var id =  $(this).attr('id');
                 swalWithBootstrapButtons({
                     title: "Delete Selected Trading Journal?",
                     text: "You won't be able to revert this!",
                     type: "warning",
                     showCancelButton: true,
                     confirmButtonText: "Delete",
                     cancelButtonText: "Cancel",
                     reverseButtons: true
                 }).then(result => {
                     if (result.value) {
                     $.ajax({
                         url: "trading/"+id,
                         type:"post",
                         data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                         success: function(result){
                             location.reload();
                             toast({
                                 type: "success",
                                 title: "Trading Journal Deleted Successfully"
                             });
                         },
                         error: function(result){
                            console.log(result);
                         }
                     });
                     }
                 });
            });

        });

    </script>

@endsection
