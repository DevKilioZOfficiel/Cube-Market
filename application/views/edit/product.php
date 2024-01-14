<?php
			
			$this->db->where('id', $product['category']);
			$query_products__category = $this->db->get('products__category');
			foreach ($query_products__category->result() as $row_products__category){ ?>
			<?php
			$this->db->where('id', $product['user']);
			$query_products__user = $this->db->get('user');
			foreach ($query_products__user->result() as $row_products__user){ ?>
<?php function pseudo($commande,$pseudo) {
	    $commande = str_replace('{pseudo}', $pseudo, $commande);
        return $commande;
    } ?>	
<?php if($product['image'] == ""){
				  $image = "https://cdn.discordapp.com/attachments/480077879473078282/685527588827037774/unknown.png";
			  }else{
				  $image = $product['image']; 
			  }?>	
<!--page title start-->
<?php
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "To",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "Go",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "Mo",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "Ko",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "o",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

$this->db->where('id_product', $product['id']);
				$this->db->where('user', $user['id']);
			$this->db->from('products__payements');
			$verify__payement__existe = $this->db->count_all_results();
			
			$this->db->where('type', "PAYEMENT");
			$this->db->where('id_product', $product['id']);
			$this->db->from('products__payements');
			$count__payement = $this->db->count_all_results();
			
			$this->db->where('id_product', $product['id']);
			$this->db->from('products__updates');
			$count__updates = $this->db->count_all_results();
			
			if($count__updates == 0){
				$version_name = "";
				$version_id = "1.0.0";
				$version_updated = "Mise en place du produit dans la boutique CubeMarket.";
				$version_updated__date = $product['date'];
				$version__file = $product['file'];
			}else{
				$this->db->where('id_product',$product['id']);
				$this->db->order_by('id', 'DESC');
				$this->db->limit(1);
				$query__update = $this->db->get('products__updates');
				foreach ($query__update->result() as $row__update){
			    	$version_name = "(".$row__update->version__name.")";
			     	$version_id = $row__update->version__id;
			    	$version_updated = $row__update->version__updated;
					$version_updated__date = $row__update->date;
					$version__file = $row__update->file;
				}
			}
?>


<section class="page-title grediant-overlay text-center" data-bg-img="<?= $image; ?>" data-overlay="6">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1><?= $product['title']; ?></h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('products'); ?>">Produit</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Modification</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?= $product['title']; ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>

<!--page title end-->


<!--body content start-->

<div class="page-content">

<!--service details start-->

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
	    <?php $this->db->where('id_product',$product['id']);
				$this->db->order_by('id', 'DESC');
				$query__update_03 = $this->db->get('products__updates');
				foreach ($query__update_03->result() as $row__update_03){ ?>
		<?php if(isset($_POST['download__v'.$row__update_03->id.''])){
		$this->load->helper('download');
	    force_download('uploads/produits/'.$row__update_03->file.'', NULL);
		
		?>
		<div class="alert alert-success">Vous venez de télécharger la mise à jour du produit !</div>
		<?php } ?>
		<?php } ?>
		
		
		<?php if(isset($_POST['download'])){
		    $this->load->helper('download');
	        force_download('uploads/produits/'.$version__file.'', NULL); ?>
		    <div class="alert alert-success">Vous venez de télécharger le produit !</div>
	    <?php } ?>
		
		<?php if(isset($_POST['edit__product'])){
			$this->db->set('title', $this->input->post('title'));
			$this->db->set('description', $this->input->post('description'));
			$this->db->set('price', $this->input->post('price'));
			$this->db->set('category', $this->input->post('category'));
			$this->db->where('id', $product['id']);
			$this->db->update('products__list');
		?>
		<div class="alert alert-success">Modification du produit avec succès !</div>	
		<?php } ?>
		
		
		<?php if(isset($_POST['add__update'])){ ?>
			 <?php $product02 = $this->product_model->product();
			
			if($product02['type'] == "success"){
			    $data = array(
			        'user' => $user['id'],
			        'id_product' => $product['id'],
			        'file' => $product02['file'],
			        'version__name' => $this->input->post('version__name'),
			        'version__id' => $this->input->post('version__id'),
			        'version__updated' => $this->input->post('version__updated')
			    );
			    $this->db->insert('products__updates', $data);
				echo '<div class="col-md-12"><div class="alert alert-success">La mise à jour vient d\'être mise en ligne</div></div>';
			}else{
				echo '<div class="col-md-12"><div class="alert alert-danger">Une erreur est survenue ! Il se peut que votre produit soit vide ou l\'extension du fichier incorrecte ou encore la taille du fichier.</div></div>';
			} ?>
				<?php } ?>
				<?php if(isset($_POST['edit__image'])){
			        $image02 = $this->product_model->image();
			       	if($image02['type'] == "success"){
			            $this->db->set('image', $image02['file']);
			            $this->db->where('id', $product['id']);
			            $this->db->update('products__list');
			        	echo '<div class="col-md-12"><div class="alert alert-success">L\'image vient d\'être publié</div></div>';
			        }else{
			        	echo '<div class="col-md-12"><div class="alert alert-danger">Une erreur est survenue ! Il se peut que votre produit soit vide ou l\'extension du fichier incorrecte ou encore la taille du fichier.</div></div>';
			        }
				} ?>
	  
	  

        <div class="tab mt-5 box-shadow">
          <!-- Nav tabs -->
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-tab1" data-toggle="tab" href="#tab1-1" role="tab" aria-selected="true">Informations</a>
			<a class="nav-item nav-link" id="nav-tab2" data-toggle="tab" href="#tab1-3" role="tab" aria-selected="false">Bannière du produit</a>
            <a class="nav-item nav-link" id="nav-tab3" data-toggle="tab" href="#tab1-2" role="tab" aria-selected="false">Mises à jours (<?= $count__updates; ?>)</a>
            </div>
          </nav>
          <!-- Tab panes -->
          <div class="tab-content" id="nav-tabContent">
            <div role="tabpanel" class="tab-pane fade show active" id="tab1-1">
              <div class="row align-items-center">
                <div class="col-lg-12 col-md-12">
                         <form method="POST">
		
					        <div class="row">
					            <div class="form-group col-md-6">
					              <input type="text" name="title" class="form-control" value="<?= $product['title']; ?>" placeholder="Titre de votre produit" required>
					            </div>
					            <div class="form-group col-md-6">
								  <select name="category" style="height: 50px;border-radius: 30px;font-size: 13px;color: #3f3f3e;background: #ffffff;border: none;box-shadow: none;border: 1px solid rgba(0,0,0,.125);border-radius: .25rem;">
								    <?php $query = $this->db->get('products__category');
									foreach ($query->result() as $row){ ?>
									<option value="<?= $row->id; ?>" <?php if($product['category'] == $row->id){ ?>selected<?php } ?>><?= $row->name; ?></option>
									<?php } ?>
								  </select>
					            </div>
					            <div class="form-group col-md-12">
					              <input type="number" name="price" step="0.01" class="form-control" placeholder="Prix du produit (0 pour Gratuit)" value="<?= $product['price']; ?>" required>
					            </div>
					            <div class="col-md-12">
								
								  <label>Description du produit</label>
				    	          <textarea name="description" id="summernote" class="form-control"><?= $product['description']; ?></textarea>
				    	        </div>
				    			<div class="row mt-5">
				    	          <div class="col-md-12">
				    	            <button type="submit" name="edit__product" class="btn btn-sm btn-theme mb-2">Modifier le produit</button>
				    	          </div>
				    			</div>
				    	    </div>
		    
				    	  </form>
                </div>
              </div>
            </div>
			<div role="tabpanel" class="tab-pane fade" id="tab1-3">
			    <form method="POST" enctype="multipart/form-data">
		
					        <div class="row">
								<div class="form-group col-md-6">
								  <label>Image du produit (png/jpeg)</label>
					              <input type="file" name="image" class="form-control" placeholder="Fichier" required>
					            </div>
				    			<div class="row mt-5">
				    	          <div class="col-md-12">
				    	            <button type="submit" name="edit__image" class="btn btn-sm btn-theme mb-2">Modifier l'image</button>
				    	          </div>
				    			</div>
				    	    </div>
		    
				</form>
			</div>
			
            <div role="tabpanel" class="tab-pane fade" id="tab1-2">
              <div class="row align-items-center">
			  <form method="POST" enctype="multipart/form-data">
		
					        <div class="row">
					            <div class="form-group col-md-6">
					              <input type="text" name="version__name" class="form-control" placeholder="Nom de la version" required>
					            </div>
					            <div class="form-group col-md-12">
					              <input type="text" name="version__id" class="form-control" placeholder="Version (ex: 1.0.1)" required>
					            </div>
								<div class="form-group col-md-6">
								  <label>Fichier du produit</label>
					              <input type="file" name="product" class="form-control" placeholder="Fichier du produit" required>
					            </div>
					            <div class="col-md-12">
								
								  <label>Description de la mise à jour</label>
				    	          <textarea name="version__updated" id="summernote2" class="form-control"></textarea>
				    	        </div>
				    			<div class="row mt-5">
				    	          <div class="col-md-12">
				    	            <button type="submit" name="add__update" class="btn btn-sm btn-theme mb-2">Ajouter la mise à jour</button>
				    	          </div>
				    			</div>
				    	    </div>
		    
				    	  </form>
                <div id="accordion" class="accordion style-1 col-md-12">
				
				<?php $this->db->where('id_product',$product['id']);
				$this->db->order_by('id', 'DESC');
				$query__update_02 = $this->db->get('products__updates');
				foreach ($query__update_02->result() as $row__update_02){ ?>
				
				<?php 
				$this->db->where('id_product', $product['id']);
				$this->db->where('product__version', $row__update_02->version__id);
			    $this->db->from('products__payements');
			    $count__version__downloaded = $this->db->count_all_results(); ?>
                <div class="card">
                  <div class="card-header">
                    <h6 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?= $row__update_02->id; ?>" aria-expanded="false" class="collapsed"><span></span><?= $row__update_02->version__id; ?> <i><?= $row__update_02->version__name; ?></i></a>
                    </h6>
                  </div>
                  <div id="collapse_<?= $row__update_02->id; ?>" class="collapse" data-parent="#accordion" style="">
                    <div class="card-body">
					    <?= $row__update_02->version__updated; ?>
						<hr>
						Il y a <?= $count__version__downloaded; ?> téléchargements.
						<?php if (file_exists("uploads/produits/".$row__update_02->file."")) {?>
						Le fichier pèse <?= FileSizeConvert(filesize("uploads/produits/".$row__update_02->file."")); ?>
						<?php }else{ ?>
						Le fichier n'existe plus. Contactez l'administrateur pour en savoir plus
						<?php } ?>
						<hr>
						<?php if (file_exists("uploads/produits/".$row__update_02->file."")) {?>
					  <form method="POST">
					    <button type="submit" name="download__v<?= $row__update_02->id; ?>" class="btn btn-sm btn-theme mb-2">Télécharger</button>
					  </form>
						<?php } ?>
					</div>
                  </div>
                </div>
				<?php } ?>
				<?php 
				$this->db->where('id_product', $product['id']);
				$this->db->where('product__version', '1.0.0');
			    $this->db->from('products__payements');
			    $count__version__downloaded100 = $this->db->count_all_results(); ?>
				<div class="card">
                  <div class="card-header">
                    <h6 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="false" class="collapsed"><span></span>1.0.0 (Lancement)</a>
                    </h6>
                  </div>
                  <div id="collapse0" class="collapse" data-parent="#accordion" style="">
                    <div class="card-body">
					    Mise en place du produit dans la boutique CubeMarket.
						<hr>
						Il y a <?= $count__version__downloaded100; ?> téléchargements
						<hr>
					<?php if($count__updates == 0){ ?>
				      <form method="POST">
					    <button type="submit" name="download__file" class="btn btn-sm btn-theme mb-2">Télécharger</button>
					  </form>
					<?php }else{ ?>
					    <i>Cette mise à jour n'est plus téléchargeable</i>
					<?php } ?>
					</div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--service details end-->

		
						<?php } ?>
			<?php } ?>