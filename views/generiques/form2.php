
<!DOCTYPE html>
<html lang="en">
<?php include("../headerNormal.php"); ?>

<body>
<div id="wrapper">

        <!-- Navigation -->
        <?php include("../menu.php"); ?>

</div>

<div id="page-wrapper">
<!--ouverture de la fenetre pour ajouter une personne-->
<div class="modal fade" id="btnAjouterPersonnel"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="">
      
      
      
      <div class="modal-body">
        <form role="form">
            <div class="form-group">
              <label ><span class="glyphicon glyphicon-user"></span> Nom</label>
              <input type="text" class="ui-autocomplete ui-widget-content ui-corner-all" id="autocompletenom" name="autocompletenom" placeholder="Entrer le nom"> 
            </div>
            <div>
             <Label class = "contrôle-label"> Sélectionnez la photo 
             <Input id = "uploader" name = "image" type = "file" classe multiple = "file-chargement">
            </Label>
            </div>
            <div class="form-group">
              <label ><span class="glyphicon glyphicon-user"></span> Photo</label>
              <input type="text" class="form-control" id="Photo" placeholder="donner un nom a la photo">
            </div>
            <div class="form-group">
              <label ><span class="glyphicon glyphicon-user"></span> Nom</label>
              <input type="text" class="form-control" id="nompersonnel" placeholder="">
            </div>
            <div class="form-group">
              <label ><span class="glyphicon glyphicon-user"></span> Prénom</label>
              <input type="text" class="form-control" id="prenompersonnel" placeholder="">
            </div>
            <div class="form-group">
            <label ><span class="glyphicon glyphicon-user"></span> uid</label>
              <input type="text" class="form-control" id="uidldap" placeholder="">
            </div>
            <div class="form-group">
              <label ><span class="glyphicon glyphicon-star-empty"></span> Fonction</label>
                <select id="selectFonction" class="selectpicker form-control" data-style="btn-danger" >
                  <option value="0">selectionnez une fonction</option>
            <?php
            foreach ($fonctions as $key => $uneFonction) {
              echo '<option value="'.$uneFonction['idfonction'].'">'.$uneFonction['nomfonction'].'</option>';
            }
            ?>        
              </select>
            </div>
            <div class="form-group">
              <label ><span class="glyphicon glyphicon-user"></span> commentaire</label>
              <input type="text" class="form-control" id="commentaire" placeholder="Entrer le commentaire">
            </div>
          
          <div class="form-group">
              <label ><span class="glyphicon glyphicon-home"></span> Structure</label>
              <select id="selectStructure" class="selectpicker form-control" data-style="btn-danger" >
              <option value="0">cliquez pour selectionner </option>
            <?php
            foreach($structures as $key => $uneStructure) {
                          echo "<option value=\"".$uneStructure['idstructure']."\">";
                          echo $uneStructure['nomstructure'];
                          echo "</option>";
                        }
             ?>        
            </select>
            </div>            
              <div class="form-group">
              <label ><span class="glyphicon glyphicon-envelope"></span> Mail</label>
              <input type="text" class="form-control" id="mailpersonnel" placeholder="">
          </div>
          
          <div class="form-group">
              <label ><span class="glyphicon glyphicon-object-align-left"></span> Bureau</label>
              <input type="text" class="form-control" id="bureaupersonnel" placeholder="Entrer le numéro du bureau">
          </div>
          
          <div class="form-group">
              <label ><span class="glyphicon glyphicon-earphone"></span> Numéro</label>
              <input type="text" class="form-control" id="numeropersonnel" placeholder="Entrer le numéro de téléphone">
          </div>
          
          <div class="form-group">
              <label ><span class="glyphicon glyphicon-sort-by-order"></span> Ordre</label>
              <input type="text" class="form-control" id="ordre" placeholder="Entrer l'ordre">
          </div>
       </form>
       </div>
      <div class="modal-footer">
          <button type="button" class="btnSup2 left" id="btnAjouterP" data-dismiss="modal" class="btn btn-default pull-left"><span class="glyphicon glyphicon-ok"></span> Ajouter</button>
          <button type="button" class="annuler" class="btn btn-default btn-default pull-center" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
            </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

    <?php include("../footerNormal.php"); ?>

</body>

</html>

