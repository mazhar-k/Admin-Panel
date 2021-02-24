<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PageName='Media';
        $media_images=Media::orderBy('created_at','desc')->paginate(8);
        return view('media.index')->with('PageName',$PageName)->with('media_images',$media_images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PageName='Media';
        return view('media.create')->with('PageName',$PageName);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'caption'=>'required',
            'media_image'=>'image|nullable|max:1999'
        ]);

        //File Upload
            if($request->hasFile('media_image')){
                //Get Filename with Extension
                $fileNameWithExt=$request->file('media_image')->getClientOriginalName();
                //Get Just Filename
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get Just Extension
                $extension=$request->file('media_image')->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('media_image')->storeAs('public/carousal_images',$fileNameToStore);
            }else{
                $fileNameToStore='noimage.jpg';
            }

        //Add New Image
        $media=new Media;
        $media->caption=$request->input('caption');
        $media->media_image=$fileNameToStore;
        $media->save();

        return redirect('/media')->with('success','Image Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $PageName='Media';
        $media=Media::find($id);
        return view('media.edit')->with('PageName',$PageName)->with('media',$media);
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
        $this->validate($request,[
            'caption'=>'required',
            'media_image'=>'image|nullable|max:1999'
            ]);

            //File Upload
            if($request->hasFile('media_image')){
                // Delete file if exists
                $media= Media::find($id);
                Storage::delete('public/carousal_images/'.$media->media_image);
                //Get Filename with Extension
                $fileNameWithExt=$request->file('media_image')->getClientOriginalName();
                //Get Just Filename
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get Just Extension
                $extension=$request->file('media_image')->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('media_image')->storeAs('public/carousal_images',$fileNameToStore);
            }

        //Update Post
        $media=Media::find($id);
        $media->caption=$request->input('caption');
        if($request->hasFile('media_image')){
        $media->media_image=$fileNameToStore;
        }
        $media->save();

        return redirect('/media')->with('success','Image Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PageName='Media';
        $media = Media::find($id);
        if($media->media_image !== 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/carousal_images/'.$media->media_image);
        }
        $media->delete();
        return redirect('/media')->with('success','Image Removed')->with('PageName',$PageName);
    }
}
