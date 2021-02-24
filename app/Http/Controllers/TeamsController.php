<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Team;
use DB;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PageName='Team';
        $filter_id=0;
        $departments=['Quintet'=>'Quintet','Administration'=>'Administration','Public Relations'=>'Public Relations','TechOrg'=>'TechOrg','Corporate'=>'Corporate','Production'=>'Production'];
        return view('teams.index')->with('PageName',$PageName)->with('departments',$departments)->with('filter_id',$filter_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PageName='Team';
        return view('teams.create')->with('PageName',$PageName);
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
            'department'=>'required',
            'post'=>'required',
            'instagram'=>'nullable',
            'linkedin'=>'nullable',
            'facebook'=>'nullable',
            'github'=>'nullable',
            'medium'=>'nullable',
            'contact'=>'required|numeric|min:10',
            'email'=>'required|email',
            'member_image'=>'image|nullable|max:1999'
        ]);

        //File Upload
            if($request->hasFile('member_image')){
                //Get Filename with Extension
                $fileNameWithExt=$request->file('member_image')->getClientOriginalName();
                //Get Just Filename
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get Just Extension
                $extension=$request->file('member_image')->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('member_image')->storeAs('public/team_profile_images',$fileNameToStore);
            }else{
                $fileNameToStore='noimage.jpg';
            }

        //Add Member
        $member=new Team;
        $member->name=$request->input('name');
        $member->department=$request->input('department');
        $member->post=$request->input('post');
        $member->instagram=$request->input('instagram');
        $member->linkedin=$request->input('linkedin');
        $member->facebook=$request->input('facebook');
        $member->github=$request->input('github');
        $member->medium=$request->input('medium');
        $member->contact=$request->input('contact');
        $member->email=$request->input('email');
        $member->member_image=$fileNameToStore;
        $member->save();

        return redirect('/teams')->with('success','Member Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $PageName='Team';
        $member=Team::find($id);
        return view('teams.show')->with('PageName',$PageName)->with('member',$member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $PageName='Team';
        $member=Team::find($id);
        return view('teams.edit')->with('PageName',$PageName)->with('member',$member);
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
            'department'=>'required',
            'post'=>'required',
            'instagram'=>'nullable',
            'linkedin'=>'nullable',
            'facebook'=>'nullable',
            'github'=>'nullable',
            'medium'=>'nullable',
            'contact'=>'required|numeric|min:10',
            'email'=>'required|email',
            'member_image'=>'image|nullable|max:1999'
        ]);

        //File Upload
            if($request->hasFile('member_image')){
                // Delete file if exists
                $member= Team::find($id);
                Storage::delete('public/team_profile_images/'.$member->member_image);
                //Get Filename with Extension
                $fileNameWithExt=$request->file('member_image')->getClientOriginalName();
                //Get Just Filename
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get Just Extension
                $extension=$request->file('member_image')->getClientOriginalExtension();
                //Filename To Store
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('member_image')->storeAs('public/team_profile_images',$fileNameToStore);
            }

        //Edit Member
        $member=Team::find($id);
        $member->name=$request->input('name');
        $member->department=$request->input('department');
        $member->post=$request->input('post');
        $member->instagram=$request->input('instagram');
        $member->linkedin=$request->input('linkedin');
        $member->facebook=$request->input('facebook');
        $member->github=$request->input('github');
        $member->medium=$request->input('medium');
        $member->contact=$request->input('contact');
        $member->email=$request->input('email');
        if($request->hasFile('member_image')){
            $member->member_image=$fileNameToStore;
            }
        $member->save();

        return redirect('/teams')->with('success','Member Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PageName='Team';
        $member = Team::find($id);
        if($member->member_image !== 'noimage.jpg'){
        //Delete Image
        Storage::delete('public/team_profile_images/'.$member->member_image);
        }
        $member->delete();
        return redirect('/teams')->with('success','Member Removed')->with('PageName',$PageName);
    }

    public function quintet(){
        $PageName='Team';
        $filter_id=0;
        $departments=['Quintet'=>'Quintet'];
        return view('teams.index')->with('PageName',$PageName)->with('departments',$departments)->with('filter_id',$filter_id);
    }

    public function admins(){
        $PageName='Team';
        $filter_id=0;
        $departments=['Administration'=>'Administration'];
        return view('teams.index')->with('PageName',$PageName)->with('departments',$departments)->with('filter_id',$filter_id);
    }

    public function heads(){
        $PageName='Team';
        $filter_id=1;
        $departments=['Quintet'=>'Quintet','Administration'=>'Administration','Public Relations'=>'Public Relations','TechOrg'=>'TechOrg','Corporate'=>'Corporate','Production'=>'Production'];
        return view('teams.index')->with('PageName',$PageName)->with('departments',$departments)->with('filter_id',$filter_id);
    }

    public function filterByTeam(Request $request){
        $PageName='Team';
        $filter_id=2;
        
        $departments=['Quintet'=>'Quintet','Administration'=>'Administration','Public Relations'=>'Public Relations','TechOrg'=>'TechOrg','Corporate'=>'Corporate','Production'=>'Production'];
        $team=$request->input('team');
        return view('teams.index')->with('PageName',$PageName)->with('departments',$departments)->with('filter_id',$filter_id)->with('team',$team);
    }
}
