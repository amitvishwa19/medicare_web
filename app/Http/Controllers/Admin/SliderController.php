<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Slider;

class SliderController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $sliders = Slider::orderby('created_at','desc')->latest('id');

            return Datatables::of($sliders)
            ->editColumn('created_at',function(Slider $slider){
                return $slider->created_at->diffForHumans();
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('slider.edit',$data->id).'" class="badge badge-soft-success mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-secondary delete mr-2 delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);


        }


        return view('admin.pages.slider.slider');

    }

    public function create()
    {
        return view('admin.pages.slider.slider_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $slider = New Slider;
        $slider->name = $request->name;
        $slider->save();

        return redirect()->route('slider.index')
        ->with([
            'message'    =>'Slider Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $slider = Slider::findOrFail($id);

        return response()->json($slider);
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        //return response()->json($slider);

        return view('admin.pages.slider.slider_edit',compact('slider'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $slider = Slider::findOrFail($id);
        $slider->name = $request->name;
        $slider->save();

        return redirect()->route('slider.index')
        ->with([
            'message'    =>'Slider Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $slider = Slider::destroy($id);

        if($slider){
            return redirect()->route('slider.index')
            ->with([
                'message'    =>'Slider Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
