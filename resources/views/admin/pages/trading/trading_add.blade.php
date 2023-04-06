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
                        <h4 class="page-title">Tasks</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('trading.index')}}">Trading</a></li>
                            <li class="breadcrumb-item active">Add Trading</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">
        
        <form role="form" method="post" action="{{route('trading.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="projectName"><b>Date</b></label>
                        <input type="date" class="form-control" name="date"  placeholder="Script name" value="{{date('Y-m-d')}}{{old("date")}}">
                    </div>
                    <div class="col-md-3">
                       <label for="projectName"><b>Total P&L</b></label>
                       <input type="number" step="any" class="form-control" name="t_p&l"   value="{{old("t_p")}}">
                   </div>

                   <div class="col-md-3">
                       <label for="projectName"><b>Total Charges</b></label>
                       <input type="number" class="form-control" name="t_charges"  value="{{old("t_charges")}}">
                   </div>

                   <div class="col-md-3">
                       <label for="projectName"><b>Net P&L</b></label>
                       <input type="number" class="form-control" name="n_p&l"   value="{{old("n_p")}}">
                   </div>

                </div>

                
            </div>

            

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="projectName"><b>Mistakes</b></label>
                        <textarea name="mistakes" class="form-control" id="" cols="30" rows="3">{{old('mistakes')}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="projectName"><b>Learning</b></label>
                        <textarea name="learning" class="form-control" id="" cols="30" rows="3">{{old('learning')}}</textarea>
                    </div>
                    
                </div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Add Trading</button>
                <a href="{{route('trading.index')}}" class="btn btn-secondary waves-effect waves-ligh btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
