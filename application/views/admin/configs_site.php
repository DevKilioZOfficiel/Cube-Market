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
$query3 = $this->db->get('config');						 
foreach ($query3->result() as $row3){ ?>
<?php if(isset($_POST['data_'.$row3->id.''])){ ?>
<?php if($this->input->post('value') != $row3->value){
	$this->db->set('value', $this->input->post('value'));
	$this->db->where('id', $row3->id);
	$this->db->update('config'); ?>
	<div class="alert alert-success">Le paramètre <?= $row3->name; ?> vient d'être modifié avec succès !</div>
<?php } ?>
<?php } ?>

<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Configuration du site</h5>
          </div>
          <div class="card-body">
            <table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Nom</th>
                  <th>Résultat</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('config');						 
				foreach ($query->result() as $row){ ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->name; ?></td>
                  <td><?= $row->value; ?></td>
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
$query2 = $this->db->get('config');						 
foreach ($query2->result() as $row2){ ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $row2->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $row2->id; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier la configuration <?= $row2->name; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
        <form method="POST">
		<div class="form-row">
          <div class="col-md-12">
            <input type="text" name="value" class="form-control" id="inputPassword2" placeholder="Nouveau résultat" value="<?= $row2->value; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="data_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
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