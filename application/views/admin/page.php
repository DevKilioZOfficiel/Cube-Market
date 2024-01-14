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
$this->db->order_by('id', 'DESC');
$query = $this->db->get('page');						 
foreach ($query->result() as $row){
   if(isset($_POST['p_'.$row->id.''])){
    $this->db->where('id', $this->input->post('pid'));
    $this->db->delete('page'); ?>
	<div class="alert alert-info">La page vient d'être supprimé !</div>
    <?php } ?>
<?php } ?>
<?php if(isset($_POST['submit__create'])){ ?>
<?php
$data = array(
        'name' => $this->input->post('nom'),
        'url' => $this->input->post('url')
);

$this->db->insert('page', $data);
?>

	<div class="alert alert-info">La page vient d'être créée !</div>
<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Pages</h5>
          </div>
          <div class="card-body">
		    <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Pages</a> </li>
              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#create" role="tab">Créer</a> </li>
            </ul>
			
			<div class="tab-content">
              <div class="tab-pane active" id="home" role="tabpanel">
			<table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Nom</th>
                  <th>url</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('page');						 
				foreach ($query->result() as $row){ ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->name; ?></td>
                  <td><?= $row->url; ?></td>
                  <td class="center">
				  <a style="display:inline;" href="<?= base_url('admin/page_edit/'.$row->url.''); ?>" class="btn btn-info">Modifier</a>
				  <form method="POST" style="display:inline;"><input type="hidden" value="<?= $row->id; ?>" name="pid"><button type="submit" name="p_<?= $row->id; ?>" class="btn btn-danger">Supprimer</button></form>
				  </td>
                </tr>
				<?php } ?>
			  </tbody>
			</table>
			  </div>
			  <div class="tab-pane" id="create" role="tabpanel">
			    
				<form method="POST">
		        <div class="form-row">
		            <div class="col-md-16">
		                <input type="text" name="nom" class="form-control" placeholder="Nom de la page">
		            </div>
		        </div>
		        <br>
		        <div class="form-row">
		            <div class="col-md-16">
		                <input type="text" name="url" class="form-control" placeholder="URL (ex faq)">
		            </div>
		        </div>
		        <br>
				<div class="form-row">
				<div class="col-md-16">
                    <button style="width:100%;" type="submit" name="submit__create" class="btn btn-primary mb-2">Créer</button>
		        </div>
				</div>
			</form>
				
			  </div>
              </div>
			
            
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>