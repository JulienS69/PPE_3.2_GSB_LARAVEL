<!-- Vue permettant l'affichage d'une interface permettant la modification de la quantité pour une fiche de frais selectionnée
    au cas ou le visiteur se serait trompé lors du renseignement de la quantité pour le type de frais selectionnée lors de la
    création de sa fiche de frais. [Route N°12, méthode ModifierFF]
-->
@extends('layouts/app')
<link rel="icon" href="{{asset('images/pill.ico')}}">
@section('extra-css')

    <link href="{{asset('css/visualisationfichefrais.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="col">
            <h1 style="font-size: 25px;font-family: 'Lobster Two', cursive, sans-serif;text-align: center;margin-left: 15%;">
                Modifier la fiche de frais</h1>
        </div>
    </div>
    <br>
    <div class="col-md-12 search-table-col">
        <div class="table-responsive table table-hover table-bordered results">
            <table class="table table-hover table-bordered" style="align-content: center">
                <thead class="bill-header cs" style="text-align: center; align-content: center">
                <tr>
                    <th id="trs-hd" class="col-lg-0">ID de la fiche</th>
                    <th id="trs-hd" class="col-lg-0">Mois</th>
                    <th id="trs-hd" class="col-lg-0">Type de frais</th>
                    <th id="trs-hd" class="col-lg-0">Quantité du frais</th>
                    <th id="trs-hd" class="col-lg-0">Valider les modifications</th>
                </tr>

     <!-- Récupère la méthode Verification_Modification du controller ModificationFichesFraisController
     Cette méthode permet de valider la modification de la quantite d'une fiche de frais et la méthode ModifierFF permet la récupération des attributs de la table en fonction de
     l'ID d'une fiche de frais forfait. Cela permet au visiteur de pouvoir modifier la fiche de frais selectionnée dans l'interface.
     [Route N°14, Méthode Verification_Modification]
     Le formulaire récupère la route qui porte le nom 'verrifier_modif'-->
    <form action="{{route('verrifier_modif')}}" method="post" >
        @csrf
        <tr>
            <td><input style="text-align: center" class="form-control" type="text" value="{{$uneFicheFraisForfait->id_lignefraisforfaits}}" name="idfiche" readonly></td>
            <td><input style="text-align: center" class="form-control" type="text" value="{{$uneFicheFraisForfait->mois}}" name="mois" readonly></td>
            <td><input style="text-align: center" class="form-control" type="text" value="{{$typefrais->libelle}}" name="typefrais" readonly></td>
            <td><input style="text-align: center" class="form-control" type="text" value="{{$uneFicheFraisForfait->quantite}}" name="quantitefraisselectionne"></td>
            <td><button class="btn btn-success" style="margin-left: 5px;" type="submit" value="valider la modification">
                    <i class="fa fa-check" style="font-size: 15px;"></i>
                </button></td>
        </tr>
    </form>
@endsection
