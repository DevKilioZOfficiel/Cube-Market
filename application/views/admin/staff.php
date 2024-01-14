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
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Staff</h5>
          </div>
          <div class="card-body">
            <table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Pseudo</th>
                  <th>Grade</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('user');						 
				foreach ($query->result() as $row){ ?>
				<?php $perm_row = $this->permissions_model->get_permissions($row->grade); ?>
				<?php if($perm_row['is_admin'] == 1){ ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->pseudo; ?></td>
                  <td><?= $perm_row['nom']; ?></td>
                </tr>
				<?php } ?>
				<?php } ?>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>


<script src="<?= base_url('assets/admin/'); ?>vendor/flot/excanvas.min.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.pie.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.resize.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.time.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>