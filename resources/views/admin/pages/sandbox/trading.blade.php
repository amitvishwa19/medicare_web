@extends('admin.layout.admin')

@section('title','Stock Trading')

@section('product','active')


@section('style')
    
@endsection



@section('content')
    <div class="content-area">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Stock Market Analysis</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Analysis</li>
                                
                            </ol>
                        </div><!--end col-->

                        
                            <div class="col-auto align-self-center">
                                <a href="{{$fyers_auth_url}}" class="btn btn-info waves-effect waves-light btn-sm" ><b>Fyers Login</b></a>
                            </div><!--end col-->
                        
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row  pt-2 pb-2">
            <div class="col-lg-12 col-sm-12">
            
            <div class="card">
            <p style="word-wrap: true;">{{$auth_code}}</p>
            <p style="word-wrap: true;">{{$access_token}}</p>


            </div>
     
           
        </div><!--end row-->

    </div>
@endsection



@section('scripts')


    <script>

        $(function(){
           

        });

    </script>

@endsection
