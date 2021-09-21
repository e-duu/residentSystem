<?php

namespace App\Http\Controllers;

use App\Exports\MembersExport;
use App\Imports\MembersImport;
use App\Models\FamilyCard;
use App\Models\Member;
use App\Models\Resident;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $residents = Resident::all();
        $families = FamilyCard::findOrFail($id);
        return view('pages.family-cards.add-member', compact('residents', 'families'));
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
        Member::create($data);
        Alert::success('Selamat', 'Data Kematian Berhasil Dibuat');
        return redirect()->route('family-card.show', $request->family_card_id);
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
        $data = Member::findorfail($id);
        $data->delete();
        Alert::success('Selamat', 'Data Kematian Berhasil Dihapus');
        return back();
    }
}
