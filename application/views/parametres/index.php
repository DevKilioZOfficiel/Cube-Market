<?php
$this->db->where('user', $user['id']);
$this->db->from('products__list');
$count__posts__products = $this->db->count_all_results();
?>

<section class="page-title grediant-overlay text-center" data-bg-img="<?= base_url('assets/'); ?>images/bg/01.jpg" data-overlay="6">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1>Paramètres du compte</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><?= $user['pseudo']; ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>

<!--page title end-->
<section class="contact-2">
  <div class="contact-box">
    <div class="container">
      <div class="row">
			<?php if(isset($_POST['submit_pwd'])){ ?>
				<?php if(!empty($this->input->post('pwd1'))){ ?>
				<?php 
				$this->db->where('password', sha1($this->input->post('pwd1')));
				$this->db->where('id', $user['id']);
				$this->db->from('user');
				$verify = $this->db->count_all_results();
				if($verify == 1){
					if(sha1($this->input->post('pwd2')) && sha1($this->input->post('pwd3'))){
						$this->db->set('password', sha1($this->input->post('pwd3')));
						$this->db->where('id', $user['id']);
						$this->db->update('user'); ?>
						<div class="col-md-12"><div class="alert alert-success">Succès ! Le mot de passe vient d'être mis à jour !</div></div>
						<?php 
					}else{ ?>
						<div class="col-md-12"><div class="alert alert-danger">Les mots de passes ne correspondent pas. Veuillez corriger cela.</div></div>
					<?php }
			 	}else{ ?>
                <div class="col-md-12">
				<div class="alert alert-danger">Le mot de passe actuel est incorrecte.</div>
				</div>
				<?php } ?>
				<?php }else{ ?>
				<div class="col-md-12">
				<div class="alert alert-danger">Le mot de passe actuel est vide. Veuillez le remplir.</div>
				</div>
				<?php } ?>
				<?php } ?>
				
				<?php if(isset($_POST['submit_paypal'])){ ?>
				<?php if(!empty($this->input->post('paypal__client'))){
						$this->db->set('paypal__client', $this->input->post('paypal__client'));
						$this->db->set('paypal__secret', $this->input->post('paypal__secret'));
						$this->db->where('id', $user['id']);
						$this->db->update('user'); ?>
					<div class="col-md-12">
						<div class="alert alert-success">Succès ! L'API paypal vient d'être mise à jour !</div>
					</div>
						
				<?php }else{ ?>
				<div class="col-md-12">
				<div class="alert alert-danger">La clé Paypal est vide. Veuillez la remplir.</div>
				</div>
				<?php } ?>
				<?php } ?>
				
				<?php if(isset($_POST['create__product'])){ ?>
				<?php if($permission['quota__limit'] != $count__posts__products){ ?>
			 <?php $product = $this->product_model->product();
			
			if($product['type'] == "success"){
			    $count = $this->db->count_all_results('products__list')+1;
			    $data = array(
			        'user' => $user['id'],
			        'category' => $this->input->post('category'),
			        'title' => $this->input->post('title__product'),
			        'url' => url_title($this->input->post('title__product')).'-'.$count.'',
			        'description' => $this->input->post('description'),
			        'file' => $product['file'],
			        'price' => $this->input->post('price')
			    );
			    $this->db->insert('products__list', $data);
				echo '<div class="col-md-12"><div class="alert alert-success">Le produit vient d\'être publié</div></div>';
			}else{
				echo '<div class="col-md-12"><div class="alert alert-danger">Une erreur est survenue ! Il se peut que votre produit soit vide ou l\'extension du fichier incorrecte ou encore la taille du fichier.</div></div>';
			} ?>
		        <?php }else{ ?>
				<div class="col-md-12">
				    <div class="alert alert-danger">Une erreur est survenue ! Vous n'avez plus d'espace pour vendre des produits.</div>
				</div>
				<?php } ?>
				<?php } ?>
        <div class="col-lg-12 col-md-12">
		
				
				<div class="tab">
        		  <!-- Nav tabs -->
        		  <nav>
        		    <div class="nav nav-tabs" id="nav-tab" role="tablist">
					  <a class="nav-item nav-link active" id="nav-tab1" data-toggle="tab" href="#tab1-1" role="tab" aria-selected="true">Paramètres généraux</a>
        		      <a class="nav-item nav-link" id="nav-tab2" data-toggle="tab" href="#tab1-2" role="tab" aria-selected="false">Paramètres avancés</a>
					  <a class="nav-item nav-link" id="nav-tab3" data-toggle="tab" href="#tab1-3" role="tab" aria-selected="false">Mes produits</a>
        		    </div>
        		  </nav>
        		  <!-- Tab panes -->
        		  <div class="tab-content" id="nav-tabContent">
        		    <div role="tabpanel" class="tab-pane fade show active" id="tab1-1">
				    <div class="card">
		             <div class="card-body">
					  
				  
			           <form method="post" novalidate="true">
					  
                         <h5 class="font-weight-bold font-size-md text-uppercase mb-4 pb-1">Modifier le mot de passe</h5>
                         <div class="row">
                           <div class="form-group col-md-12">
                             <input id="form_name" type="password" name="pwd1" class="form-control" placeholder="Mot de passe actuel">
                           </div>
                           <div class="form-group col-md-6">
                             <input id="form_email" type="password" name="pwd3" class="form-control" placeholder="Nouveau mot de passe">
                           </div>
                           <div class="form-group col-md-6">
                             <input id="form_subject" type="password" name="pwd3" class="form-control" placeholder="Confirmation">
                           </div>
                         </div>
                         <div class="row mt-5">
                           <div class="col-md-12">
                             <button type="submit" name="submit_pwd" class="btn btn-sm btn-theme mb-2">Changer le mot de passe</button>
                           </div>
                         </div>
                       </form>
					  
					 </div>
					</div>
					
					</div>
					
					<div role="tabpanel" class="tab-pane fade" id="tab1-2">
					    <form method="post" novalidate="true">
					  
                         <h5 class="font-weight-bold font-size-md text-uppercase mb-4 pb-1">Modifier le paiement Paypal</h5>
                         <div class="row">
                           <div class="form-group col-md-6">
                             <input id="form_name" type="text" name="paypal__client" class="form-control" placeholder="Clé Paypal" value="<?= $user['paypal__client']; ?>">
							 <p>Comment obtenir la clé ?</p>
                           </div>
						   <div class="form-group col-md-6">
                             <input id="form_name" type="text" name="paypal__secret" class="form-control" placeholder="Secret Paypal" value="<?= $user['paypal__secret']; ?>">
							 <p>Comment obtenir la clé secrète ?</p>
                           </div>
                         </div>
                         <div class="row mt-5">
                           <div class="col-md-12">
                             <button type="submit" name="submit_paypal" class="btn btn-sm btn-theme mb-2">Changer</button>
                           </div>
                         </div>
                       </form>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab1-3">
					  <nav>
        		        <div class="nav nav-tabs" id="nav-tab" role="tablist"> 
					      <a class="nav-item nav-link active" id="nav-tab2-1" data-toggle="tab" href="#tab2-1" role="tab" aria-selected="true">Mes produits</a>
						  <?php if($count__posts__products != $permission['quota__limit']){ ?>
					      <a class="nav-item nav-link" id="nav-tab2-2" data-toggle="tab" href="#tab2-2" role="tab" aria-selected="false">Nouveau</a>
						  <?php } ?>
        		        </div>
        		      </nav>
					
					
				      <div class="tab-content" id="nav-tabContent">
        		        <div role="tabpanel" class="tab-pane fade show active" id="tab2-1">
					       <table class="table table-striped">
					         <thead>
					           <tr>
					             <th scope="col">#</th>
					             <th scope="col">Nom du produit</th>
					             <th scope="col">Etat</th>
					             <th scope="col">Actions</th>
					           </tr>
					         </thead>
					         <tbody>
							 <?php 
							 $this->db->where('user', $user['id']);
							 $query_products = $this->db->get('products__list');
							 foreach ($query_products->result() as $row_products){ ?>
					           <tr>
					             <th scope="row"><?= $row_products->id; ?></th>
					             <td><?= $row_products->title; ?></td>
					             <td><?php if($row_products->etat == 0){ ?>En attente<?php }else{ ?>En ligne<?php } ?></td>
					             <td><a href="<?= base_url('edit/product/'.$row_products->url.''); ?>">Modifier</a></td>
					           </tr>
							 <?php } ?>
							 </tbody>
						   </table>
					    </div>
					    <div role="tabpanel" class="tab-pane fade" id="tab2-2">
						<?php if($count__posts__products != $permission['quota__limit']){ ?>
					      <form method="POST" enctype="multipart/form-data">
		
					        <div class="row">
					            <div class="form-group col-md-12">
					              <input type="text" name="title__product" class="form-control" placeholder="Titre de votre produit" required>
					            </div>
					            <div class="form-group col-md-6">
								  <label>Catégorie du produit</label>
								  <select name="category" style="height: 50px;border-radius: 30px;font-size: 13px;color: #3f3f3e;background: #ffffff;border: none;box-shadow: none;border: 1px solid rgba(0,0,0,.125);border-radius: .25rem;">
								    <?php $query = $this->db->get('products__category');
									foreach ($query->result() as $row){ ?>
									<option value="<?= $row->id; ?>"><?= $row->name; ?></option>
									<?php } ?>
								  </select>
					            </div>
					            <div class="form-group col-md-6">
								  <label>Fichier du produit</label>
					              <input type="file" name="product" class="form-control" placeholder="Fichier du produit" required>
					            </div>
					            <div class="form-group col-md-12">
					              <input type="number" name="price" step="0.01" class="form-control" placeholder="Prix du produit (0 pour Gratuit)" required>
					            </div>
					            <div class="col-md-12">
								
								  <label>Description du produit</label>
				    	          <textarea name="description" id="summernote" class="form-control"></textarea>
				    	        </div>
				    			<div class="row mt-5">
				    	          <div class="col-md-12">
				    	            <button type="submit" name="create__product" class="btn btn-sm btn-theme mb-2">Créer le produit</button>
				    	          </div>
				    			</div>
				    	    </div>
		    
				    	  </form>
						  <?php } ?>
					
				    	</div>
				      </div>
				    </div>
				  </div>
				</div>
        </div>
      </div>
    </div>
</section>