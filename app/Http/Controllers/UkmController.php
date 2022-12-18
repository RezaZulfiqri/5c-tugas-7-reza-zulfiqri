<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;

class UkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukms = Ukm::with('mahasiswas')->paginate(5);

        return view('ukms.index',compact('ukms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('ukms.create');
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
            'nama_ukm'=>'required',
        ]);
        $ukm = Ukm::create([
            'nama_ukm' => $request->nama_ukm
        ]);

        if($ukm){
            return redirect()->route('ukm.index')->with(['success' => 'Successfully Added Data Extracurriculer']);
        }else{
            return redirect()->route('ukm.update')->with('error');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Ukm $ukm)
    {

        return view('ukms.edit',[
            'ukm' => $ukm
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ukm  $Ukm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Ukm $ukm)
    {
        $validate = $this->validate($request,[
            'nama_ukm'=>'required',
        ]);
        Ukm::where('id', $ukm->id)->update($validate);

        if($ukm){
            return redirect()->route('ukm.index')->with(['success' => 'Data Berhasil UKM berhasil diubah!']);
        }else{
            return redirect()->route('ukm.edit')->with('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ukm  $Ukm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukm $ukm)
    {
        $ukm->delete();

        return redirect()->route('ukm.index')->with('success',"Data Berhasil dihapus!");
    }
}
