<?php

namespace App\Http\Controllers;

use App\Exports\DieExport;
use App\Exports\DiesTemplateExport;
use App\Imports\DieImport;
use App\Imports\DiesImport;
use App\Models\Dies;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Dies::all();
        // Filter berdasarkan penyebab kematian
        if (request()->get('reason') && request()->get('reason') != null) {
            $items = $items->where('reason', '=', request()->get('reason'));
        }

        // Filter berdasarkan waktu kematian
        if (request()->get('date_of_death') && request()->get('date_of_death') != null) {
            $items = $items->where('date_of_death', '=', request()->get('date_of_death'));
        }
        return view('pages.dies.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $residents = Resident::all();
        return view('pages.dies.create', compact('residents'));
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
        $request->validate([
            'date_of_death' => 'required|date',
            'reason' => 'required|string',
        ]);
        Alert::success('Selamat', 'Data Kematian Berhasil Dibuat');
        $residents = Resident::find($request->resident_id);
        $data['name'] = $residents->name;
        Dies::create($data);
        $residents->members()->delete();
        $residents->delete();
        return redirect()->route('die.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Dies::findorfail($id);
        return view('pages.dies.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dies = Dies::findOrFail($id);
        $residents = Resident::all();
        return view('pages.dies.edit', compact('dies', 'residents'));
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
        $request->validate([
            'date_of_death' => 'required|date',
            'reason' => 'required|string',
        ]);
        Dies::find($data);
        $item = Dies::findOrFail($id);
        $item->update($data);
        Alert::success('Selamat', 'Data Kematian Berhasil Diubah');
        return redirect()->route('die.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Dies::findorfail($id);
        $data->delete();
        Alert::success('Selamat', 'Data Kematian Berhasil Dihapus');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        Excel::import(new DiesImport, $request->file('file')->store('temp'));
        Alert::success('Selamat', 'Data Kematian Berhasil Diimport');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new DieExport, 'data-kematian.xlsx');
    }

    public function template()
    {
        return Excel::download(new DiesTemplateExport(), 'Data Kematian.xlsx');
    }

    public function filterreset()
    {
        return redirect()->route('die.index');
    }
}
