<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PageName='Events';
        $events=Event::orderBy('created_at','desc')->get();
        return view('events.index')->with('PageName',$PageName)->with('events',$events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PageName='Events';
        return view('events.create')->with('PageName',$PageName);
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
            'name'=>'required',
            'date'=>'required|date',
            'target'=>'required|integer|min:0',
            'head'=>'required',
            'venue'=>'required',
            'event_image'=>'image|nullable|max:1999'
        ]);

        //File Upload
            if($request->hasFile('event_image')){
                //Get Filename with Extension
                $fileNameWithExt=$request->file('event_image')->getClientOriginalName();
                //Get Just Filename
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get Just Extension
                $extension=$request->file('event_image')->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('event_image')->storeAs('public/event_images',$fileNameToStore);
            }else{
                $fileNameToStore='noimage.jpg';
            }

        //Create Event
        $event=new Event;
        $event->name=$request->input('name');
        $event->event_date=$request->input('date');
        $event->target=$request->input('target');
        $event->head=$request->input('head');
        $event->venue=$request->input('venue');
        $event->event_image=$fileNameToStore;
        $event->save();

        return redirect('/events')->with('success','Event Created');
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
        $PageName='Events';
        $event=Event::find($id);
        return view('events.edit')->with('PageName',$PageName)->with('event',$event);
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
            'name'=>'required',
            'date'=>'required|date',
            'target'=>'required|integer|min:0',
            'head'=>'required',
            'venue'=>'required',
            'event_image'=>'image|nullable|max:1999'
            ]);

            //File Upload
            if($request->hasFile('event_image')){
                // Delete file if exists
                $event= Event::find($id);
                Storage::delete('public/event_images/'.$event->event_image);
                //Get Filename with Extension
                $fileNameWithExt=$request->file('event_image')->getClientOriginalName();
                //Get Just Filename
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get Just Extension
                $extension=$request->file('event_image')->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('event_image')->storeAs('public/event_images',$fileNameToStore);
            }

        //Update Post
        $event=Event::find($id);
        $event->name=$request->input('name');
        $event->event_date=$request->input('date');
        $event->target=$request->input('target');
        $event->head=$request->input('head');
        $event->venue=$request->input('venue');
        if($request->hasFile('event_image')){
        $event->event_image=$fileNameToStore;
        }
        $event->save();

        return redirect('/events')->with('success','Event Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PageName='Events';
        $event = Event::find($id);
        if($event->cover_image !== 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/event_images/'.$event->event_image);
        }
        $event->delete();
        return redirect('/events')->with('success','Event Removed')->with('PageName',$PageName);
    }
}
