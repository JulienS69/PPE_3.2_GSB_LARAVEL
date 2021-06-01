<?php

namespace App\Http\Controllers;

use App\Models\fichefrais;
use App\Models\fraisforfaits;
use App\Models\Lignefraisforfaits;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class FicheFraisController extends Controller
{
    public function index()
    {
        // Récupération du nom du visiteur actuellement connecté
        $name = Auth::user()->name;

        $visiteur = User::where('name', $name)->first();
        // Le compact permet de récuperer la variable $visiteur dans la vue.
        return view('CreationFicheFrais', compact('visiteur'));
    }

    public function store(Request $request)
    {
        // Condition permettant de dire que si le visiteur choisi l'option ''Selectionner une option', une erreur est retourné
        // Sinon l'option est récupéré grâce à l'input 'option' qui contient les différents types de frais
        // l'id correspond à un type de frais par exemple si le type de frais choisi est 'Nuitée' alors celle-ci correspond à l'id 2
        // car l'id qui est égale à 2 dans la table fiche de frais correspond au libelle "Nuitée" donc l'id sera égale à 2.
        if ($request->input('option') == 'Selectionner une option') {
            return back()->with('fail', 'Impossible de prendre cette option');
        }
        if ($request->input('option') == 'Forfait Etape') {
            $id = 1;
        } elseif ($request->input('option') == 'Nuitée') {
            $id = 2;
        } elseif ($request->input('option') == 'Repas') {
            $id = 3;
        } else {
            $id = 4;
        }
        //Le code suivant va permettre de respecter la contrainte lors de la création d"une fiche de frais qui consiste à pouvoir crée une fiche de frais
        // en renseignant le mois, le type de frais et la quantite du frais selectionnée. Un même type de frais ne peut être entré deux fois dans le même mois
        // cad qu'il n'est en aucun possible par exemple si nous avons crée une fiche de frais avec le type 'Repas' pour le mois de MAI , il ne sera pas possible de
        //recréer une fiche de frais avec le type de frais 'Repas' pour le mois de MAI une deuxieme fois.


        // Récupération des fiches de frais déjà entrées.
        $ancienneFicheMois = Lignefraisforfaits::all();
        // Déclaration de la variable $exist qui est un tableau
        $exist = array();
        //Récupération pour chaque fiches le mois entré ainsi que l'id de la fiche de frais,
        // ! à ne pas confondre avec l'id cité précédement qui correspond à la table frais forfait et qui correspond aux différents types de frais.
        foreach ($ancienneFicheMois as $uneFiche) {
            if ($uneFiche->mois == $request->mois && $uneFiche->fraisforfaits_id == $id) {
                $exist[] = $uneFiche;
            }
        }
        // Si lors de la création de notre fiche de frais, aucunes crées precédement correspondent au même mois avec le même type de frais
        // Alors on sauvegarde la fiche de frais
        // Sinon la variable $exist ne sera pas null cela voudra dire qu'il en existe déjà une et un message d'erreur apparaît.
        // On retourne un message de Validation de la création de la fiche si celle-ci à pu être sauvegardé.
        // Le !empty est une fonction qui va nous permettre de savoir si notre variable est vide, si celle-ci n'est pas vide
        // on regarde si la valeur à la ligne [0] du tableau est null, si celui-ci est vide cela veut dire que nous n'avons pas trouvé un frais qui à le
        // même mois et le même type de frais.
        // Le deuxieme else permet de savoir si le tableau $exist est vide, ça veut dire qu'aucune note de frais est strictement égale à celle qu'on veut enregistrer,
        // donc on enregistre la nouvelle fiche de frais

        if (!empty($exist)) {
            if ($exist[0] == null) {
                $cfff = new lignefraisforfaits();
                $cfff->visiteur_id = Auth::user()->id;
                $cfff->mois = $request->mois;
                $cfff->quantite = $request->quantite;
                $cfff->fraisforfaits_id = $id;
                $cfff->save();
            } else {
                return back()->with('fail', 'Cette fiche de frais existe déjà!');
            }
        } else {
            $cfff = new lignefraisforfaits();
            $cfff->visiteur_id = Auth::user()->id;
            $cfff->mois = $request->mois;
            $cfff->quantite = $request->quantite;
            $cfff->fraisforfaits_id = $id;
            $cfff->save();
        }
        return view('OperationValideFicheFrais');

        /*try {
            $save = $cfff->save();
            return view('OperationValideFicheFrais');
        }
        // Si une erreur SQL est capturé alors une erreur est retourné sous forme de text.
        catch (Exception $e) {
            return back()->with('fail', 'Impossible de choisir le même type de frais pour un même mois');
        }
        */
    }
}
