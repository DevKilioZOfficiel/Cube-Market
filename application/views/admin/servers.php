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
	  <?php
$this->db->order_by('id', 'ASC');
$query3 = $this->db->get('connect');						 
foreach ($query3->result() as $row3){ ?>
<?php if(isset($_POST['nom_'.$row3->id.''])){ ?>
<?php if($this->input->post('nom') != $row3->server_name){
	$this->db->set('server_name', $this->input->post('nom'));
	$this->db->where('id', $row3->id);
	$this->db->update('connect'); ?>
	<div class="alert alert-success">Le nom à été modifié avec succès !</div>
<?php } ?>
<?php } ?>
<?php if(isset($_POST['type_'.$row3->id.''])){ ?>
<?php if($this->input->post('typee') != $row3->typee){
	$this->db->set('server_type', $this->input->post('typee'));
	$this->db->where('id', $row3->id);
	$this->db->update('connect'); ?>
	<div class="alert alert-success">Le type de serveur à été modifié avec succès !</div>
<?php } ?>
<?php } ?>
<?php if(isset($_POST['pwd_'.$row3->id.''])){ ?>
<?php if($this->input->post('typee') != $row3->connect__password){
	$this->db->set('connect__password', $this->input->post('password'));
	$this->db->where('id', $row3->id);
	$this->db->update('connect'); ?>
	<div class="alert alert-success">Le mot de passe du moyen de connexion à été modifié avec succès !</div>
<?php } ?>
<?php } ?>
<?php if(isset($_POST['prt_'.$row3->id.''])){ ?>
<?php if($this->input->post('port') != $row3->connect__port){
	$this->db->set('connect__port', $this->input->post('port'));
	$this->db->where('id', $row3->id);
	$this->db->update('connect'); ?>
	<div class="alert alert-success">Le port du moyen de connexion à été modifié avec succès !</div>
<?php } ?>
<?php } ?>


<?php if(isset($_POST['delete__'.$row3->id.''])){ ?>
<?php
$tables = array('connect');
$this->db->where('id', $this->input->post('id'));
$this->db->delete($tables); ?>
    <div class="alert alert-info">Le serveur vient d'être supprimé avec succès !</div>
<?php } ?>
<?php } ?>
<?php if(isset($_POST['add_srv'])){ ?>
<?php 
$data = array(
        'server_name' => $this->input->post('name__server'),
        'server_ip' => $this->input->post('ip__server'),
        'server_type' => $this->input->post('type__server'),
        'connect__password' => $this->input->post('password__type'),
        'connect__port' => $this->input->post('port__type')
);

$this->db->insert('connect', $data);
 ?>
	<div class="alert alert-success">Le serveur vient d'être ajouté avec succès !</div>
<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Serveurs <small><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Ajouter un serveur</button></small></h5>
          </div>
          <div class="card-body">
            <table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Nom</th>
                  <th>IP</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('connect');						 
				foreach ($query->result() as $row){ ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->server_name; ?></td>
                  <td><?= $row->server_ip; ?></td>
                  <td><?= $row->server_type; ?></td>
                  <td class="center">
				  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $row->id; ?>">Modifier</button>
				  <form method="POST"><input type="hidden" value="<?= $row->id; ?>" name="id"><button type="submit" name="delete__<?= $row->id; ?>" class="btn btn-danger">Supprimer</button></form>
				  </td>
                </tr>
				<?php } ?>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>


<?php
$this->db->order_by('id', 'ASC');
$query2 = $this->db->get('connect');						 
foreach ($query2->result() as $row2){ ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $row2->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $row2->id; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier le serveur "<?= $row2->server_name; ?> (<?= $row2->server_type; ?>)"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
        <form method="POST">
		<div class="form-row">
          <div class="col-md-12">
            <input type="text" name="name" class="form-control" id="inputPassword2" placeholder="Nom" value="<?= $row2->server_name; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="nom_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		
		<form method="POST">
		<div class="form-row">
          <div class="col-md-12">
		    <select name="typee" class="form-control">
			    <option disabled>Choisir un choix</option>
			    <option value="rcon" <?php if($row2->server_type == "rcon"){ ?>selected<?php } ?>>Rcon</option>
			    <option value="query" <?php if($row2->server_type == "query"){ ?>selected<?php } ?>>Query</option>
			</select>
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="type_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		
		<form method="POST">
		<div class="form-row">
          <div class="col-md-12">
		    <input type="text" name="password" class="form-control" id="inputPassword2" placeholder="Mot de passe" value="<?= $row2->connect__password; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="pwd_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		
		<form method="POST">
		<div class="form-row">
          <div class="col-md-12">
		    <input type="number" name="port" class="form-control" id="inputPassword2" placeholder="Mot de passe" value="<?= $row2->connect__port; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="prt_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		<?php } ?>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau serveur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
		<div class="form-row">
          <div class="col-md-16">
            <input type="text" name="name__server" class="form-control" id="inputPassword2" placeholder="Nom du serveur">
		  </div>
		</div>
		<br>
		<div class="form-row">
          <div class="col-md-16">
            <input type="text" name="ip__server" class="form-control" id="inputPassword2" placeholder="IP (chiffre !)">
		  </div>
		</div>
		<br>
		<div class="form-row">
          <div class="col-md-16">
		    <select name="type__server" class="form-control">
			    <option disabled selected>Choisir un choix</option>
			    <option value="rcon">Rcon</option>
			    <option value="query">Query</option>
			</select>
		  </div>
		</div>
		<br>
		<div class="form-row">
          <div class="col-md-16">
		    <input type="text" name="password__type" class="form-control" id="inputPassword2" placeholder="Mot de passe (du moyen de connexion)">
		  </div>
		</div>
		<br>
		<div class="form-row">
          <div class="col-md-16">
		    <input type="text" name="port__type" class="form-control" id="inputPassword2" placeholder="Port (du moyen de connexion)">
		  </div>
		</div>
		<?php } ?>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
        <button type="submit" name="add_navig" class="btn btn-primary">Ajouter le serveur !</button>
      </div>
	</form>
    </div>
  </div>
</div>


<script src="<?= base_url('assets/admin/'); ?>vendor/flot/excanvas.min.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.pie.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.resize.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.time.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>