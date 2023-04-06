@extends('admin.layout.admin')

@section('title','Product')

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
                            <h4 class="page-title">Add Databases</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item"><a href="{{route('bread.databases')}}">Databases</a></li>
                                <li class="breadcrumb-item active">New</li>
                                
                            </ol>
                         
                        </div><!--end col-->
                       
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row card pt-2 pb-2">
            <div class="col-lg-12 col-sm-12">
            <div class="col-sm-12">

                <form method="post" action="{{route('bread.databases.create')}}" enctype="multipart/form-data" class="mg-t-30">
                    @csrf

                   

                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Table Name</b></label>
                        <input type="text" class="form-control" name="title" value="" >
                    </div>

                    <div class="checkbox form-group">
                        <input id="checkbox0" type="checkbox" name="favourite">
                        <label for="checkbox0">
                            <b>Create Model for this table?</b>
                        </label>
                    </div>

                    <table class="table table-bordered dt-responsive nowrap dataTable no-footer" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table-data">
                            <thead>
                                <tr>
                                    <th>Name</th> 
                                    <th>Type</th> 
                                    <th>Length</th> 
                                    <th>Not Null</th> 
                                    
                                    <th>Default</th> 
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr_clone">
                                    <td>
                                        <input type="text" class="form-control" name="name[]"   value="id">
                                    </td>
                                    <td>
                                        <select class="form-control" name="col_type[]">
                                            <option value="tinyint">-Data type-</option>
                                            <optgroup label="Numbers">
                                                <option value="tinyint">TINYINT</option>
                                                <option value="smallint">SMALLINT</option>
                                                <option value="mediumint">MEDIUMINT</option>
                                                <option value="integer">INTEGER</option>
                                                <option value="bigint">BIGINT</option>
                                                <option value="float">FLOAT</option>
                                                <option value="double">DOUBLE</option>
                                                <option value="decimal">DECIMAL</option>
                                            </optgroup>
                                    
                                            <optgroup label="Strings">
                                                <option value="tinytext">TINYTEXT</option>
                                                <option value="mediumtext">MEDIUMTEXT</option>
                                                <option value="longtext">LONGTEXT</option>
                                                <option value="text">TEXT</option>
                                                <option value="string" >VARCHAR</option>
                                             
                                            </optgroup>
                                    
                                            <optgroup label="Date and Time">
                                                <option value="date">DATE</option>
                                                <option value="datetime">DATETIME</option>
                                                <option value="timestamp">TIMESTAMP</option>
                                                <option value="time">TIME</option>
                                                <option value="year">YEAR</option>
                                            </optgroup>
                                    
                                            <!-- <optgroup label="Binary">
                                                <option value="longblob">LONGBLOB</option>
                                                <option value="blob">BLOB</option>
                                                <option value="mediumblob">MEDIUMBLOB</option>
                                                <option value="tinyblob">TINYBLOB</option>
                                                <option value="binary">BINARY</option>
                                                <option value="varbinary">VARBINARY</option>
                                                <option value="bit">BIT</option>
                                            </optgroup> -->
                                    
                                            <optgroup label="Lists">
                                                <option disabled="disabled" value="set">SET</option>
                                                <option value="json">JSON</option>
                                                <option disabled="disabled" value="enum">ENUM</option>
                                            </optgroup>
                                    
                                            <!-- <optgroup label="Geometry">
                                                <option value="geometrycollection">GEOMETRYCOLLECTION</option>
                                                <option value="geometry">GEOMETRY</option>
                                                <option value="linestring">LINESTRING</option>
                                                <option value="multilinestring">MULTILINESTRING</option>
                                                <option value="multipoint">MULTIPOINT</option>
                                                <option value="multipolygon">MULTIPOLYGON</option>
                                                <option value="point">POINT</option>
                                                <option value="polygon">POLYGON</option>
                                            </optgroup> -->
                            
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="length[]">
                                    </td>
                                    <td>
                                        <select name="null[]" id="" class="form-control">
                                            <option value="null">Null</option>
                                            <option value="notnull">Not Null</option>
                                        </select>
                                    </td>
                                   
                                   
                                    <td>
                                        <input type="number" class="form-control" name="default[]">
                                    </td>
                                    <td>
                                        <i class="fas fa-plus tr_clone_add"></i>
                                    </td>
                                    <td>
                                        <i class="fas fa-trash-alt deleterow"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table><!--end /table-->

             
                   

                    <div class="mt-4">
                        <button  class="btn btn-info waves-effect waves-light btn-sm">Create Table</button>
                    </div>

                </form>
                </div>
            </div>
        </div><!--end row-->

    </div>
@endsection



@section('scripts')


    <script>

        $(function(){
            var table = $( '#table-data' )[0];
            
            $( table ).delegate( '.tr_clone_add', 'click', function () {
                var thisRow = $( this ).closest( 'tr' )[0];
                $( thisRow ).clone().insertAfter( thisRow ).find( 'input:text' ).val( '' );
                
            });
            
            $('tbody').on('click','.deleterow',function(){
                $(this).parent().parent().remove();
                //console.log('deleterow clicked');
            });

        });

    </script>

@endsection
