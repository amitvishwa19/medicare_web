@extends('admin.layout.admin')

@section('title','Product')

@section('product','active')


@section('style')
    <link href="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection



@section('content')
    <div class="content-area">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Databases</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Databases</li>
                                
                            </ol>
                         
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <!-- <a href="#post_display" class="btn btn-info waves-effect waves-light btn-sm" data-toggle="modal" >Posts Grid</a> -->
                            <a href="{{route('bread.databases.add')}}" class="btn btn-info waves-effect waves-light btn-sm" >Add New Table</a>
                        </div>
                       
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
            
        </div><!--end row-->

       

       

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th><b>Table Name</b></th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tables as $table)
                                @continue(in_array($table, config('devlomatix.database.tables.hidden', [])))
                                <tr>
                                    <td>{{$table}}</td>
                                    
                                </tr>
                            @endforeach 
                            </tbody>
                        </table><!--end /table-->
                    </div>
                    </div>
                </div>
            </div><!--end row-->
       

    </div>
@endsection



@section('scripts')
    <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>

        $(function(){
            'use strict'

            //Datatable
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 20,
                ajax: '{!! route('bread.databases') !!}',
                columns:[
                    { data: 'table_name', name: 'table_name'},
                   
                ]
            });

        });

    </script>

@endsection
