<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsPostController extends Controller
{
    
    public function __construct()
    {
        
        /**
         * Nesse primeiro exemplo é possivel ver 
         * $this->middleware('auth') // proibe todos os metodos
         * $this->middleware('auth')->only(['update', 'store']); // proibe apenas os metodos update e store
         */
        
        $this->middleware('auth')->except([
            'index', 'show'
        ]); // proibe todos com exceção ao metodo index
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.teste', ['param'=>123]); // Passando valores para view
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
