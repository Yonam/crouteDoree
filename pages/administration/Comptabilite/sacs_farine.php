
<?php
    if (isset($_POST['eval_team'])) {
        $total_sacs= isset($_POST['total_sacs'])?$_POST['total_sacs']:0;
        $max_sacs= isset($_POST['max_sacs'])?$_POST['max_sacs']:0;
        $date_livraison= isset($_POST['date_livraison'])?$_POST['date_livraison']:0;
        $boulangers= isset($_POST['boulangers'])?$_POST['boulangers']:0;
        $distribution= isset($_POST['distribution'])?$_POST['distribution']:0;
        $sacs= isset($_POST['sacs'])?$_POST['sacs']:0;
        
        if ((int)$sacs> $max_sacs) {
            $verdict = 0;
        }else {
            $verdict = 1;
        }

        $result = 'INSERT INTO evaluation (DATE_LIVRAISON, EQUIPE_BOULANGERS, EQUIPE_DISTRIBUTION, SACS_UTILISE, TOTAL_SYSTEM, MAXIMUM_SAC, VERDICT) VALUES ("'.$date_livraison.'","'. $boulangers.'","'. $distribution.'",'. $sacs.','. $total_sacs.','. $max_sacs.','. $verdict.')';
        $bdd->query($result);

        /*$result = $bdd->prepare("INSERT INTO evaluation(DATE_LIVRAISON, EQUIPE_BOULANGERS, EQUIPE_DISTRIBUTION, SACS_UTILISE, TOTAL_SYSTEM, MAXIMUM_SAC, VERDICT) VALUES (:total_sacs, :max_sacs, :date_livraison, :boulangers, :distribution, :sacs, :verdict )");
        $result->execute(array(
                            'total_sacs'=>$total_sacs,
                            'max_sacs'=>$max_sacs,
                            'date_livraison'=>$_POST['date_livraison'],
                            'boulangers'=>$boulangers,
                            'distribution'=>$distribution,
                            'sacs'=>$sacs,
                            'verdict'=>$verdict));*/
        var_dump($result);

        echo '<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Evaluation effectuee. 
        </div>';

    }

?>

