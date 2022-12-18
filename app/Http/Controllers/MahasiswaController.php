<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Ukm;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(){
        
        $mahasiswas = Mahasiswa::with('ukms')->paginate(5);

        return view('mahasiswas.index',compact('mahasiswas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Mahasiswa $mahasiswa)
    {   
        $ukms = Ukm::get();
        return view('mahasiswas.create',[
            'mahasiswa' => $mahasiswa,
            'ukms' => $ukms,
        ]);
    
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
            'npm'=>'required|max:12',
            'nama'=>'required',
            'umur'=>'required|integer|between:19,24',
            'prodi' => 'required',
            'nama_ukm' => 'required',
        ]);

        $mahasiswa = Mahasiswa::create([
            'npm' => $request['npm'],
            'nama' =>$request['nama'],
            'umur' => $request['umur'],
            'prodi' => $request['prodi'],
        ]);

        $ukms= Ukm::find($request->ukm_id);
        $mahasiswa->ukms()->sync($ukms);
        
        if($mahasiswa){
            return redirect()->route('mahasiswa.index')->with(['success' => 'Data Berhasil Ditambahkan']);
        }else{
            return redirect()->route('mahasiswa.update')->with('error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswas = Mahasiswa::get();
        return view('welcome',compact('mahasiswas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $ukms = Ukm::get();
        return view('mahasiswas.edit',[
            'mahasiswa' => $mahasiswa,
            'ukms' => $ukms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'npm'=>'required|max:12',
            'nama'=>'required',
            'umur'=>'required|integer|between:19,24',
            'prodi' => 'required',
        ]);
        
        $mahasiswa->update([
            'npm' => $validated['npm'],
            'nama' =>$validated['nama'],
            'umur' => $validated['umur'],
            'prodi' => $validated['prodi'],
            
        ]);
      
        $ukms= Ukm::find($request->ukm_id);
        $mahasiswa->ukms()->sync($ukms);

        if($mahasiswa){
            return redirect()->route('mahasiswa.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('mahasiswa.edit')->with('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success',"Data berhasil dihapus");
    }
}
