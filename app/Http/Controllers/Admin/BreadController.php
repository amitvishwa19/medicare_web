<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\DataType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BreadController extends Controller
{
    


    public function databases(Request $request){

        
       
        
            $tables = DB::select('SHOW TABLES');
            $tables = array_map('current',$tables);
           

        return view('admin.pages.bread.database',compact('tables'));
    }

    public function add_databases(){

        return view('admin.pages.bread.add_database');
    }

    public function create_database(Request $request){
        //dd($request->all());

        $items = count($request->name);
        $path = base_path('database\migrations\test.php');
        $content = '<? php " Hi 1 "echo < br > ;" Hi 2 "echo < br > ;" Hi 4 "echo < br > ;';

        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [strtolower(Str::plural('Test'))],
            $this->getStub('Migration')
        );

        //dd($requestTemplate);
        //File::put($path, $content);
        //File::put($path, $requestTemplate);
        $linenumber = $this->get_line_number($path, '//DataWillGoHere');
        //dd($linenumber);

        $lines = file( $path , FILE_IGNORE_NEW_LINES );
        //$lines[20] = 'my modified line';
        //file_put_contents( $path , implode( "\n", $lines ) );

        for($i=0; $i < $items; $i++){
            $columnName = '$table->'.$request->col_type[$i].'("' . $request->name[$i] . '");';
            $lines[$linenumber + 1] = $columnName;
            file_put_contents( $path , implode( "\n", $lines ) );
            $linenumber += 1;
        }


        // dd($lines);
        // $lines = count(file($path));
        // $linenumber = $this->get_line_number($path, '//DataWillGoHere');
        // //dd($linenumber);
        // $this->filewriter($path,21,'asdaasdasd',true);
        // dd(file_get_contents($path));

    }

    protected function getStub($type){
        return file_get_contents(resource_path("views/admin/stubs/$type.stub"));
    }

    protected function get_line_number($file, $find){
        $file_content = file_get_contents($file);
        $lines = explode("\n", $file_content);
    
        foreach($lines as $num => $line){
            $pos = strpos($line, $find);
            if($pos !== false)
            return $num + 1;
        }
        return false;
    }

    protected function filewriter($filename,$line,$text,$append){
        $current = file_get_contents($filename);
        if ($append)
         $current .= $line;
        else
         $current = $line;
        file_put_contents($filename, $current);
      }

}
