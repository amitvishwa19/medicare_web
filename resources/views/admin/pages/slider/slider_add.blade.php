@extends('admin.layout.admin')

@section('title','Add Slider')

@section('slider','active')

@section('style')
    <link href="{{asset('public/admin/plugins/dropify/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{route('slider.index')}}">Slider</a></li>
                            <li class="breadcrumb-item active">Add Slider</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">
        
        <form role="form" method="post" action="{{route('slider.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Slider name</label>
                <input type="text" class="form-control" name="name"  value="{{old('name')}}">
                <div class="error">{{$errors->first('name')}}</div>
            </div>

            <div class="form-group">
                <input type="file" id="input-file-now" class="dropify" data-allowed-file-extensions="pdf png" multiple />                                                   
            </div><!--end card-body-->

            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Add Slider</button>
                <a href="{{route('slider.index')}}" class="btn btn-secondary waves-effect waves-ligh btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('scripts')
    <script src="{{asset('public/admin/plugins/dropify/js/dropify.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
    $(".dropify").dropify(),
        $(".dropify-fr").dropify({ messages: { default: "Glissez-déposez un fichier ici ou cliquez", replace: "Glissez-déposez un fichier ou cliquez pour remplacer", remove: "Supprimer", error: "Désolé, le fichier trop volumineux" } });
    var e = $("#input-file-events").dropify();
    e.on("dropify.beforeClear", function (e, r) {
        return confirm('Do you really want to delete "' + r.file.name + '" ?');
    }),
        e.on("dropify.afterClear", function (e, r) {
            alert("File deleted");
        }),
        e.on("dropify.errors", function (e, r) {
            console.log("Has Errors");
        });
    var r = $("#input-file-to-destroy").dropify();
    (r = r.data("dropify")),
        $("#toggleDropify").on("click", function (e) {
            e.preventDefault(), r.isDropified() ? r.destroy() : r.init();
        });
});

    </script>
@endsection
