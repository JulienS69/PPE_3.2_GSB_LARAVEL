<?php

namespace App\Http\Controllers;

use App\Models\Fraisforfaits;
use App\Models\Lignefraisforfaits;

use App\Models\Lignefraishorsforfaits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModificationFichesFraisController extends Controller
{

    // Cette méthode permet de récupérer les id des fiches de frais crée, d'ou l'ajout d'un attribut dans la table lignefraisforfaits
    // qui est une clé primaire qui s'auto incremente, cela va permettre de récupéré l'id de la fiche lorsque l'on va cliqué sur le boutton de modification d"une fiche en particulier.
    public function ModifierFF($FicheFraisForfaits){

            $uneFicheFraisForfait = Lignefraisforfaits::find($FicheFraisForfaits);
            // $typeNote ici permet de récupérer dans la table fraisforfait, l'id du frais en fonction de l'id de la ligne de frais crée.
            // Cela permet aussi d'avoir accès aux différents attributs de la table fraisforfaits, cela nous évite de faire la jointure.
            $typeNote = Fraisforfaits::find($uneFicheFraisForfait->fraisforfaits_id);
            return view('ModificationFicheFrais', ['uneFicheFraisForfait'=>$uneFicheFraisForfait, 'typefrais'=>$typeNote]);

        }
    /*
       $fraisforfaits_id = $request->input('fraisforfaits_id');
       $mois = $request->input('mois');
       $quantite = $request->input('quantitefraisselectionne');
       $id = Auth::user()->visiteur_id;


       $RecupFF = LigneFraisForfaits::addSelect('visiteur_id','fraisforfaits.libelle as Type_de_Frais', 'mois', 'quantite')
           ->join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
           ->join('visiteurs', 'lignefraisforfaits.visiteur_id', '=', 'visiteurs.id')
           ->where('visiteur_id', $id)
           ->get();

        /*
                $RecupFF = LigneFraisForfaits::where('visiteur_id', $id)
                ->get(;

        $getFF = Lignefraisforfaits::addSelect(['visiteur_id as Numéro_du_Visiteur', 'fraisforfaits.libelle as type_de_frais', 'lignefraisforfaits.mois as mois', 'lignefraisforfaits.quantite as Quantite_du_frais_selectionné'])
                   ->join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                   ->join('visiteurs', 'lignefraisforfaits.visiteur_id', '=', 'visiteurs.id')
                   ->where('visiteurs.id', $id)
                   ->first();
        */

    //Application des modifications de la fiche
    //Cette fonction va nous permettre de modifier la quantite d'une fiche de frais selectionnée.
    public function Verification_Modification(Request $request){
        $id = $request->input('idfiche');
        $quantite = $request->input('quantitefraisselectionne');

        LigneFraisForfaits::where('id_lignefraisforfaits', $id)->update(['quantite' => $quantite]);

        /*DB::table('ligne_frais_forfaits')
            ->where([
                ['mois', $mois],
                ['FraisForfait_id', $type]
            ])
            ->update(
                [
                    'quantite' => $newqte
                ]);*/

        return view('OperationValideModifFicheFrais');
    }
}
