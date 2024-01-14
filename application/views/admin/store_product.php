<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="wrapper-content">
  <div class="container">
    <div class="row  align-items-center justify-content-between">
      <div class="col-11 col-sm-12 page-title">
        <h3>Bienvenue, <?= $permission['nom']; ?> <?= $user['pseudo']; ?></h3>
        <p>Le panel est en <b>BÊTA</b></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-16">
<?php if(isset($_POST['submit'])){ ?>
<?php 
$this->db->set('title', $this->input->post('nom'));
$this->db->set('category', $this->input->post('category'));
$this->db->set('price', $this->input->post('price'));
$this->db->set('etat', $this->input->post('etat'));
$this->db->where('id', $product['id']);
$this->db->update('products__list');

 ?>
	<div class="alert alert-success">Le produit vient d'être mis à jour avec succès !</div>
<?php } ?>
<?php if(isset($_POST['download'])){ ?>
<?php 
$filename = "uploads/produits/".$product['file']."";
$file_zip_name = "CB-".$product['title'].".zip";
if (file_exists($filename)) {
	 header('Content-disposition: attachment; filename='.$file_zip_name.'');
     header('Content-type: application/zip');
     readfile($filename);
	 
     // delete file
     //unlink();
?>
	<div class="alert alert-success">Téléchargement du fichier avec succès !</div>
<?php }else{ ?>
	<div class="alert alert-danger">Fichier non téléchargé ! </div>
<?php } ?>
<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Modification du produit <?= $product['title']; ?></h5>
          </div>
          <div class="card-body">
            <form method="POST">
		        <div class="form-row">
		            <div class="col-md-16">
		                <input type="text" name="nom" class="form-control" placeholder="Nom du produit" value="<?= $product['title']; ?>">
		            </div>
		        </div>
		        <br>
		        <div class="form-row">
		            <div class="col-md-16">
		                <input type="number" name="price" class="form-control" placeholder="Prix" step="0.01" value="<?= $product['price']; ?>">
		            </div>
		        </div>
		        <br>
		        <div class="form-row">
		            <div class="col-md-16">
					    <select name="category" class="form-control">
						    <option selected disabled">Catégorie</option>
							<option value="0" <?php if($product['category'] == "0"){ ?>selected<?php } ?>>Accueil</option>
							<?php $query_shop__categories = $this->db->get('products__category');						 
							foreach ($query_shop__categories->result() as $row_shop__categories){ ?>
							<option value="<?= $row_shop__categories->id; ?>" <?php if($product['category'] == $row_shop__categories->id){ ?>selected<?php } ?>><?= $row_shop__categories->name; ?></option>
							<?php } ?>
						</select>
		            </div>
		        </div>
		        <br>
				<div class="form-row">
		            <div class="col-md-16">
		                <select name="etat" class="form-control">
						    <option selected disabled">Etat</option>
							<option value="0" <?php if($product['etat'] == "0"){ ?>selected<?php } ?>>Non publié</option>
							<option value="1" <?php if($product['etat'] == "1"){ ?>selected<?php } ?>>Publié</option>
						</select>
		            </div>
		        </div>
		        <br>
				<div class="form-row">
				<div class="col-md-8">
                    <button style="width:100%;" type="submit" name="submit" class="btn btn-primary mb-2">Modifier</button>
		        </div>
				<div class="col-md-8">
                    <button style="width:100%;" type="submit" name="download" class="btn btn-info mb-2">Télécharger le fichier (.zip)</button>
		        </div>
				</div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
<script type="text/javascript">
 $(document).ready(function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div class="form-row" style="padding-top: 10px;padding-bottom: 10px;"><div class="col-md-12"><input type="hidden" value="<?= $user['id']; ?>" name="field_id[]"><input type="text" class="form-control" size="100" name="field_cmd[]" value="" placeholder="say {pseudo} message"></div><a href="javascript:void(0);" class="col-md-4 btn btn-danger remove_button">Supprimer ce choix</a></div></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>