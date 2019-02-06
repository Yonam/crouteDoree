<?php

// initialisation des variables

global $bdd;
$user = $_SESSION['Auth']->code_user;

if (isset($_GET['del'])) {
  $panier->del($_GET['del']);
}

/*if (isset($_POST['infoClient'])){

    
    $Livraison = isset($_POST['dateCommande']) ? $_POST['dateCommande'] : null;
    $client = isset($_POST['client']) ? $_POST['client'] : null;
    $numTicket = isset($_POST['numTicket']) ? $_POST['numTicket'] : null;
    $heure = isset($_POST['heure']) ? $_POST['heure'] : null;

    $idClient = $client;   
    $idLivraison = $Livraison;
    $idTicket = $numTicket;  
    $heure = $heure;

}*/

      $codeTicket= $bdd->prepare("SELECT MAX(NUMERO_TICKET) as max_ticket from commande");
      $codeTicket->execute();
      $ticket = $codeTicket->fetch();

      $clients = $bdd->prepare("SELECT CODE_CLIENT, NOM_CLIENT FROM CLIENT");
      $clients->execute();
      $data=$clients->fetchAll();

    $final = 0;
    ?>
            
    <div class="panel-body">


     
      <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Nouvelle Commande</h1>
            <div id="prix_unite">
              
            </div>
        </div>
       <!-- <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <form method="post" action='http://localhost/Projet_Owo/index.php?page=vente'>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="search" name="search" class="form-control">
                     <span class="input-group-btn"><button type="submit" name="search" class="btn btn-default"> go</button></span>
                </div>
            </form>
          </div>
        </div> -->
      </div>
            <!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
                
              <div class="panel-body">
                <div class="row">

                    <form role="form" method="post" action="pages/caisse/Vente/script_commande.php" >
                            <div class=" form-group col-lg-12" id="commande_form">
                                <h3 class="col-lg-10 col-lg-offset-1"></h3>

                                <div class="form-group col-lg-4">
                                    <label for="client">*Client</label>
                                    <input type="text" class="form-control" name="client" id="client-filter" placeholder="rechercher un client">

                                    <input type="text" id="idClient" name="idClient" />

                                    <div class="result">
                                      <ul class="client" id="filter">
                                        <?php foreach ($data as $d) { ?>
                                            <li><span><?= $d->NOM_CLIENT ?></span></li>
                                      <?php  } ?>
                                      </ul>
                                    </div>
                                      
                                      
                                    <!-- <select class="form-control" id="client" name="client">
                                        <?php foreach ($data as $d) { ?>
                                            <option value="<?php echo $d->CODE_CLIENT; ?>"><?php echo $d->NOM_CLIENT; ?></option>
                                      <?php  } ?>
                                    </select>  -->
                                </div> 

                                <div class="form-group col-lg-4">
                                    <label for="ticket">*Numero de ticket</label>
                                    <input type="text" class="form-control" id="ticket" name="ticket" value="<?= $ticket->max_ticket + 1 ?>" REQUIRED/>
                                </div>

                                <div class="form-group col-lg-4">
                                  <label for="produit">*Produit</label>
                                    <input class="form-control" type="text" name="produit" id="produit">
                                    <input type="text" name="idProduit" id="idProduit" hidden="hidden">
                                    
                                    <!-- <div id="resultat">
                                      <ul>
                                        
                                      </ul>
                                    </div> -->
                                    <div class="result">
                                      <ul class="produit" id="filtere">
                                        <?php foreach ($produits as $produit) { ?>
                                            <li><span><a href="pages/caisse/Vente/post.php?pain=<?= $produit->REFERENCE?>"  class="pain"><?= $produit->LIBELLE ?></a></span></li>
                                      <?php  } ?>
                                      </ul>
                                    </div>
                                        
                                </div>

                                <div class="form-group col-lg-3 ">
                                    <label for="prix_unit">Prix unitaire</label>
                                    <input type="text" class="form-control" id="prix_unit" name="prix_unit" value="" REQUIRED/>
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="quantite">Quantite</label>
                                    <input type="text" class="form-control" id="quantite" name="quantite" value="" REQUIRED onchange="updatePrice()" />
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="total">Prix total</label>
                                    <input type="text" class="form-control" id="total" name="total" value="" REQUIRED/>
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="livraison">Date livraison</label>
                                    <input type="text" class="form-control" id="livraison" name="livraison"  value="" REQUIRED/>
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="time">Heure</label>
                                    <select class="form-control" id="time" name="time">
                                      <option value="01:00">01 H</option>
                                      <option value="02:00">02 H</option>
                                      <option value="03:00">03 H</option>
                                      <option value="04:00">04 H</option>
                                      <option value="05:00">05 H</option>
                                      <option value="06:00">06 H</option>
                                      <option value="07:00">07 H</option>
                                      <option value="08:00">08 H</option>
                                      <option value="09:00">09 H</option>
                                      <option value="10:00">10 H</option>
                                      <option value="11:00">11 H</option>
                                      <option value="12:00">12 H</option>
                                      <option value="13:00">13 H</option>
                                      <option value="14:00">14 H</option>
                                      <option value="15:00">15 H</option>
                                      <option value="16:00">16 H</option>
                                      <option value="17:00">17 H</option>
                                      <option value="18:00">18 H</option>
                                      <option value="19:00">19 H</option>
                                      <option value="20:00">20 H</option>
                                      <option value="21:00">21 H</option>
                                      <option value="22:00">22 H</option>
                                      <option value="23:00">23 H</option>
                                      <option value="24:00">24 H</option>
                                    </select>
                                </div>
                                <input type="text" name="user" id="user" hidden="hidden" value="<?= $_SESSION['Auth']->code_user ?>">
                            </div>

                        <hr class="form-group col-lg-8 col-lg-offset-2">

                        
                        <div class="col-lg-8 col-lg-push-2">
                            <input type="reset" class="btn btn-default btn-lg  col-lg-5" value="ANNULER" name="reset" />
                            <input type="submit" class="btn btn-success btn-lg  col-lg-5 col-lg-push-2 submit" name="commande" value="Valider" />
                        </div>
                    </form>
                </div>

              </div>
            </div>
          </div>
            <!-- /.col-lg-12 -->
        </div>

        </div>



     



          
