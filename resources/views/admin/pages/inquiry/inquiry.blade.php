@extends('admin.layout.admin')

@section('title','Inquiry')

@section('inquiry','active')


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
                            <h4 class="page-title">Inquirys</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Inquries</li>
                            </ol>
                            
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class=" mb-2">
            <a href="javascript:void(0)" class="wp-title mr-2" id="delete">Delete</a>
            <a href="javascript:void(0)" class="wp-title mr-2" id="delete_all">Delete All</a>
         </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width:2%"><input type="checkbox" id="bulk_delete"></th>
                                        <th style="">Inquiry Subject</th>
                                        <th style="">Email</th>
                                        <th style="">Message</th>
                                        <th style="width:5%">Phone</th>
                                        <th style="width:5%">Actions</th>
                                    </tr>
                                </thead>


                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="modal fade" id="exampleModalDefault" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Add Role</h6>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                        </button>
                    </div><!--end modal-header-->

                    <form action="{{route('role.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Name</label>
                                <input type="text" class="form-control" name="name" aria-describedby="emailHelp" >
                            </div>





                        </div><!--end modal-body-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light btn-sm">Add Role</button>
                        </div><!--end modal-footer-->
                    </form>
                </div><!--end modal-content-->
            </div><!--end modal-dialog-->
        </div><!--end modal-->

    </div>
@endsection



@section('scripts')

    {{-- Datatable JS --}}
    <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{asset('public/admin/assets/pages/jquery.datatable.init.js')}}"></script> --}}
    {{-- Datatable JS --}}



    <script>

        $(function(){
            'use strict'

            //Datatable
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('inquiry.index') !!}',
                columns:[
                    // { data: 'name', name: 'name'},
                    { data: 'checkbox', name: 'checkbox',orderable:false, searchable: false},
                    { data: 'subject', name: 'subject'},
                    { data: 'email', name: 'email'},
                    { data: 'message', name: 'message'},
                    { data: 'phone', name: 'phone'},
                    { data: 'action', name: 'action' },
                ]
            });


            //Action Delete function
            $(document).on('click','.delete',function(){
                var id =  $(this).attr('id');
                swalWithBootstrapButtons({
                    title: "Delete Selected Inquiry?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                }).then(result => {
                    if (result.value) {
                    $.ajax({
                        url: "inquiry/"+id,
                        type:"post",
                        data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                        success: function(result){
                            location.reload();
                            toast({
                                type: "success",
                                title: "Inquiry Deleted Successfully"
                            });
                        }
                    });
                    }
                });
            });

            //Action Delete function
            $(document).on('click','.delete',function(){
                var id =  $(this).attr('id');
                swalWithBootstrapButtons({
                    title: "Delete Selected Inquiries?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                }).then(result => {
                    if (result.value) {
                    $.ajax({
                        url: "inquiry/"+id,
                        type:"post",
                        data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                        success: function(result){
                            location.reload();
                            toast({
                                type: "success",
                                title: "Inquiries Deleted Successfully"
                            });
                        }
                    });
                    }
                });
            });

            $(document).on('click', '#select_all', function(){
                var checkboxes = document.getElementsByName('id');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = true
                    }
                }
            });

            $(document).on('click', '#bulk_delete', function(){
                var checkboxes = document.getElementsByName('id');

                if($("#bulk_delete").is(':checked')){
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].type == 'checkbox') {
                            checkboxes[i].checked = true
                        }
                    }
                } else {
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].type == 'checkbox') {
                            checkboxes[i].checked = false
                        }
                    }
                }

            });

            $(document).on('click', '#delete', function(){
                var id = [];
                $('.checkbox:checked').each(function(){
                    id.push($(this).val());
                });
                if(id.length > 0){
                    swalWithBootstrapButtons({
                    title: "Delete Selected Inquiry?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                    }).then(result => {
                        if (result.value) {
                            $.ajax({
                                url: "inquiry/"+id,
                                type:"post",
                                data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                                success: function(result){

                                    console.log(result);
                                    location.reload();
                                    toast({
                                        type: "success",
                                        title: "Inquiry Deleted Successfully"
                                    });
                                }
                            });
                        }
                    });
                }else{
                    toast({
                        type: "warning",
                        title: "Please select atleast one item to delete !"
                    });
                }

                
                
            });

            $(document).on('click', '#delete_all', function(){
                toast({
                    type: "warning",
                    title: "All the items will be deleated"
                });

            });

        });

    </script>

@endsection
