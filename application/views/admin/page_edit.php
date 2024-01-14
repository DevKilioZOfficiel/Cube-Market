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
$this->db->set('name', $this->input->post('nom'));
$this->db->set('url', $this->input->post('url'));
$this->db->set('content', $this->input->post('description'));
$this->db->where('id', $page['id']);
$this->db->update('page');

 ?>
	<div class="alert alert-success">La page vient d'être mise à jour avec succès !</div>
<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Modification de la page <?= $page['name']; ?></h5>
          </div>
          <div class="card-body">
            <form method="POST">
		        <div class="form-row">
		            <div class="col-md-16">
		                <input type="text" name="nom" class="form-control" placeholder="Nom de la page" value="<?= $page['name']; ?>">
		            </div>
		        </div>
		        <br>
		        <div class="form-row">
		            <div class="col-md-16">
		                <input type="text" name="url" class="form-control" placeholder="URL (ex faq)" value="<?= $page['url']; ?>">
		            </div>
		        </div>
		        <br>
		        <div class="form-row">
		            <div class="col-md-16">
		                <textarea name="description" id="summernote" class="form-control"><?= $page['content']; ?></textarea>
		            </div>
		        </div>
		        <br>
				<div class="form-row">
				<div class="col-md-8">
                    <button style="width:100%;" type="submit" name="submit" class="btn btn-primary mb-2">Modifier</button>
		        </div>
				<div class="col-md-8">
                    <button style="width:100%;" type="submit" name="download" disabled class="btn btn-info mb-2">Télécharger la page (bientôt)</button>
		        </div>
				</div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>