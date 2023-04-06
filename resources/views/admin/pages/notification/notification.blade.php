@extends('admin.layout.admin')

@section('title','Notification')

@section('notification','active')


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
                            <h4 class="page-title">Notifications</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Notifications</li>
                            </ol>
                        </div><!--end col-->
                        
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class=" mb-2">
            <a href="javascript:void(0)" class="wp-title mr-2" id="mark_read">Mark Read</a>
            <a href="javascript:void(0)" class="wp-title mr-2" id="delete_selected">Delete</a>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="">
                    <div class="form-group">
                        <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th style="width:5%"><input type="checkbox" id="bulk_delete"></th>
                                    <th style="width:30%"><label for=""><b>Title</b></label></th>
                                    <th style="width:50%"><label for=""><b>Message</b></label></th>
                                    <th style="width:15%"><label for=""><b>Action</b></label></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notifications as $notification)
                                   
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id" class="checkbox" value="{{$notification->id}}"/>
                                    </td>
                                    <td>
                                        @if($notification->read_at == null)
                                            <b>{{$notification->data['title']}}</b>
                                        @else
                                            {{$notification->data['title']}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($notification->read_at == null)
                                            <b>{{$notification->data['body']}}</b>
                                        @else
                                            {{$notification->data['body']}}
                                        @endif
                                    </td>
                                    <td>
                                        <!-- <a href="{{route('notification.show',$notification->id)}}" class="badge badge-soft-info mr-2"><small>View</small></a> -->
                                        @if($notification->read_at == null)
                                        <a href="{{route('notification.edit',$notification->id)}}" class="badge badge-soft-success mr-2"><small>Mark as Read</small></a>
                                        @endif
                                        <a href="javascript:void(0);" id="{{$notification->id}}" class="badge badge-soft-danger mr-2 delete"><small>Delete</small></a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
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
            // $('#datatable').DataTable({
            //      processing: true,
            //      serverSide: true,
            //      ajax: '{!! route('notification.index') !!}',
            //      columns:[
            //          { data: 'id', name: 'id' },
            //          { data: 'action', name: 'action' },
            //     ]
            // });


        

            //Select all notification
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

            //Action Delete function
            $(document).on('click','.delete',function(){
                var id =  $(this).attr('id');
                swalWithBootstrapButtons({
                    title: "Delete Selected Notification?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                }).then(result => {
                    if (result.value) {
                    $.ajax({
                        url: "notification/"+id,
                        type:"post",
                        data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                        success: function(result){
                            console.log(result);
                            location.reload();
                            toast({
                                type: "success",
                                title: "Notification Deleted Successfully"
                            });
                        }
                    });
                    }
                });
            });

            //Mark read selected item
            $(document).on('click', '#mark_read', function(){
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
                        title: "Please select atleast one item to mark as read!"
                    });
                }

                
                
            });

            //Delete selected item
            $(document).on('click', '#delete_selected', function(){
                var id = [];
                $('.checkbox:checked').each(function(){
                    id.push($(this).val());
                });
                if(id.length > 0){
                    swalWithBootstrapButtons({
                    title: "Delete Selected Notification?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                    }).then(result => {
                        if (result.value) {
                            $.ajax({
                                url: "notification/"+id,
                                type:"post",
                                data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                                success: function(result){

                                    console.log(result);
                                    location.reload();
                                    toast({
                                        type: "success",
                                        title: "Notification Deleted Successfully"
                                    });
                                }
                            });
                        }
                    });
                }else{
                    toast({
                        type: "warning",
                        title: "Please select atleast one item to delete!"
                    });
                }

                
                
            });

            

        });

    </script>

@endsection