<style type="text/css">
    

    form input[type="text"], input[type="number"]{
        width: 50%;
        border: none;
        border-bottom: 0.2em grey solid;
        font-size: 18px;
        margin-top: 1em;
    }

    #team_eval input[type="text"], input[type="number"]{
        width: 100%;
        border: none;
        border-bottom: 0.2em grey solid;
        font-size: 18px;
        margin-top: 1em;
    }

    form input[type="submit"]{
        margin-left: 2em;
        border:0.2em blue solid;
        height: 3em;
    }

    #team_eval input[type="submit"]{
        margin-left: 0;
        border:0.2em blue solid;
        height: 3em;
        width: 100%;
        margin-top: 1em;
    }

    .evaluation_grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .team {
        display: grid;
        grid-template-columns: 60% 40%;
        grid-gap: 1em;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">RECAP DE L'UTILISATION DES SACS DE FARINE</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div>
  <div>
    <form method="post" action="">
      <input type="date" name="search" id="search">
      <input type="submit" name="search_submit" value="valider"> 
    </form>
  </div>

  <br/><br/>           
  
  <?php 
    if (isset($_POST['search_submit'])) { 
    
        
            
        /*Recuperation des pains*/

        $req = $bdd->prepare('SELECT CODE_CMDE, C.NOM_CLIENT, DATE_CMDE, HEURE_LIVRAISON, NUMERO_TICKET FROM commande CMD JOIN client C ON CMD.CODE_CLIENT = C.CODE_CLIENT WHERE DATE_LIVRAISON = :dated AND CMD.SUPPRIME = 0 AND CMD.VALIDE = 1 ORDER BY HEURE_LIVRAISON ASC');
        $req->execute(array('dated' =>$_POST['search'] ));
        
        /*recuperation de la liste des pains pour ce jour*/
        $prod = $bdd->prepare('SELECT DISTINCT(CODE_PAIN) code FROM commande_pain CP JOIN commande CM ON CP.CODE_CMDE = CM.CODE_CMDE WHERE CM.DATE_LIVRAISON = :dated AND CM.SUPPRIME = 0 AND CM.VALIDE = 1');
        $prod->execute(array('dated' =>$_POST['search']));
        $prod = $prod->fetchAll();

        if (count($prod) > 0) { 

           $newDate = strftime("%d %B %Y", strtotime($_POST['search']));

           // $newDate = strftime("%d %B %Y", int($_POST['search']) );
           // echo $newDate;
          /*  $xx =  (int)$_POST['search'];

            echo $xx;
          $x = strtotime($_POST['search']);
          echo $x;
          echo '<br/>'.$_POST['search'];*/
            ?>
            
            <div>
                <h2>Journee du <?php setlocale(LC_TIME,"fr_FR", "french");echo $newDate ?></h2>
                <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Pain</th>
                    <th>Quantite</th>
                    <th>Nombre de sacs</th>
                  </tr>
                </thead>
                <tbody>

                <?php

                $Total = 0;


            /*recuperation des quantites totales pour chaque pains*/
            foreach ($prod as $p) {
            $qtes = $bdd->prepare('SELECT SUM(CP.QUANTITE) QTE, P.LIBELLE, P.NBRE_BY_SAC FROM commande_pain CP JOIN pains P ON CP.CODE_PAIN = P.CODE_PAIN JOIN commande CM ON CP.CODE_CMDE = CM.CODE_CMDE WHERE CP.CODE_PAIN = :code AND CM.DATE_LIVRAISON = :dated AND CM.SUPPRIME = 0 AND CM.VALIDE = 1');
            $qtes->execute(array('code' =>$p->code,
                                'dated' =>$_POST['search'])); 

            
            /*Recuperation de la liste de clients qui ont commande un pain precis a ce jour*/

            $pain = $bdd->prepare('SELECT CM.CODE_CMDE, CL.NOM_CLIENT, CP.CODE_PAIN, CP.QUANTITE, P.LIBELLE FROM commande CM JOIN commande_pain CP ON CP.CODE_CMDE = CM.CODE_CMDE JOIN pains P ON P.CODE_PAIN = CP.CODE_PAIN LEFT JOIN client CL ON CL.CODE_CLIENT = CM.CODE_CLIENT WHERE DATE_LIVRAISON = :dated AND P.CODE_PAIN = :code AND CM.VALIDE = 1');
            $pain->execute(array('dated' =>$_POST['search'],
                                'code' =>$p->code));

            /*calcul et affichage du nombre de sacs de farine pour chaque pain*/
             
            foreach ($qtes as $q) { 
                $Total += $q->QTE/$q->NBRE_BY_SAC; 
                ?>
                <tr>
                    <td ><?= $q->LIBELLE ?></td>
                    <td><?= $q->QTE ?></td>
                    
                    <td><?= $q->QTE/$q->NBRE_BY_SAC ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td >

                    <?php
                        foreach ($pain as $pain) { ?>
                        <?= $pain->NOM_CLIENT ?> : <?= $pain->QUANTITE ?> <br/>  
                    <?php } ?>
                    </td>
                </tr>
                <!-- fin foreach($qtes) -->
            <?php }
            /*fin foreach($prod)*/
            } ?>

                </tbody>
           
                </table>
            </div>
            <div class="evaluation_grid">
                <div class="sys_result">
                    <h1>Total de <?= $Total ?> sacs</h1>
                    <h4>Maximum a utiliser : <?= $Total+0.5 ?> </h4>
                </div>

                <div class="team">
                    <form method="post" action="" id="team_eval">
                        <!-- Champs caches pour passer les informations -->
                            <input type="text" name="total_sacs" value="<?= $Total ?>" hidden >
                            <input type="text" name="max_sacs" value="<?= $Total+0.5 ?>" hidden >
                            <input type="text" name="date_livraison" value="<?= $_POST['search'] ?>" >
                        <div>
                            <input type="text" name="boulangers" placeholder="equipe boulanger">
                        </div>
                        
                        <div>
                            <input type="text" name="distribution" placeholder="equipe distribution">
                        </div>
                        
                        <div>
                            <input type="text" name="sacs" placeholder="nombre de sacs utilises"> 
                        </div>

                        <div>
                            <input type="submit" name="eval_team" value="valider">
                        </div>
                        
                    </form>

                    <div style="text-align: center">
                        <h2>Verdict</h2>
                          <div class="row">
                            <div class="col-lg-10">
                             <label class="col-lg-4">Bon</label>
                            <button class="btn btn-success  col-lg-3 col-lg-offset-2"></button>

                           </div>
                         </div>
                            <div class="row">
                                 <div class="col-lg-11">
                                     <label class="col-lg-5">Mauvais</label>

                                 <button class="btn btn-danger col-lg-3"></button>

                    </div>
                    </div>
                </div>                  
                
            </div>
            
    <?php 
        }
        else {?>
            <h1>Aucune donnee a afficher pour cette date</h1>

    <?php 
        }
    }
    else {
        echo "<h1> Renseignez une date </h1>";
    }
  ?>

     
      
        
