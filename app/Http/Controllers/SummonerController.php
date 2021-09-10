<?php

namespace App\Http\Controllers;

use App\Models\Summoner;
use Illuminate\Http\Request;

class SummonerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Summoner  $summoner
     * @return \Illuminate\Http\Response
     */
    public function show(Summoner $summoner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Summoner  $summoner
     * @return \Illuminate\Http\Response
     */
    public function edit(Summoner $summoner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Summoner  $summoner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Summoner $summoner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Summoner  $summoner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Summoner $summoner)
    {
        //
    }
}
