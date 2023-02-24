<?php

namespace App\Http\Controllers;

use App\Http\Requests\CupomRequest;
use App\Models\Cupom;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cupoms = Cupom::paginate(10);
        return view("cupom.index", compact("cupoms"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cupom.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CupomRequest $request)
    {
        $cupom = $request->validated();
        Cupom::create($cupom);
        return redirect()->route('cupom.index');
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
        $cupom = Cupom::find($id);
        return view("cupom.edit", compact('cupom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CupomRequest $request, $id)
    {   
        $req = $request->except("_token","_method");
        Cupom::where("id",$id)->update($req);
        return redirect()->route('cupom.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cupom $cupom)
    {
        $cupom->delete();
        return redirect()->route('cupom.index');
    }
}
