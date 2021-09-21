<?php

namespace App\Http\Controllers;

use App\Exports\ComerExport;
use App\Exports\ComersTemplateExport;
use App\Imports\ComersImport;
use App\Models\Comer;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ComerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Comer::all();
        // Filter berdasarkan jenis kelamin
        if (request()->get('gender') && request()->get('gender') != null) {
            $items = $items->where('gender', '=', request()->get('gender'));
        }

        // Filter berdasarkan nik (Nomor induk kependudukan)
        if (request()->get('id_number') && request()->get('id_number') != null) {
            $items = $items->where('id_number', '=', request()->get('id_number'));
        }
        return view('pages.comers.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $residents = Resident::all(); 
        return view('pages.comers.create', compact('residents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Comer::create($data);
        Alert::success('Selamat', 'Data Pendatang Berhasil Dibuat');
        return redirect()->route('comer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Comer::findorfail($id);
        return view('pages.comers.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comers = Comer::findOrFail($id);
        $residents = Resident::all();
        return view('pages.comers.edit', compact('comers', 'residents'));
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
        $data = $request->all();
        Comer::find($data);
        $item = Comer::findOrFail($id);
        $item->update($data);
        Alert::success('Selamat', 'Data Pendatang Berhasil Diubah');
        return redirect()->route('comer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Comer::findorfail($id);
        $data->delete();
        Alert::success('Selamat', 'Data Pendatang Berhasil Dihapus');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        Excel::import(new ComersImport, $request->file('file')->store('temp'));
        Alert::success('Selamat', 'Data Pendatang Berhasil Diimport');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new ComerExport, 'data-pendatang.xlsx');
    }

    public function template()
    {
        return Excel::download(new ComersTemplateExport(), 'Data Kepergian.xlsx');
    }

    public function filterreset()
    {
        return redirect()->route('comer.index');
    }
}
