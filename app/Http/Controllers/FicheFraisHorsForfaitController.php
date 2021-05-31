<?php

namespace App\Http\Controllers;

use App\Models\Lignefraishorsforfaits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FicheFraisHorsForfaitController extends Controller
{
    public function index()
    {
        // Récupération du nom du visiteur actuellement connecté
        $name = Auth::user()->name;
        // Au lieu de renvoyer une collection de modèles, ->first permmet de renvoyer une seule instance de modèle.
        // $visiteur récupère le nom de l'utilisateur qui est connecté
        $visiteur = User::where('name', $name)->first();
        return view('CreationFicheFraisHorsForfait', compact("visiteur"));
    }

    public function store(Request $request)
    {
        //Récupération de l'id de l'utilisateur actuellement connecté
        $id = Auth::user()->id;
        $FicheFHFExiste = false;

       /* $recupdate = Lignefraishorsforfaits::addSelect('visiteur_id', 'date')
            ->where('visiteur_id', $id)
            ->first();
        foreach ($recupdate as $recupunedate){
            //Tester chaque date récupérée pour voir si elle existe déjà
            if ($recupunedate[1] = $request->date){
                $FicheFHFExiste = true;
            }
        // if ($FicheFHFExiste != true){
        }
       */

        //Récupération des données entrées dans les inputs de la vue CréationFicheFraisHorsForait
        //grâce au $request->date par exemple, cela va permettre de récupérer la date de l'input et l'enregistrer
        //dans la variable $cffhf qui instancie une ligne de frais hors forfaits. Une fois que toutes les informations du
        //formulaire sont récupérés, les données sont enregistrées dans la bdd et retourne la vue OperationValideFicheFraisHorsForfaits.
        $cffhf = new Lignefraishorsforfaits();
        $cffhf->visiteur_id = Auth::user()->id;
        $cffhf->date = $request->date;
        $cffhf->libelle = $request->motiffrais;
        $cffhf->montant = $request->montant;
        $cffhf->mois = $request->datengagement;
        $cffhf->save();
        return view('OperationValideFicheFraisHorsForfaits');
    }

}
