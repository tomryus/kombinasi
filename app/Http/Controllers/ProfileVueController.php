<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProfileVueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vue= \App\Profile::all();
        return response()->json([
            'data_Profile' =>$vue //data itu koneksi ke vuescript di profilecomponent
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'email'=>'required|unique:profiles',
            'nama'=>'required|min:3',
            'pekerjaan'=>'required',
        ]);

        
        $vuesave =  \App\Profile::create([
            'email'=> $request->email,
            'nama' => $request->nama,
            'pekerjaan' => $request ->pekerjaan
            
        ]);

        return response()->json([
            'data_Profile'=> $vuesave,
            'pesan' =>'sukses'
        ],201);
        
        

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
        //
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
            'email'=>'required|unique:profiles',
            'nama'=>'required',
            'perkerjaan'=>'required',
        ]);

        $vue =  \App\Profile::find($id);
            $vue->nama      = $request->nama;
            $vue->email     = $request->email;
            $vue->pekerjaan = $request->pekerjaan;
            $vue-> save();

        return response()->json([
            'data_Profile' => $vue,
            'pesan' => 'sukses',

        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vue = \App\Profile::find($id);
        $vue -> delete();
        return response()->json([
         'data'=>$vue,
         'pesan'=>'sukses',   
        ],201);
        

    }
}
