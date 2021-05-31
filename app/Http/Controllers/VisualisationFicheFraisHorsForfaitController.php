<?php

namespace App\Http\Controllers;

use App\Models\Lignefraisforfaits;
use App\Models\Lignefraishorsforfaits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisualisationFicheFraisHorsForfaitController extends Controller
{
    // Fonction permettant de récupéré toutes les fiches de frais hors forfaits en fonction du visiteur connecté.
    public function show()
    {
        $id = Auth::user()->visiteur_id;
        $getFFHF = Lignefraishorsforfaits::where('visiteur_id', $id)->get();
        return view('VisualisationFicheFraisHorsForfait', compact('getFFHF'));
    }
}
