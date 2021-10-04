<?php

namespace App\Http\Controllers\Admin\Common;
use App\Model\Common\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SM\SM;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Post';
        $data['rightButton']['link'] = 'posts/create';
        
        return view('nptl-admin/common/posts/index', get_defined_vars());
    }


    public function create()
    {
        return view('nptl-admin/common/posts/create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:255',
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect("geeksadmin/posts/postsall");
    }



    public function edit($id)
    {
        
        $data['post'] =  Post::findOrFail($id);

        return view("nptl-admin/common/posts/edit",$data);
    }


    public function update(Request $request,$id)
    {
               
        $data['post'] =  Post::find($id);

        
        $post->title = $request->title;
        $post->description = $request->description;
        $post->update();
           
        return redirect("geeksadmin/posts/postsall", get_defined_vars()) ;
    }

    public function destroy($id)
    {
        $post = Post::find($id);        
        $data['posts']=Post::all();
        $post->delete();
        return redirect("geeksadmin/posts/postsall")->with('data');
    }
   
}