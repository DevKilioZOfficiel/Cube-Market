<section class="page-title grediant-overlay text-center" data-bg-img="<?= base_url('assets/'); ?>images/bg/01.jpg" data-overlay="6">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1>Paramètres du compte</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><?= $user['pseudo']; ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Crédit</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
                    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" /></script>
					<script type="text/javascript">
					$(document).ready(function() {

					
					
					$('#France').show();
					$('#Belgique').hide();
					$('#Canada').hide();
					$('#Suisse').hide();
					$('#International').hide(); // on cache le champ par défaut

					    $('select[name="country__code"]').change(function() { // lorsqu'on change de valeur dans la liste
					    var country__code = $(this).val(); // valeur sélectionnée

 					       if(country__code != '') { // si non vide
 					           if(country__code != '') { // si "jaune"
									if(country__code == 'France') {
  					                	$('#France').show();
  					                	$('#Belgique').hide();
  					                	$('#Canada').hide();
  					                	$('#Suisse').hide();
					                    $('#International').hide();
									}
									if(country__code == 'Belgique') {
  					                	$('#Belgique').show();
  					                	$('#France').hide();
  					                	$('#Canada').hide();
  					                	$('#Suisse').hide();
					                    $('#International').hide();
									}
									if(country__code == 'Canada') {
  					                	$('#Canada').show();
  					                	$('#France').hide();
  					                	$('#Belgique').hide();
  					                	$('#Suisse').hide();
					                    $('#International').hide();
									}
									
									if(country__code == 'Suisse') {
  					                	$('#Suisse').show();
  					                	$('#France').hide();
  					                	$('#Canada').hide();
  					                	$('#Belgique').hide();
					                    $('#International').hide();
									}
									
									if(country__code == 'International') {
  					                	$('#Suisse').hide();
  					                	$('#France').hide();
  					                	$('#Canada').hide();
  					                	$('#Belgique').hide();
					                    $('#International').show();
									}
									
  					          } else {
  					              $('#France').show();
								  $('#Belgique').hide();
  					              $('#Canada').hide();
  					              $('#Suisse').hide();
					              $('#International').hide();
     					       }
							}
  					  });

					});
					</script>


