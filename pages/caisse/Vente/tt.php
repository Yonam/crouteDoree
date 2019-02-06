<?php
include_once("fonctions_panier.php");
?>
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nouvelle vente</h1>
                </div>
                <div class="row">

                <div class="col-sm-6 col-sm-offset-3">
                <form method="post" action='http://localhost/OwoNew/index.php?page=vente'>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="search" name="search" class="form-control">
                     <span class="input-group-btn"><button type="submit" name="submit" class="btn btn-default"> go</button></span>
                </div>
                   
                </form>
                
                </div>
                <div class="col-lg-12">                    
                </div>
                <div class="col-sm-6"></div>

                    <form class="form-horizontal">
                        <label>
                            
                        </label>
                    </form>
                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12" style="height:200px; overflow:auto;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Base de donnee des produits
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php if (count($produits) > 0): ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Code CIP</th>
                                        <th>Designation</th>
                                        <th>DCI</th>
                                        <th>Forme</th>
                                        <th>Prix</th>
                                        <th>Action</th>
                                    </tr>
                                <tbody>
                                <?php foreach ($produits as $produit): ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $produit->CIP; ?></td>
                                        <td><?php echo $produit->DESIGNATION; ?></td>
                                        <td><?php echo $produit->DCI; ?></td>
                                        <td ><?php echo $produit->CODE_FORME; ?></td>
                                        <td ><?php echo $produit->PRIX_PRODUIT; ?></td>
                                        <td class="center">
                                            <a class="btn btn-outline btn-primary fa fa-gear" href="#"></a>
                                            <a class="btn btn-outline btn-success fa fa-times" href="?page=vente&amp;CODE_PRODUIT=<?php echo $produit->CODE_PRODUIT; ?>"></a>
                                            <a class="btn btn-outline btn-warning fa fa-times" href="#"></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                </tbody>
                            </table>
                            <?php else: ?>
                                    pas de produits
                                <?php endif; ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Panier du client</h2>
                        </div>
                        <!-- /.panel-heading -->
            <form method="post" action="ajout_vente.php">
                           <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Nombre</th>
                                        <th>Prix</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php  
                                  if (creationPanier())
                                  {
                                    $nbArticles=count($_SESSION['panier']['DESIGNATION']);
                                    if ($nbArticles <= 0)
                                    echo "<tr><td>Votre panier est vide </ td></tr>";
                                    else
                                    {
                                        for ($i=0 ;$i < $nbArticles ; $i++)
                                        {
                                           echo "<tr>";
                                            echo "<td>".htmlspecialchars($_SESSION['panier']['DESIGNATION'][$i])."</ td>";
                                            echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['NB_VENDU'][$i])."\"/></td>";
                                            echo "<td>".htmlspecialchars($_SESSION['panier']['PRIX_PRODUIT'][$i])."</td>";
                                            echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['DESIGNATION'][$i]))."\">XX</a></td>";
                                            echo "</tr>";
                                        }

                                                    echo "<tr><td colspan=\"2\"> </td>";
                                                    echo "<td colspan=\"2\">";
                                                    echo "Total : ".MontantGlobal();
                                                    echo "</td></tr>";

                                                    echo "<tr><td colspan=\"4\">";
                                                    echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                                                    echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

                                                    echo "</td></tr>";
                                      }
                                }


                                          ?> 
                 </tbody>
               </table>

                </form>
               </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>

          
