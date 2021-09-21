<?php

namespace App\Http\Controllers;

use App\Exports\ResidentExport;
use App\Exports\ResidentsTemplateExport;
use App\Models\Resident;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ResidentsImport;
use App\Models\FamilyCard;
use App\Models\Member;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Resident::all();
        $families = FamilyCard::all();
        $members = Member::all();
        $numbers = Member::get();
        foreach ($numbers as $number) {
            $family = $number;
        }
        // Filter berdasarkan jenis kelamin
        if (request()->get('gender') && request()->get('gender') != null) {
            $items = $items->where('gender', '=', request()->get('gender'));
        }
        // Filter berdasarkan agama
        if (request()->get('religion') && request()->get('religion') != null) {
            $items = $items->where('religion', '=', request()->get('religion'));
        }
        // Filter berdasarkan status pernikahan
        if (request()->get('marital_status') && request()->get('marital_status') != null) {
            $items = $items->where('marital_status', '=', request()->get('marital_status'));
        }
        if ($members->count() == null) {
            return view('pages.residents.index', compact('items', 'families', 'members'));
        } else {
            return view('pages.residents.index', compact('items', 'families', 'members', 'family'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.residents.create');
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
            'name' => 'required|string',
            'id_number' => 'required|integer',
            'email' => 'required|email',
            'place_of_birth' => 'required|string',
            'born_date' => 'required|date',
            'education' => 'required',
            'type_of_work' => 'required|string',
            'address' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'contact' => 'required|integer',
            'village' => 'required|string',
        ]);
        Resident::create($data);
        Alert::success('Selamat', 'Data Penduduk Berhasil Dibuat');
        return redirect()->route('resident.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Resident::findorfail($id);
        return view('pages.residents.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $residents = Resident::findOrFail($id);
        return view('pages.residents.edit', compact('residents'));
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
            'name' => 'required|string',
            'id_number' => 'required|integer',
            'email' => 'required|email',
            'place_of_birth' => 'required|string',
            'born_date' => 'required|date',
            'education' => 'required',
            'type_of_work' => 'required|string',
            'address' => 'required|string',
            'rt' => 'required|integer|max:2',
            'rw' => 'required|integer|max:2',
            'contact' => 'required|integer',
            'village' => 'required|string',
        ]);
        Resident::find($data);
        $item = Resident::findOrFail($id);
        $item->update($data);
        Alert::success('Selamat', 'Data Penduduk Berhasil Diedit');
        return redirect()->route('resident.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Resident::findorfail($id);
        $data->delete();
        Alert::success('Selamat', 'Data Penduduk Berhasil Dihapus');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        Excel::import(new ResidentsImport, $request->file('file')->store('temp'));
        Alert::success('Selamat', 'Data Penduduk Berhasil Diimport');
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new ResidentExport, 'data-penduduk.xlsx');
    }

    public function template()
    {
        return Excel::download(new ResidentsTemplateExport(), 'Data Penduduk.xlsx');
    }

    public function filterreset()
    {
        return redirect()->route('resident.index');
    }
}
