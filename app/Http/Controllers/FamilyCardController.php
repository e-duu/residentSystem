<?php

namespace App\Http\Controllers;

use App\Exports\FamilyCardExport;
use App\Exports\FamilyCardsTemplateExport;
use App\Imports\FamilyCardsImport;
use App\Models\FamilyCard;
use App\Models\Member;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class FamilyCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = FamilyCard::all();
        $members = Member::all();
        // Filter berdasarkan rt (rukun tetangga)
        if (request()->get('rt') && request()->get('rt') != null) {
            $items = $items->where('rt', '=', request()->get('rt'));
        }
        // Filter berdasarkan rw (rukun warga)
        if (request()->get('rw') && request()->get('rw') != null) {
            $items = $items->where('rw', '=', request()->get('rw'));
        }
        // Filter berdasarkan kecamatan / desa
        if (request()->get('village') && request()->get('village') != null) {
            $items = $items->where('village', '=', request()->get('village'));
        }
        return view('pages.family-cards.index', compact('items', 'members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $residents = Resident::all();
        return view('pages.family-cards.create', compact('residents'));
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
            'family_card_number' => 'required|integer',
            'address' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'village' => 'required|string',
        ]);
        FamilyCard::create($data);
        Alert::success('Selamat', 'Kartu Keluarga Berhasil Dibuat');
        return redirect()->route('family-card.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = FamilyCard::findorfail($id);
        $members = Member::all();
        return view('pages.family-cards.show', compact('item', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $families = FamilyCard::findOrFail($id);
        $residents = Resident::all();
        return view('pages.family-cards.edit', compact('families', 'residents'));
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
            'family_card_number' => 'required|integer',
            'address' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'village' => 'required|string',
        ]);
        FamilyCard::find($data);
        $item = FamilyCard::findOrFail($id);
        $item->update($data);
        Alert::success('Selamat', 'Kartu Keluarga Berhasil Diedit');
        return redirect()->route('family-card.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = FamilyCard::findorfail($id);
        $data->members()->delete();
        $data->delete();
        Alert::success('Selamat', 'Kartu Keluarga Berhasil Dihapus');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        Excel::import(new FamilyCardsImport, $request->file('file')->store('temp'));
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new FamilyCardExport, 'data-kartu-keluarga.xlsx');
    }

    public function template()
    {
        return Excel::download(new FamilyCardsTemplateExport(), 'Data Penduduk.xlsx');
    }

    public function filterreset()
    {
        return redirect()->route('family-card.index');
    }
}
