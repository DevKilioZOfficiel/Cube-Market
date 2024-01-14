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
$query3 = $this->db->get('user');						 
foreach ($query3->result() as $row3){ ?>
<?php if(isset($_POST['mail_'.$row3->id.''])){ ?>
<?php if($this->input->post('email') != $row3->email){
	$this->db->set('email', $this->input->post('email'));
	$this->db->where('id', $row3->id);
	$this->db->update('user'); ?>
	<div class="alert alert-success">Vous venez de modifier l'email de <?= $row3->pseudo; ?> !</div>
<?php } ?>
<?php } ?>

<?php if(isset($_POST['money_'.$row3->id.''])){ ?>
<?php if($this->input->post('argent') != $row3->argent){
	$this->db->set('argent', $this->input->post('argent'));
	$this->db->where('id', $row3->id);
	$this->db->update('user'); ?>
	<div class="alert alert-success">Vous venez de modifier l'argent de <?= $row3->pseudo; ?> !</div>
<?php } ?>
<?php } ?>

<?php if(isset($_POST['pwd_'.$row3->id.''])){ ?>
<?php if(sha1($this->input->post('password')) != sha1($row3->password)){
	$this->db->set('password', sha1($this->input->post('password')));
	$this->db->where('id', $row3->id);
	$this->db->update('user'); ?>
	<div class="alert alert-success">Vous venez de modifier le mot de passe de <?= $row3->pseudo; ?> !</div>
<?php } ?>
<?php } ?>

<?php if(isset($_POST['grade_'.$row3->id.''])){ ?>
<?php if($this->input->post('rank') != $row3->grade){
	$this->db->set('grade', $this->input->post('rank'));
	$this->db->where('id', $row3->id);
	$this->db->update('user'); ?>
	<div class="alert alert-success">Vous venez de modifier le grade de <?= $row3->pseudo; ?> !</div>
<?php } ?>
<?php } ?>

<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Membres <small>(<?= $this->db->count_all_results('user'); ?>)</small></h5>
          </div>
          <div class="card-body">
            <table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Pseudo</th>
                  <th>Grade</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('user');						 
				foreach ($query->result() as $row){ ?>
				<?php $perm_row = $this->permissions_model->get_permissions($row->grade); ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->pseudo; ?></td>
                  <td><?= $perm_row['nom']; ?></td>
                  <td class="center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $row->id; ?>">Modifier</button></td>
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
$query2 = $this->db->get('user');						 
foreach ($query2->result() as $row2){ ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $row2->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $row2->id; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier les informations de <?= $row2->pseudo; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <?php if($permission['PERM__ADM_EDIT_EMAIL'] == 1){ ?>
	    <form method="POST">
		<div class="form-row">
          <div class="col-md-12">
            <input type="text" name="email" class="form-control" id="email" placeholder="Nouveau email">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="mail_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		<?php } ?>
	  
	    <?php if($permission['PERM__ADM_EDIT_MONEY'] == 1){ ?>
	    <form method="POST">
		<div class="form-row">
          <div class="col-md-12">
            <input type="number" name="argent" step=".01" class="form-control" id="argent" value="<?= $row2->argent; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="money_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		<?php } ?>
	 
	    <?php if($permission['PERM__ADM_EDIT_PWD'] == 1){ ?>
        <form method="POST">
		<div class="form-row">
          <div class="col-md-12">
            <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Nouveau mot de passe">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="pwd_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		<?php } ?>
		
	    <?php if($permission['PERM__ADM_EDIT_RANK'] == 1){ ?>
		<form method="POST">
		<div class="form-row">
          <div class="col-md-12">
		    <select name="rank" class="form-control">
			    <?php
				$this->db->order_by('id', 'ASC');
				$query_grade = $this->db->get('permissions');						 
				foreach ($query_grade->result() as $row_grade){ ?>
				<?php $perm_row = $this->permissions_model->get_permissions($row2->grade); ?>
				    <option value="<?= $row_grade->id_grade; ?>" <?php if($row2->grade == $row_grade->id_grade){ ?>disabled<?php } ?>><?= $row_grade->nom; ?> <?php if($row2->grade == $row_grade->id_grade){ ?>Actuel<?php } ?></option>
				<?php } ?>
			</select>
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="grade_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
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


<script src="<?= base_url('assets/admin/'); ?>vendor/flot/excanvas.min.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.pie.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.resize.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.time.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>