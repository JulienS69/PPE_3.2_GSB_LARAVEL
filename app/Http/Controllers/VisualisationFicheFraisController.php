<?php

namespace App\Http\Controllers;

use App\Models\Lignefraisforfaits;
use App\Models\User;
use App\Models\Visiteurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisualisationFicheFraisController extends Controller
{

    // Cette fonction permet de récupéré toutes les fiches de frais créées par le visiteurs et de les récupérer dans la variable $getFF.
    public function show()
    {
        $id = Auth::user()->visiteur_id;
        $getFF = Lignefraisforfaits::addSelect(['id_lignefraisforfaits', 'visiteur_id as Numéro_du_Visiteur', 'fraisforfaits_id as id_du_frais','fraisforfaits.libelle as type_de_frais', 'lignefraisforfaits.mois', 'lignefraisforfaits.quantite as Quantite_du_frais_selectionné'])
            ->join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
            ->join('visiteurs', 'lignefraisforfaits.visiteur_id', '=', 'visiteurs.id')
            ->where('visiteurs.id', $id)
            ->get();

        /*
        $frais = array();
        $id = Auth::user()->visiteur_id;

        $lesFrais = Lignefraisforfaits::all();
        foreach($lesFrais as $unFrais){
            if($unFrais->visiteur_id == $id){
                $frais[] = $unFrais;
            }
        }
        ['lesFrais'=>$frais]
        */

       return view('VisualisationFicheFrais', compact('getFF'));
   }

}
