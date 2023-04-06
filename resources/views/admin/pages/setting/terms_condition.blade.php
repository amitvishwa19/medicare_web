@section('style')
    <link href="{{asset('public/admin/plugins/quill/quill.core.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/plugins/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/plugins/quill/quill.bubble.css')}}" rel="stylesheet">
@endsection



<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">                      
                <h4 class="card-title">Terms & Condition</h4>                      
            </div><!--end col-->
           
        </div>  <!--end row-->                                  
    </div>
    <div class="card-body p-1"> 


        <form action="{{route('setting.store',['type'=>'termscondition'])}}" enctype="multipart/form-data" method="post" class="formsubmit">
            @csrf
            <div class="form-group">
                    <div id="content" class="m-0"></div>
                    <input type="text" name="terms_conditions" style="display: none" id="bodyinput" value="{{setting('terms_conditions')}}">
                </div>
           
                <button type="submit" class="btn btn-info waves-effect waves-light btn-sm">Terms & Conditions</button>       
        </form>
    </div>
</div>

@section('scripts')
    <script src="{{asset('public/admin/plugins/quill/quill.min.js')}}"></script>
    <script>

        $(function(){
            'use strict'
                
            var editor = new Quill('#content', {
            modules: {
                toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic','underline', 'strike'],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['link', 'blockquote', 'code-block', 'image'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                ['clean'],
                [{ 'color': [] }, { 'background': [] }],

                ]
            },
            placeholder: '',
            theme: 'snow'
            });
            editor.on('text-change', function() {
            $('#bodyinput').val(editor.root.innerHTML);
            //var text = editor.getText();
            });

            editor.root.innerHTML = $('#bodyinput').val();
            //Asign qull editor content to body input
                $('#btnpublish').on('click',function(){
                $('#bodyinput').val(editor.root.innerHTML);
            })
        });

    </script>

@endsection




