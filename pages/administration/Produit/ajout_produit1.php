<<<<<<< HEAD:pages/administration/Produit/ajout_produit1.php
                            <div class="col-lg-12">
                    <h1 class="page-header">Enregistrement d'un produit</h1>
                <!-- /.col-lg-12 -->
            </div>
            
			  <!-- /.section des identifiants -->
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
							<div class="container">			
							<div class="row">
					  			 
							 <div class="col-md-4 ">
							 <hr style="border: 0.1em solid black" />
                                        <h1 class="text-center">Identifants</h1>
                                        <hr style="border: 0.1em solid black" />
								<div class="form-group">
                                                <label>Code CIP</label>
                                                <input class="form-control" id="cip">
                                            </div>
                                            <div class="form-group">
                                                <label>Code Barre</label>
                                                <input class="form-control" id="barre">
                                            </div>
                                            <div class="form-group ">
                                                <label>Code Interne</label>
                                                <input class="form-control" id="interne">
                                            </div>
							</div>
									<div class="col-md-4 col-md-offset-2" style="margin:-3px 0px 0px 140px;">
                     <div style="max-width: 650px; margin: auto;">
        <h3 class="page-header">Image du Produit</h3>
        <p>Choisir un fichier  PNG ou JPEG , taille max <span id="max-size"></span> KB.</p>

        <form id="upload-image-form" action="" method="post" enctype="multipart/form-data">
          <div id="image-preview-div" style="display: none">
            <label for="exampleInputFile">Sélectionner un Fichier:</label>
            <br>
            <img id="preview-img" src="noimage">
          </div>
          <div class="form-group">
            <input type="file" name="file" id="file" required>
          </div>
          <button class="btn btn-lg btn-primary" id="upload-button" type="submit" disabled>Upload image</button>
        </form>

        <br>
        <div class="alert alert-info" id="loading" style="display: none;" role="alert">
          Uploading image...
          <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
          </div>
        </div>
        <div id="message"></div>
      </div>
     

										
											
										
										
								</div>
								</div>
								</div>
																					
								<div class="container">			
									<div class="row">			
									 <div class="col-md-4 ">
									  <hr style="border: 0.1em solid black" />
                                        <h1 class="text-center">Informations</h1>
                                        <hr style="border: 0.1em solid black" />
	 
                                         <div class="form-group">
                                            <label>Molecule de base</label>
                                            <input class="form-control" id="dci">
                                        </div>
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input class="form-control" id="designation">
                                        </div>
                                        <div class="form-group">
                                            <label>Date peremption</label>
                                            <input type="date" class="form-control" id="peremption"/>
                                        </div>
                                    </div> 
                                   </div>
                                    </div> 
                                    <div class="col-lg-8">
                                        <hr style="border: 0.1em solid black" />
                                        <h1 class="text-center">Prix</h1>
                                        <hr style="border: 0.1em solid black" />
                                            <div class="form-group">
											<div class="form-group col-lg-6 col-xm-2">
                                                <label>Prix d'achat</label>
                                                <input class="form-control" id="achat">
                                            </div>
											<div class="form-group col-lg-6 col-xm-2">

                                                <label>Soumis a la TVA </label>
                                                <input type="checkbox" value="">
                                            </div>
                                            <div class="form-group col-lg-6 col-xm-2">
                                                <label>TVA</label>
                                                <input class="form-control" id="tva">
                                            </div>
                                            <div class="form-group col-lg-6 col-xm-2">
                                                <label>Coeficient</label>
                                                <input class="form-control" id="coef">
                                            </div>
                                            <div class="form-group col-lg-6 col-xm-2">
                                                <label>Reduction</label>
                                                <input class="form-control" id="reduction">
                                            </div>
                                            <div class="form-group col-lg-6 col-xm-2">
                                                <label>Prix de vente</label>
                                                <input class="form-control" id="vente">
                                            </div>
                                        </div>
                                    </div> 
									
									
                                    <div class="col-lg-8">
                                        <hr style="border: 0.1em solid black" />
                                        <h1 class="text-center">Autres informations</h1>
                                        <hr style="border: 0.1em solid black" />
                                   <div class="container">			
									<div class="row">			
									 <div class="col-md-8 ">  