<!--page title end-->
<section class="contact-2">
  <div class="contact-box">
    <div class="container">
      <div class="row row-eq-height no-gutters box-shadow">
        <div class="col-lg-12 col-md-12">
				<div class="tab">
        		  <!-- Nav tabs -->
        		  <nav>
				    <?php 
					// AFFICHER PAR PAYS
					$query_paiement__country = $this->db->get('paiement__country');
					foreach ($query_paiement__country->result() as $row_paiement__country){ ?>
        		    <div class="nav nav-tabs" id="<?= $row_paiement__country->name; ?>" role="tablist">
					  <a class="nav-item nav-link active" id="nav-tab0" data-toggle="tab" href="#tab1-0" role="tab" aria-selected="true">Informations</a>
					<?php
					$this->db->where('country', $row_paiement__country->id);
					$query_paiement__category = $this->db->get('paiement__category');
					// AFFICHE PAR PAYS ET PAR CATEGORIE
					foreach ($query_paiement__category->result() as $row_paiement__category){  ?>
        		      <a class="nav-item nav-link" id="nav-tab-<?= $row_paiement__country->id; ?>-<?= $row_paiement__category->id; ?>" data-toggle="tab" href="#tab1-<?= $row_paiement__country->name; ?>-<?= $row_paiement__category->id; ?>" role="tab" aria-selected="false"><?= $row_paiement__category->name; ?></a>
				    <?php } ?>
        		    </div>
					<?php } ?>
        		  </nav>
        		  <!-- Tab panes -->
        		  <div class="tab-content" id="nav-tabContent">
        		    <div role="tabpanel" class="tab-pane fade show active" id="tab1-0">
					<?php
						$query_paiement__list = $this->db->get('paiement__list');
					    foreach ($query_paiement__list->result() as $row_paiement__list){ ?>
				      <?php
				      $code = isset($_POST['code__'.$row_paiement__list->id.'']) ? preg_replace('/[^a-zA-Z0-9]+/', '', $_POST['code__'.$row_paiement__list->id.'']) : '';
				      if( empty($code) ) {
				        //echo 'Vous devez saisir un code';
				      }
				      else {
				        $dedipass = file_get_contents('http://api.dedipass.com/v1/pay/?public_key=77ee63194e039db13caa9783c852e207&private_key=d4ee32eb13bb4329170c1c590b036795c65b25e4&code=' . $code);
 				       $dedipass = json_decode($dedipass);
				        if($dedipass->status == 'success') {
 				         // Le transaction est validée et payée.
				          // Vous pouvez utiliser la variable $virtual_currency
				          // pour créditer le nombre de Points.
				          $virtual_currency = $dedipass->virtual_currency;
						  
						  $data = array(
				              'user' => $user['id'],
				              'price' => $dedipass->virtual_currency,
				              'code' => $code,
							  'rate' => $dedipass->rate
				          );

				          $this->db->insert('paiement__mobile', $data);

						  $this->db->set('argent', $user['argent']+$dedipass->virtual_currency);
						  $this->db->where('id', $user['id']);
						  $this->db->update('user');

				          echo '<div class="alert alert-success">Le code est valide et vous êtes crédité de ' . $virtual_currency . '€</div>';
 				       }
 				       else {
 				         // Le code est invalide
  				        echo '<div class="alert alert-danger">Le code '.$code.' est invalide</div>';
  				      }
				      }
				      ?>
				    <?php } ?>
					<?php if(isset($_POST['transfert'])){
						if($this->input->post('argent') > $user['argent']){ ?>
							<div class="alert alert-danger">Vous venez de gagner le jackpot ! Vous êtes passé à <?= rand(1,99999); ?>€ sur votre compte !</div>
						<?php }else{
							$data = array(
							    'user' => $user['id'],
							    'solde' => $this->input->post('argent'),
							    'paypal' => $this->input->post('paypal'),
								'etat' => 'inwork'
							);
							$this->db->insert('paiement__transfert', $data);
							
							$this->db->set('argent', $user['argent']-$this->input->post('argent'));
							$this->db->where('id', $user['id']);
							$this->db->update('user');
						
						?>
						<div class="alert alert-success">Le transfert vient d'être envoyé ! L'équipe vous répondra sous peu.</div>
						<?php } ?>
					<?php } ?>
					
					<h3>Vous avez <?= $user['argent']; ?>€</h3>
					<p>Vous pouvez demander un transfert d'argent à partir de 20€ ! Ou même acheter un produit avec votre argent !</p>
					<?php if($user['argent'] >= 20){ ?>
					<form method="POST">
					<div class="row">
					    <div class="col-md-6">
						    <input type="email" name="paypal" placeholder="Votre email paypal (pour le transfert)" class="form-control">
						</div>
						<div class="col-md-6">
						    <input type="number" step="0.01" max="<?= $user['argent']; ?>" min="0.01" name="argent" placeholder="Argent à transférer" class="form-control">
						</div>
						<div class="col-md-12">
						    <button type="submit" name="transfert" class="btn btn-white btn-radius mt-4">Faire un transfert</button>
						</div>
					</div>
					
					</form>
					<?php } ?>
					<table class="table table-striped">
 					 <thead>
 					   <tr>
 					     <th scope="col">#</th>
 					     <th scope="col">Paypal</th>
 					     <th scope="col">Solde</th>
 					     <th scope="col">ID Paypal</th>
 					     <th scope="col">Etat</th>
 					     <th scope="col">Dernière modification</th>
 					   </tr>
  					</thead>
 					 <tbody>
					 <?php
					 $this->db->where('user', $user['id']);
					 $query = $this->db->get('paiement__transfert');

					 foreach ($query->result() as $row){ ?>
 					   <tr>
  					    <th scope="row">#<?= $row->id; ?></th>
 					     <td><?= $row->paypal; ?></td>
  					    <td><?= $row->solde; ?></td>
  					    <td><?= $row->paypal_id; ?></td>
  					    <td><?php if($row->etat == "inwork"){ ?>En cours<?php }elseif($row->etat == "cancel"){ ?>Annulé<?php }elseif($row->etat == "accepted"){ ?>Validé<?php } ?></td>
  					    <td><?= $row->edit; ?></td>
  					  </tr>
					 <?php } ?>
					 </tbody>
					</table>
					
					
					</div>
					<?php $query_paiement__country = $this->db->get('paiement__country');
					foreach ($query_paiement__country->result() as $row_paiement__country){ ?>
					<?php
					$query_paiement__category = $this->db->get('paiement__category');
					foreach ($query_paiement__category->result() as $row_paiement__category){ ?>
					<div role="tabpanel" class="tab-pane fade" id="tab1-<?= $row_paiement__country->name; ?>-<?= $row_paiement__category->id; ?>">
					  
        		        Méthode de paiement: <?= $row_paiement__category->name; ?>, Pays: <?= $row_paiement__country->name; ?>
						<div class="row">
						<?php 
						$this->db->where('category', $row_paiement__category->id);
					    $this->db->where('country', $row_paiement__country->id);
						$query_paiement__list = $this->db->get('paiement__list');
					    foreach ($query_paiement__list->result() as $row_paiement__list){ ?>
						<div class="col-lg-4 col-md-12" style="margin-bottom: 1.5rem!important;">
						   <form method="POST">
    					    <div class="price-table">
    					      <div class="price-header">
     					       <h4 class="price-title"><?= $row_paiement__category->name; ?></h4>
     					     </div>
     					     <div class="price-value">
     					       <h2>
     					         <span class="price-dollar"><?= $row_paiement__category->devise; ?></span><?= $row_paiement__list->price; ?><span></span>
     					       </h2>
     					     </div>
      					    <div class="price-list text-left">
      					      <ul class="list-unstyled">
      					        <li><i class="fas fa-clipboard-check"></i> Réception après paiement: <?= $row_paiement__list->reception; ?><?= $row_paiement__category->devise; ?></li>
      					        <li><i class="fas fa-clipboard-check"></i> Prix à payer: <?= $row_paiement__list->price; ?><?= $row_paiement__category->devise; ?></li>
								<?php if($row_paiement__list->link_api == "true"){ ?>
      					        <li><a href="<?= $row_paiement__list->url__api; ?>" target="_blank">Obtenir le code de validation</a></li>
						        <?php }else{ ?>
      					        <li><i class="fas fa-clipboard-check"></i> <?= $row_paiement__list->code; ?></li>
								<?php } ?>
								<input type="hidden" name="paiement_type__<?= $row_paiement__list->id; ?>" value="<?= $row_paiement__category->name; ?>">
       					       <li><input type="text" name="code__<?= $row_paiement__list->id; ?>" placeholder="Code reçu" class="form-control"></li>
       					     </ul>
      					    </div>
      					    <button class="btn btn-white btn-radius mt-4" type="submit" name="payement__<?= $row_paiement__list->id; ?>"> <span>Payer</span>
      					    </button>
						   </form>
     					   </div>
     					</div>
						<?php } ?>
						</div>
				    </div>
					<?php } ?>
					<?php } ?>
				  </div>
				  <div class="row">
				    <div class="col-md-8">
				    <select name="country__code" style="height: 50px;border-radius: 30px;font-size: 13px;color: #3f3f3e;background: #ffffff;border: none;box-shadow: none;border: 1px solid rgba(0,0,0,.125);border-radius: .25rem;">
					    <option value="France" selected>France</option>
						<option value="Belgique">Belgique</option>
						<option value="Canada">Canada</option>
						<option value="Suisse">Suisse</option>
						<option value="International">International (Paypal ect...)</option>
				    </select>
					</div>
					<div class="col-md-4">
					   <i>Propulsé par CubePay et Dedipass pour l'international</i>
					</div>
					</div>
				</div>
        </div>
      </div>
    </div>
</section>