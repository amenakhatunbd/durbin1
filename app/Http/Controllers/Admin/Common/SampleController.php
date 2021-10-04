<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin\Common;
use App\Model\Common\Sample;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\SM\SM;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index(){
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add sample';
        $data['rightButton']['link'] = 'shops/addshop';

        return view('nptl-admin/common/samples/index', $data);
    }



    public function create()
    {
        $data['rightButton']['iconClass'] = 'fa fa-list-alt';
        $data['rightButton']['text'] = 'sample List';
        $data['rightButton']['link'] = 'shops';
        return view("nptl-admin/common/samples/create", $data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'gmail' => 'required',            
            'description' => 'required|max:255',
        ]);
        $sample = new Sample();
        $sample->title = $request->title;
        $sample->gmail = $request->gmail;
        $sample->description = $request->description;
        $sample->save();
    
        return redirect('geeksadmin/samples/allsample')->with('s_message', 'shop create sucessfully!');;

    }




}
