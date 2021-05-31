<!-- PDF Généré affichant les différents frais avec les différents types et les montant calculé pour chaque frais entrée en fonction de la quantité
     pour un mois sélectionné [Route N°10] -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche de frais</title>
</head>

<body>
<h1 style="text-align: center">Fiche de frais</h1>
<p style="text-align: center;text-decoration: underline">Recapitulatif du mois</p>
<p style="text-align: center;text-decoration: underline">{{$_POST['recupmois']}}</p>
<br/>
<p style="text-decoration: underline"><strong>Information sur la fiche de frais</strong></p>

<label>Prenom du visiteur : <strong>{{Auth::user()->name}}</strong></label><br/>

<label>Identifiant : <strong>{{Auth::user()->visiteur_id}}</strong></label><br/>
------------------------------------------------------------------------------------------------------------------------
<br/><br/>


@if(Session::get('fail'))
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Erreur !</h4>
            <p class="mb-0">{{Session::get('fail')}}</p>
        </div>
    @endif

    <Label style="text-align: center">Type de frais : <strong>Forfait Etape</strong></Label><br/>
    <!-- Utilisation de variables super globales afin de récupérer la quantité en fonction du type de frais et afin de calculer le montant du frais en fonction des tarifs.
      Et toujours en fonction du mois choisi précedement.
     [Route N°10 et méthode GenerationPDF]-->
    <label>Quantite sur le mois : <strong>{{$_POST['NbForfaitEtape']}}</strong></label><br/><br/>
------------------------------------------------------------------------------------------------------------------------
    <br/><br/>

    <Label>Type de frais : <strong>Nuits</strong></Label><br/>
    <label>Quantite sur le mois : <strong>{{$_POST['NbNuits']}}</strong></label><br/>
    <label>Montant total du frais : <strong>{{$_POST['Nuits']}} €</strong></label><br/><br/>
------------------------------------------------------------------------------------------------------------------------
    <br/><br/>

    <Label>Type de frais : <strong>Repas</strong></Label><br/>
    <label>Quantite sur le mois : <strong>{{$_POST['nbRepas']}}</strong></label><br/>
    <label>Montant total du frais : <strong>{{$_POST['Repas']}} €</strong></label><br/><br/>
------------------------------------------------------------------------------------------------------------------------
    <br/><br/>

    <Label>Type de frais : <strong>Frais Kilometrique</strong></Label><br/>
    <label>Quantite sur le mois : <strong>{{$_POST['NbKilometres']}} km</strong></label><br/>
    <label>Montant total du frais : <strong>{{$_POST['Kilometrage']}} €</strong></label><br/><br/>
------------------------------------------------------------------------------------------------------------------------
    <br/><br/>

<br>
<br><br>
<p style="text-decoration: underline"><strong>Tarif des Frais</strong></p>
<p><strong>Nuitee : 80,00€/nuit</strong></p>
<p><strong>Repas : 25,00€/repas</strong></p>
<p><strong>Kilometre : 0.62€/Km</strong></p>

</body>
</div>
</html>