=======

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Enregistrement d'un produit</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            
            <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" action="http://localhost/OwoNew/index.php?page=produit">
                        
                            
                            <div class="row">
                                <h3>Identifents</h3>			
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>CIP</label>
                                        <input class="form-control" id="cip">
                                    </div>
                                    <div class="form-group">
                                        <label>Barre</label>
                                        <input class="form-control" id="barre">
                                    </div>
                                    <div class="form-group ">
                                        <label>Interne</label>
                                        <input class="form-control" id="interne">
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-2" style="margin:-3px 0px 0px 140px;">
                                    <label>La photo </label>

                                    <div class="form-group" >
                                        <textarea class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>File input</label>
                                        <input type="file" id="photo">
                                    </div>
                                </div>
                            </div>
        		
                            <div class="row">
                                <div class="col-md-4 ">
                                    <h3>Informations</h3>
                                    <div class="form-group">
                                        <label>Molecule de base</label>
                                        <input class="form-control" id="dci">
                                    </div>
                                    <div class="form-group">
                                        <label>designation</label>
                                        <input class="form-control" id="designation">
                                    </div>
                                    <div class="form-group">
                                        <label>Date peremption</label>
                                        <input type="date" class="form-control" id="peremption"/>
                                    </div>
                                </div> 
                            </div>
                        
                        
                            <div class="row">
                                
                                <hr style="border: 0.1em solid black" />
                                <h1 class="text-center">Prix</h1>
                                <hr style="border: 0.1em solid black" />
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="checkbox" value="">Soumis a la TVA
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Prix d'achat</label>
                                        <input class="form-control" id="achat">
                                    </div>
                                    <div class="form-group col-lg-6 col-xm-2">
                                        <label>Coeficient</label>
                                        <input class="form-control" id="coef">
                                    </div>
                                    <div class="form-group col-lg-6 col-xm-2">
                                        <label>Reduction</label>
                                        <input class="form-control" id="reduction">
                                    </div>
                                    <div class="form-group col-lg-6 col-xm-2">
                                        <label>Prix de vente</label>
                                        <input class="form-control" id="vente">
                                    </div>
                                </div>
                            </div> 


                            <div class="row">
                                <hr style="border: 0.1em solid black" />
                                <h1 class="text-center">Autres informations</h1>
                                <hr style="border: 0.1em solid black" />
                                		
                                    <div class="row">			
                                        <div class="col-md-4 ">  
>>>>>>> c912fe64423ba9eef20d5efba2328217229ea7ff:views/administration/Produit/ajout_produit.php
                                            <div class="form-group col-lg-4">
                                                <label>Laboratoire</label>
                                                <select class="form-control" id="laboratoire">
                                                    <option>1</option>
                                                    <option>2</option>
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Localisation</label>
                                                <select class="form-control" id="localisation">
                                                    <option>1</option>
                                                    <option>2</option>
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Exploitant</label>
                                                <select class="form-control" id="exploiatant">
                                                    <option>1</option>
                                                    <option>2</option>
                                                </select> 
                                            </div>
                                            <div class="row">	
                                                <div class="form-group col-lg-4">
                                                <label>Classe</label>
                                                    <select class="form-control" id="classe">
                                                        <option>1</option>
                                                        <option>2</option>
                                                    </select> 
                                                </div>
                                                <div class="form-group col-lg-4">
                                                <label>Specialite</label>
                                                    <select class="form-control" id="specialite">
                                                        <option>1</option>
                                                        <option>2</option>
                                                    </select> 
                                                </div>
                                                <div class="form-group col-lg-4">
                                                <label>Forme</label>
                                                    <select class="form-control" id="forme">
                                                        <option>1</option>
                                                        <option>2</option>
                                                </select> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <button type="submit" name="submit"class="btn btn-success col-lg-5">Envoyer</button>
                                        <button type="reset" name="submit"class="btn btn-danger col-lg-5 col-lg-push-2">Annuler</button>
                                    </div>
                                
                            </div>
                        
                    </form>
                </div>           
            </div>

        </div> 
    </div>
    <!-- /.section des identifiants -->
    </div>

    


<<<<<<< HEAD:pages/administration/Produit/ajout_produit1.php
                <!-- /.col-lg-12 -->
            </div>
			<script>
			function noPreview() {
  $('#image-preview-div').css("display", "none");
  $('#preview-img').attr('src', 'noimage');
  $('upload-button').attr('disabled', '');
}

function selectImage(e) {
  $('#file').css("color", "green");
  $('#image-preview-div').css("display", "block");
  $('#preview-img').attr('src', e.target.result);
  $('#preview-img').css('max-width', '550px');
}

$(document).ready(function (e) {

  var maxsize = 500 * 1024; // 500 KB

  $('#max-size').html((maxsize/1024).toFixed(2));

  $('#upload-image-form').on('submit', function(e) {

    e.preventDefault();

    $('#message').empty();
    $('#loading').show();

    $.ajax({
      url: "upload_image.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(data)
      {
        $('#loading').hide();
        $('#message').html(data);
      }
    });

  });

  $('#file').change(function() {

    $('#message').empty();

    var file = this.files[0];
    var match = ["image/jpeg", "image/png", "image/jpg"];

    if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) )
    {
      noPreview();

      $('#message').html('<div class="alert alert-warning" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');

      return false;
    }

    if ( file.size > maxsize )
    {
      noPreview();

      $('#message').html('<div class=\"alert alert-danger\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');

      return false;
    }

    $('#upload-button').removeAttr("disabled");

    var reader = new FileReader();
    reader.onload = selectImage;
    reader.readAsDataURL(this.files[0]);

  });

});
			</script>
  
            
            
=======
>>>>>>> c912fe64423ba9eef20d5efba2328217229ea7ff:views/administration/Produit/ajout_produit.php
