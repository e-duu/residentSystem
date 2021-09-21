<?php

namespace App\Http\Controllers;

use App\Models\Comer;
use App\Models\Dies;
use App\Models\FamilyCard;
use App\Models\Resident;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $residents = Resident::all();
        $families = FamilyCard::all();
        $comers = Comer::all();
        $dies = Dies::all();
        $pie = [
            'islam' => Resident::where('religion', 'ISLAM')->count(),
            'katolik' => Resident::where('religion', 'KATOLIK')->count(),
            'kristen' => Resident::where('religion', 'KRISTEN')->count(),
            'hindu' => Resident::where('religion', 'HINDU')->count(),
            'buddha' => Resident::where('religion', 'BUDDHA')->count(),
            'khonghucu' => Resident::where('religion', 'KHONGHUCU')->count(),
            'atheis' => Resident::where('religion', 'ATHEIS')->count()
        ];
        $gender = [
            'man' => Resident::where('gender', 'MAN')->count(),
            'woman' => Resident::where('gender', 'WOMAN')->count(),
            'other' => Resident::where('gender', 'OTHER')->count()
        ];
        $age = [
            '10' => Resident::all()->whereBetween('age', [0, 10])->count(),
            '20' => Resident::all()->whereBetween('age', [11, 20])->count(),
            '30' => Resident::all()->whereBetween('age', [21, 30])->count(),
            '40' => Resident::all()->whereBetween('age', [31, 40])->count(),
            '50' => Resident::all()->whereBetween('age', [41, 50])->count(),
            '60' => Resident::all()->whereBetween('age', [51, 60])->count(),
            '70' => Resident::all()->whereBetween('age', [61, 70])->count(),
            '80' => Resident::all()->whereBetween('age', [61, 70])->count(),
            '90' => Resident::all()->whereBetween('age', [61, 70])->count(),
            '100' => Resident::all()->whereBetween('age', [61, 70])->count()
        ];
        $die = Dies::all()->count();
        return view('pages.dashboard', compact('residents', 'families', 'comers', 'dies', 'pie', 'gender', 'die', 'age'));
    }
}
