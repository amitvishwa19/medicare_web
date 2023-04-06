@extends('admin.layout.admin')

@section('title','Edit Notification')

@section('notification','active')

@section('style')
@endsection


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Tasks</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('notification.index')}}">Notifications</a></li>
                            <li class="breadcrumb-item active">{{$notification->data}}</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">
       
    


    </div>

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
