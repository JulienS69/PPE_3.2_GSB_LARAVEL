<?php

namespace App\Http\Controllers;

use App\Models\Lignefraisforfaits;
use App\Models\Lignefraishorsforfaits;
use Illuminate\Http\Request;

class ModificationFichesFraisHorsForfaitsController extends Controller
{

    //Cette fonction va permettre de récupérer l'id de la fiche de frais hors forfaits en fonction de la selection de l'utilisateur.
    public function ModifierFFHF($idFicheHorsForfait){
        $uneFicheHorsForfait = Lignefraishorsforfaits::find($idFicheHorsForfait);
    //Accès à tous les attributs de la table Lignefraishorsforfaits dans 'RecupFF' qui est appelé pour remplir les différents champs dans la vue ModificationFicheFraisHorsForfait
        return view('ModificationFicheFraisHorsForfait', ['RecupFFHF'=>$uneFicheHorsForfait]);

    }


    //Méthode permettant la modification du montant de la fiche de frais hors forfaits.
    public function Verification_ModificationFFHF(Request $request){
        $mois = $request->input('mois');
        $libelle = $request->input('libelle');
        $date = $request->input('date');
        $montant = $request->input('montant');


        Lignefraishorsforfaits::where([['mois', $mois], ['date', $date]])
            ->update(['montant'=> $montant]);

        /*DB::table('ligne_frais_forfaits')
            ->where([
                ['mois', $mois],
                ['FraisForfait_id', $type]
            ])
            ->update(
                [
                    'quantite' => $newqte
                ]);*/

        return view('OperationValideModifFicheFraisHF');
    }
}
