
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
        <h1 class="page-header">RENDEMENT DES EQUIPES DE TRAVAIL A CE JOUR</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div>
  <div>
    <form method="post" action="">
      <input type="date" name="evaluation" id="evaluation">
      <input type="submit" name="evaluation_submit" value="valider"> 
    </form>
  </div>

  <br/><br/>           
  
  <?php 
    if (isset($_POST['evaluation_submit'])) { 

        

            $newDate = strftime("%d %B %Y", strtotime($_POST['evaluation']));

            ?>
            
            <div>
                <h2>Journee du <?= $newDate ?></h2>
                <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Boulangers</th>
                    <th>Distributeurs</th>
                    <th>Utilisation normale</th>
                    <th>Sacs utilises</th>
                    <th>Maximum</th>
                    <th>Verdict</th>
                  </tr>
                </thead>
                <tbody>

                <?php

                $Total = 0;


            /*recuperation des quantites totales pour chaque pains*/
            
            $result = $bdd->prepare('SELECT EQUIPE_BOULANGERS, EQUIPE_DISTRIBUTION, SACS_UTILISE, TOTAL_SYSTEM, MAXIMUM_SAC, VERDICT FROM evaluation WHERE DATE_LIVRAISON = :dated ');
            $result->execute(array('dated' =>$_POST['evaluation'])); 

            
            

            /*calcul et affichage du nombre de sacs de farine pour chaque pain*/
             
            foreach ($result as $q) {  
                ?>
                <tr>
                    <td ><?= $q->EQUIPE_BOULANGERS ?></td>
                    <td><?= $q->EQUIPE_DISTRIBUTION ?></td>
                    
                    <td><?= $q->TOTAL_SYSTEM ?></td>
                    <td><?= $q->SACS_UTILISE ?></td>
                    <td><?= $q->MAXIMUM_SAC ?></td>
                    <td> <?php if ($q->VERDICT == 0) {
                        echo "Depassement";
                    }else{
                        echo "reussite";
                    } ?></td>
                </tr>
                <!-- fin foreach($result) -->
            <?php } ?>

                </tbody>
           
                </table>
            </div>
            
            
    <?php 
        
    }
    else {
        echo "<h1> Renseignez une date </h1>";
    }
  ?>

     
      
        
