@extends('admin.layout.admin')

@section('title','Edit Trading')

@section('trading','active')

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
                            <li class="breadcrumb-item"><a href="{{route('trading.index')}}">Tradings</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">
       
        <form role="form" method="post" action="{{route('trading.update',$trading->id)}}" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="projectName"><b>Date</b></label>
                        <input type="date" class="form-control" name="date"  placeholder="Script name" value="{{$trading->date}}{{old("date")}}">
                    </div>
                    <div class="col-md-3">
                       <label for="projectName"><b>Total P&L</b></label>
                       <input type="number" class="form-control" name="t_pnl"   value="{{$trading->t_pnl}}{{old("t_pnl")}} ">
                   </div>

                   <div class="col-md-3">
                       <label for="projectName"><b>Total Charges</b></label>
                       <input type="number" step="any" class="form-control" name="t_charges"  value="{{$trading->t_charges}}{{old("t_charges")}}">
                   </div>

                   <div class="col-md-3">
                       <label for="projectName"><b>Net P&L</b></label>
                       <input type="number" class="form-control" name="n_pnl"   value="{{$trading->n_pnl}}{{old("n_pnl")}}">
                   </div>

                </div>

                
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="projectName"><b>Mistakes</b></label>
                        <textarea name="mistakes" class="form-control" id="" cols="30" rows="3">{{$trading->mistakes}}{{old('mistakes')}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="projectName"><b>Learning</b></label>
                        <textarea name="learning" class="form-control" id="" cols="30" rows="3">{{$trading->learning}}{{old('learning')}}</textarea>
                    </div>
                    
                </div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Update Trading</button>
                <a href="{{route('trading.index')}}" class="btn btn-secondary waves-effect waves-ligh btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
