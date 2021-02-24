<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\blog;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use App\blog_tag;
use DB;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PageName='Blogs';
        $blogs=blog::orderBy('created_at','desc')->paginate(8);
        $categories=Category::orderBy('created_at','desc')->get();
        $tags=Tag::orderBy('created_at','desc')->get();
        return view('blogs.index')->with('PageName',$PageName)->with('blogs',$blogs)->with('categories',$categories)->with('tags',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PageName='Blogs';
        $select=Category::orderBy('created_at','desc')->pluck('category','id')->prepend('Select a category...','');
        $tags=Tag::orderBy('created_at','desc')->get();
        return view('blogs.create')->with('PageName',$PageName)->with('select',$select)->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        switch ($request->input('action')) {
            case 'add-new-tag':
            $select=Tag::all()->pluck('tag_name')->toArray();
            if(in_array($request->input('tags'),$select))
            {
                return redirect('/blogs/create')->with('error','Tag Already exists');
            }else{
            $tag=new Tag;
            $tag->tag_name=$request->input('tags');
            $tag->save();
            return redirect('/blogs/create')->with('success','Tag Added');
            }
            break;

            case 'add-new-category':
            $select=Category::all()->pluck('category')->toArray();
            if(in_array($request->input('category'),$select))
            {
                return redirect('/blogs/create')->with('error','Category Already exists');
            }else{
            $category=new Category;
            $category->category=$request->input('category');
            $category->save();
            return redirect('/blogs/create')->with('success','Category Added');
            }
            break;
        
            
        case 'save_model':
        $this->validate($request,[
            'title'=>'required',
            'Category'=>'required',
            'description'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
            ]);
        
        //Create Post

        //Handle File Upload
            if($request->hasFile('cover_image')){
                //Get Filename with Extension
                $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
                //Get Just Filename
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get Just Extension
                $extension=$request->file('cover_image')->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

            }else{
                $fileNameToStore='noimage.jpg';
            }

        $blog=new blog;
        $blog->title=$request->input('title');
        $category_id=Category::find($request->input('Category'));
        $blog->category_id=$category_id->id;
        $blog->description=$request->input('description');
        $blog->body=$request->input('body');
        $blog->user_id=auth()->user()->id;
        $blog->cover_image=$fileNameToStore;
        $blog->save();
        $selected_tags=$request->input('selected_tags');
            foreach($selected_tags as $selected_tag){
                $tag=Tag::find($selected_tag);
                $blog->tags()->attach($tag);
            }
        return redirect('/blogs')->with('success','Post Created');
        break;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  string
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $PageName='Blogs';
        $blog=blog::find($id);
        return view('blogs.show')->with('blog',$blog)->with('PageName',$PageName)->with('tags',$blog->tags)->with('category',$blog->categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $PageName='Blogs';
        $blog = blog::find($id);
        $select=Category::orderBy('created_at','desc')->pluck('category','id')->prepend($blog->Category->category,$blog->category_id);
        $tags=Tag::orderBy('created_at','desc')->get();
        return view('blogs.edit')->with('blog',$blog)->with('PageName',$PageName)->with('select',$select)->with('tags',$tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        switch ($request->input('action')) {
            case 'add-new-tag':
            $select=Tag::all()->pluck('tag_name')->toArray();
            if(in_array($request->input('tags'),$select))
            {
                return redirect("/blogs/$id/edit")->with('error','Tag Already exists');
            }else{
            $tag=new Tag;
            $tag->tag_name=$request->input('tags');
            $tag->save();
            return redirect("/blogs/$id/edit")->with('success','Tag Added');
            }
            break;

            case 'add-new-category':
            $select=Category::all()->pluck('category')->toArray();
            if(in_array($request->input('category'),$select))
            {
                return redirect("/blogs/$id/edit")->with('error','Category Already exists');
            }else{
            $category=new Category;
            $category->category=$request->input('category');
            $category->save();
            return redirect("/blogs/$id/edit")->with('success','Category Added');
            }
            break;
        
            
        case 'update_model':
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
            ]);

            

            //File Upload
            if($request->hasFile('cover_image')){
                // Delete file if exists
                $blog= blog::find($id);
                Storage::delete('public/cover_images/'.$blog->cover_image);
                //Get Filename with Extension
                $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
                //Get Just Filename
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get Just Extension
                $extension=$request->file('cover_image')->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            }

        //Update Post
        $blog=blog::find($id);
        $blog->title=$request->input('title');
        $category_id=Category::find($request->input('Category'));
        $blog->category_id=$category_id->id;
        $blog->description=$request->input('description');
        $blog->body=$request->input('body');
        /*$blog->user_id=auth()->user()->id;*/
        if($request->hasFile('cover_image')){
        $blog->cover_image=$fileNameToStore;
        }
        $blog->save();
        $selected_tags=$request->input('selected_tags');
        $blog->tags()->sync($selected_tags);
        return redirect('/blogs')->with('success','Post Updated');
        break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PageName='Blogs';
        $blog = blog::find($id);
        if($blog->cover_image !== 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/cover_images/'.$blog->cover_image);
        }
        $blog->delete();
        return redirect('/blogs')->with('success','Post Removed')->with('PageName',$PageName);
    }

    public function searchByCategory($id){
        $PageName='Blogs';
        $categories=Category::orderBy('created_at','desc')->get();
        $tags=Tag::orderBy('created_at','desc')->get();
        $category=Category::find($id);
        return view('blogs.index')->with('PageName',$PageName)->with('categories',$categories)->with('tags',$tags)->with('blogs',$category->blogs()->paginate(8));
    }

    public function searchByTag(Request $request){
        $PageName='Blogs';
        $categories=Category::orderBy('created_at','desc')->get();
        $tags=Tag::orderBy('created_at','desc')->get();
        $selected_tags_filter=$request->input('selected_tags_filter');
            foreach($selected_tags_filter as $selected_tag_filter){
                $tag=Tag::find($selected_tag_filter);
                $blogs=$tag->blogs;
            }
        return view('blogs.index')->with('PageName',$PageName)->with('categories',$categories)->with('tags',$tags)->with('blogs',$blogs);
    }

    /*public function searchByTag(Request $request){
        $PageName='Blogs';
        $categories=Category::orderBy('created_at','desc')->get();
        $tags=Tag::orderBy('created_at','desc')->get();
        $selected_tags_filter=$request->input('selected_tags_filter');
        $blogs=DB::select('select * from blog_tag where tag_id = ?', $selected_tags_filter);
        $blog_id=[];
        foreach($blogs as $blog){
            $blog_id[].=$blog->blog_id;
        }
        $blogs=DB::select('select * from blogs where id = ?', $blog_id);
        return view('blogs.index')->with('PageName',$PageName)->with('categories',$categories)->with('tags',$tags)->with('blogs',$blogs);
    }*/

    public function searchBar(Request $request){
        $PageName='Blogs';
        $categories=Category::orderBy('created_at','desc')->get();
        $tags=Tag::orderBy('created_at','desc')->get();
        $search=$request->input('search');
        // split on 1+ whitespace & ignore empty (eg. trailing space)
        $searchValues = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);
        $blogs = blog::orderBy('created_at','desc')->where(function ($q) use ($searchValues) {
            foreach ($searchValues as $value) {
              $q->orWhere('title', 'like', "%{$value}%")->orWhere('description','like',"%{$value}%")->orWhere('body','like',"%{$value}%")->paginate(8);
            }
          })->get();
        return view('blogs.index')->with('PageName',$PageName)->with('categories',$categories)->with('tags',$tags)->with('blogs',$blogs);


    }
}
