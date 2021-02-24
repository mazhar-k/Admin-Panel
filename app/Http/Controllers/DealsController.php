<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Sponsor;
use App\Deal;
use Illuminate\Support\Facades\Redirect;
class DealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $PageName='Marketing';
        $sponsor = Sponsor::find($id);
        return view('marketing.deals.create')->with('PageName',$PageName)->with('sponsor',$sponsor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'type'=>'required',
            'amount'=>'required|integer|min:0',
            'lead'=>'required',
            'status'=>'required'
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

        $sponsor=Sponsor::find($id);
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

        return redirect("/marketing/$sponsor->id")->with('success','Deal Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $deal=Deal::find($id);
        return view('marketing.deals.edit')->with('PageName',$PageName)->with('deal',$deal);
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
            'type'=>'required',
            'amount'=>'required|integer|min:0',
            'lead'=>'required',
            'status'=>'required'
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
            // Delete file if exists
            $deal= Deal::find($id);
            Storage::delete('public/MOU_files/'.$deal->mou);
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

        //Update Deal
        $deal=Deal::find($id);
        $deal->type=$request->input('type');
        $deal->amount=$request->input('amount');
        $deal->lead=$request->input('lead');
        $deal->status=$request->input('status');
        if($request->input('status')=='Confirmed'){
            $deal->mou=$fileNameToStore;
        }else{
            Storage::delete('public/MOU_files/'.$deal->mou);
            $deal->mou='';
        }
        $deal->save();

        return redirect("/marketing/$deal->sponsor_id")->with('success','Deal Updated');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $sponsor_id)
    {
        $PageName='Marketing';
        $sponsor=Sponsor::find($sponsor_id);
        $deal = Deal::find($id);
        if($deal->mou !== ''){
            //Delete Image
            Storage::delete('public/MOU_files/'.$deal->mou);
        }
        $deal->delete();
        return redirect("/marketing/$sponsor->id")->with('success','Deal Removed')->with('PageName',$PageName);
    }

    public function downloadMou($id){
        $deal=Deal::find($id);
        $file="./storage/MOU_files/$deal->mou";
        return Response::download($file);
    }
}
