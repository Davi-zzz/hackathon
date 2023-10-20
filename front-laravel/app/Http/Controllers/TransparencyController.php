<?php

namespace App\Http\Controllers;

use App\Models\TransparencyModel;
use App\Http\services\TransparencyServices;
use Illuminate\Http\Request;

class TransparencyController
{
    public function testes()
    {
        TransparencyServices::testeGetWebContent();
    }
    public function index()
    {
        //
        return view('transparency/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function webScrapingResult()
    {
        $data = TransparencyServices::getWebContent();
        return view('transparency/scrapingResult', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TransparencyModel $transparencyModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransparencyModel $transparencyModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransparencyModel $transparencyModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransparencyModel $transparencyModel)
    {
        //
    }
}
