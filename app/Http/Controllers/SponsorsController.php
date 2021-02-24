<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Sponsor;
use App\Deal;

class SponsorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PageName='Marketing';
        $sponsors=Sponsor::with('deal')->orderBy('created_at','desc')->get();
        return view('marketing.index')->with('PageName',$PageName)->with('sponsors',$sponsors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PageName='Marketing';
        return view('marketing.create')->with('PageName',$PageName);
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
            'address'=>'required',
            'contact'=>'required|integer',
            'email'=>'required|email',
            'type'=>'required',
            'amount'=>'required|integer|min:0',
            'lead'=>'required',
            'status'=>'required',
        ]);

        if($request->input('status')=='Confirmed'){
            $this->validate($request,[
            'mou'=>'required|mimes:pdf|max:4999'
            ]);
        }else{
            $this->validate($request,[
                'mou'=>'nullable'
                ]);
        }

        //File Upload
        if($request->hasFile('mou')){
            //Get Filename with Extension
            $fileNameWithExt=$request->file('mou')->getClientOriginalName();
            //Get Just Filename
            $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get Just Extension
            $extension=$request->file('mou')->getClientOriginalExtension();
            //Filename To Store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path=$request->file('mou')->storeAs('public/MOU_files',$fileNameToStore);
        }

        //Create New Sponsor
        $sponsor=new Sponsor;
        $sponsor->name=$request->input('name');
        $sponsor->address=$request->input('address');
        $sponsor->contact=$request->input('contact');
        $sponsor->email=$request->input('email');
        $sponsor->save();

        //Create New Deal
        $deal=new Deal;
        $deal->type=$request->input('type');
        $deal->amount=$request->input('amount');
        $deal->lead=$request->input('lead');
        $deal->status=$request->input('status');
        if($request->input('status')=='Confirmed'){
        $deal->mou=$fileNameToStore;
        }else{
            $deal->mou='';
        }
        $sponsor->deal()->save($deal);

        return redirect('/marketing')->with('success','Sponsor Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $PageName='Marketing';
        $sponsor=Sponsor::find($id);
        return view('marketing.show')->with('PageName',$PageName)->with('sponsor',$sponsor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $PageName='Marketing';
        $sponsor=Sponsor::find($id);
        return view('marketing.edit')->with('PageName',$PageName)->with('sponsor',$sponsor);
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
            'address'=>'required',
            'contact'=>'required|integer',
            'email'=>'required|email'
        ]);

        //Update Sponsor
        $sponsor=Sponsor::find($id);
        $sponsor->name=$request->input('name');
        $sponsor->address=$request->input('address');
        $sponsor->contact=$request->input('contact');
        $sponsor->email=$request->input('email');
        $sponsor->save();

        return redirect("/marketing/$sponsor->id")->with('success','Sponsor Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PageName='Marketing';
        $sponsor = Sponsor::find($id);
        $deals=$sponsor->deals;
        foreach($deals as $deal)
        if($deal->mou !== ''){
            //Delete file
            Storage::delete('public/MOU_files/'.$deal->mou);
        }
        $sponsor->deals()->delete();
        $sponsor->delete();
        return redirect('/marketing')->with('success','Sponsor Removed')->with('PageName',$PageName);
    }
}
