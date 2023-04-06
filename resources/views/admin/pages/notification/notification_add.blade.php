@extends('admin.layout.admin')

@section('title','Add Notification')

@section('notification','active')

@section('style')
@endsection


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Tasks</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('notification.index')}}">Notification</a></li>
                            <li class="breadcrumb-item active">Add Notification</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">
        
        <form role="form" method="post" action="{{route('notification.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Notification name</label>
                <input type="text" class="form-control" name="name"  value="{{old('name')}}">
                <div class="error">{{$errors->first('name')}}</div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Add Notification</button>
                <a href="{{route('notification.index')}}" class="btn btn-secondary waves-effect waves-ligh btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
