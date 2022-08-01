<?php

namespace App\Http\Controllers;

use App\Models\Enquete;
use Illuminate\Http\Request;

use DB;

class EnqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquetes = Enquete::get();
        return view('enquetes.index',compact('enquetes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enquetes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        Enquete::create($request->all());
     
        return redirect()->route('enquetes.index')
                          ->with('success','Enquete created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function show(Enquete $enquete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquete $enquete)
    {
        return view('enquetes.edit',compact('enquete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquete $enquete)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
    
        $enquete->update($request->all());
    
        return redirect()->route('enquetes.index')
                        ->with('success','Enquete updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquete $enquete)
    {
        $enquete->delete();
    
        return redirect()->route('enquetes.index')
                        ->with('success','Enquete deleted successfully');
    }

     /**
     * Show the report of all Enquetes.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        $reports = Enquete::orderBy('title')->get();
        return view('reports.index',compact('reports'));
    }

     /**
     * Show the report of the Expireds Enquetes.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportExpireds()
    {
        $reports = DB::select('select * from enquetes WHERE DATEDIFF(END, NOW()) < 0 order by title');
        return view('reports.expireds',compact('reports'));
    }

     /**
     * Show the report of the in progress Enquetes.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportInProgress()
    {
        $reports= DB::select('select * from enquetes where DATEDIFF(START, NOW()) <= 0 AND DATEDIFF(END, NOW()) >= 0 order by title');
        return view('reports.inProgress',compact('reports'));
    }

     /**
     * Show the report of the not initiated Enquetes.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportNotInitiated()
    {
        $reports = DB::select('select * from enquetes WHERE DATEDIFF(START, NOW()) > 0 order by title');
        return view('reports.notInitiated',compact('reports'));
    }
}
