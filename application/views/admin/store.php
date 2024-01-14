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
$query = $this->db->get('products__list');						 
foreach ($query->result() as $row){
   if(isset($_POST['p_'.$row->id.''])){
    $this->db->where('id', $this->input->post('pid'));
    $this->db->delete('products__list'); ?>
	<div class="alert alert-info">Le produit vient d'être supprimé !</div>
    <?php } ?>
<?php } ?>


<?php
$this->db->order_by('id', 'DESC');
$query = $this->db->get('products__category');						 
foreach ($query->result() as $row){
   if(isset($_POST['c_'.$row->id.''])){
    $this->db->where('id', $this->input->post('cid'));
    $this->db->delete('products__category'); ?>
	<div class="alert alert-info">La catégorie vient d'être supprimé !</div>
    <?php } ?>
<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Boutique</h5>
          </div>
          <div class="card-body">
		    <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Produits</a> </li>
              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#categories" role="tab">Catégories</a> </li>
            </ul>
			
			<div class="tab-content">
              <div class="tab-pane active" id="home" role="tabpanel">
			<table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Nom</th>
                  <th>Catégorie</th>
                  <th>Joueur</th>
                  <th>Etat</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('products__list');						 
				foreach ($query->result() as $row){ ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->title; ?></td>
				<?php
				if($row->category == 0){ ?>
					<td>Accueil</td>
				<?php }else{
				$this->db->where('id', $row->category);
				$query_category = $this->db->get('products__category');						 
				foreach ($query_category->result() as $row_category){ ?>
                  <td><?= $row_category->name; ?></td>
				<?php } ?>
				<?php } ?>
                <?php
				$this->db->where('id', $row->user);
				$query_user = $this->db->get('user');						 
				foreach ($query_user->result() as $row_user){ ?>
                  <td><?= $row_user->pseudo; ?></td>
				<?php } ?>
				  <td><?php if($row->etat == 0){ ?>En attente<?php }else{ ?>Publié<?php } ?></td>
                  <td class="center">
				  <a style="display:inline;" href="<?= base_url('admin/product/'.$row->url.''); ?>" class="btn btn-info">Modifier</a>
				  <form method="POST" style="display:inline;"><input type="hidden" value="<?= $row->id; ?>" name="pid"><button type="submit" name="p_<?= $row->id; ?>" class="btn btn-danger">Supprimer</button></form>
				  </td>
                </tr>
				<?php } ?>
			  </tbody>
			</table>
			  </div>
              <div class="tab-pane" id="categories" role="tabpanel">
			<table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Nom</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('products__category');						 
				foreach ($query->result() as $row){ ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->name; ?></td>
				  <td>
				  <form method="POST" style="display:inline;"><input type="hidden" value="<?= $row->id; ?>" name="cid"><button type="submit" name="c_<?= $row->id; ?>" class="btn btn-danger">Supprimer</button></form>
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
  </div>
</div>