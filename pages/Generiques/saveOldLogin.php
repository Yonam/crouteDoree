
<?php

    if(!empty($_POST)){
        if($Auth->login($_POST)){
            header("Location:?page=acceuil");

        }
    }
?>
<?php include("pages/include/headerNormal.php"); ?>



<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">Croute Dorée</h1>

        </div>
        <h3>Bienvenue</h3>
        <p>Votre application de gestion.
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Connectez vous pour profiter de la toutes ses facilités.</p>
                <form class="m-t" role="form" action="" method="post" name="connect">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Nom de utilisateur" name="Login" type="text" id = "Login" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Mot de Passe" name="Pwd" type="password"  id = "Pwd" value="">
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit"  name="Submit" class="btn btn-primary block full-width m-b" value="Connexion">

                    </fieldset>

                </form>

        <p class="m-t"> <small>Copyright 2018</small> </p>
    </div>
</div>


<!-- jQuery -->


