<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

use DB;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $options = Option::get();
        return view('options.index',compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('options.create');
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
            'enquete_id' => 'required',
            'answers' => 'required',
       ]);
    
       if ($request->answers == 'basico'){
             $a1 = 1;
             $a2 = 0;
             $a3 = 0;
        } elseif ($request->answers == 'intermediario'){
             $a1 = 0;
             $a2 = 1;
             $a3 = 0;
        }
        else {
             $a1 = 0;
             $a2 = 0;
             $a3 = 1;
        }

        Option::create([
            'enquete_id' => $request->enquete_id,
            'answer1' => $a1,
            'answer2' => $a2,
            'answer3' => $a3,
        ]);
     
        return redirect()->route('enquetes.index')
                         ->with('success','Votos created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //return view('options.create',compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        return view('options.edit',compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        
        $request->validate([
            //'enquete_id' => 'required',
            'answers' => 'required',
        ]);
        
        if ($request->answers == 'basico'){
            $a1 = 1;
            $a2 = 0;
            $a3 = 0;
        } elseif ($request->answers == 'intermediario'){
            $a1 = 0;
            $a2 = 1;
            $a3 = 0;
        }
        else {
            $a1 = 0;
            $a2 = 0;
            $a3 = 1;
        }

       DB::table('options')
       ->where('id', $option->id)
       ->update(['answer1' => $a1, 'answer2' => $a2, 'answer3' => $a3 ]);

        return redirect()->route('options.index')
                         ->with('success','Resposta updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();
    
        return redirect()->route('options.index')
                         ->with('success','Resposta deleted successfully');
    }

     /**
     * Create a vote for the Enquete
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function vote(Option $option,$id)
    { 
         return view('options.create');
    }

}
