<?php

namespace App\Http\Controllers;

use App\Exports\MoveExport;
use App\Exports\MovesTemplateExport;
use App\Imports\MovesImport;
use App\Models\Move;
use App\Models\Resident;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class MoveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Move::all();
        // Filter berdasarkan alasan pindah
        if (request()->get('reason') && request()->get('reason') != null) {
            $items = $items->where('reason', '=', request()->get('reason'));
        }

        // Filter berdasarkan waktu pindah
        if (request()->get('migration_date') && request()->get('migration_date') != null) {
            $items = $items->where('migration_date', '=', request()->get('migration_date'));
        }
        return view('pages.moves.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $residents = Resident::all();
        return view('pages.moves.create', compact('residents'));
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
            'migration_date' => 'required|date',
            'reason' => 'required|string',
        ]);
        Alert::success('Selamat', 'Data Migrasi Berhasil Dibuat');
        $residents = Resident::find($request->resident_id);
        $data['name'] = $residents->name;
        Move::create($data);
        $residents->members()->delete();
        $residents->delete();
        return redirect()->route('move.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Move::findorfail($id);
        return view('pages.moves.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $moves = Move::findOrFail($id);
        $residents = Resident::all();
        return view('pages.moves.edit', compact('moves', 'residents'));
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
        Move::find($data);
        $item = Move::findOrFail($id);
        $item->update($data);
        Alert::success('Selamat', 'Data Kematian Berhasil Diubah');
        return redirect()->route('move.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Move::findorfail($id);
        $data->delete();
        Alert::success('Selamat', 'Data Kematian Berhasil Dihapus');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        Excel::import(new MovesImport, $request->file('file')->store('temp'));
        Alert::success('Selamat', 'Data Kematian Berhasil Diimport');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new MoveExport, 'data-kepergian.xlsx');
    }

    public function template()
    {
        return Excel::download(new MovesTemplateExport(), 'Data Kepergian.xlsx');
    }

    public function filterreset()
    {
        return redirect()->route('move.index');
    }
}
