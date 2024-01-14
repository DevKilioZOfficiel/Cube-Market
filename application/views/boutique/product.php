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
				  $image = "https://cdn.discordapp.com/attachments/653672049826463744/690289237257748692/unknown.png";
			  }else{
				  $image = base_url('uploads/images/'.$product['image'].''); 
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
            <li class="breadcrumb-item"><a href="#"><?= $row_products__category->name; ?></a>
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
	    <?php if(isset($_POST['download'])){
			if (!$this->session->userdata('logged_in')) { ?>
		<div class="alert alert-danger">Vous devez être connecté pour télécharger ce produit !</div>
			<?php }else{
				$data__payement = array(
				    'id_product' => $product['id'],
				    'user' => $user['id'],
				    'price' => $product['price'],
					'type' => "PAYEMENT",
					'product__version' => $version_id
				);
				$this->db->insert('products__payements', $data__payement);
$filename = "uploads/produits/".$version__file."";
$file_zip_name = "CB-".$product['title'].".zip";
header('Content-disposition: attachment; filename='.$file_zip_name.'');
header('Content-type: application/zip');
readfile($filename);
		
		
		?>
		<div class="alert alert-success">Vous venez de télécharger le produit !</div>
		<?php } ?>
		<?php } ?>
		
		<?php $this->db->where('id_product',$product['id']);
				$this->db->order_by('id', 'DESC');
				$query__update_03 = $this->db->get('products__updates');
				foreach ($query__update_03->result() as $row__update_03){ ?>
		<?php if(isset($_POST['download__v'.$row__update_03->id.''])){
			if (!$this->session->userdata('logged_in')) { ?>
		<div class="alert alert-danger">Vous devez être connecté pour télécharger ce produit !</div>
		<?php }else{
			if($product['price'] == 0){
				
				$data__payement = array(
				    'id_product' => $product['id'],
				    'user' => $user['id'],
				    'price' => $product['price'],
					'type' => "DOWNLOAD__UPDATE",
					'product__version' => $row__update_03->version__id
				);
				$this->db->insert('products__payements', $data__payement);
		
		$filename = "uploads/produits/".$row__update_03->file."";
		$file_zip_name = "CB-".$product['title']."-".$row__update_03->version__id."-".$row__update_03->version__name.".zip";
		header('Content-disposition: attachment; filename='.$file_zip_name.'');
        header('Content-type: application/zip');
        readfile($filename);
		
		?>
		<div class="alert alert-success">Vous venez de télécharger la mise à jour du produit !</div>
		<?php }else{
			if($verify__payement__existe != 0){
				$data__payement = array(
				    'id_product' => $product['id'],
				    'user' => $user['id'],
				    'price' => $product['price'],
					'type' => "DOWNLOAD__UPDATE",
					'product__version' => $row__update_03->version__id
				);
				$this->db->insert('products__payements', $data__payement);
				$filename = "uploads/produits/".$row__update_03->file."";
		$file_zip_name = "CB-".$product['title']."-".$row__update_03->version__id."-".$row__update_03->version__name.".zip";
		header('Content-disposition: attachment; filename='.$file_zip_name.'');
        header('Content-type: application/zip');
        readfile($filename); ?>
		    <div class="alert alert-success">Vous venez de télécharger la mise à jour du produit !</div>	
		<?php }else{ ?>	
		<div class="alert alert-danger">Vous devez payer le produit avant de télécharger cette mise à jour !</div>
		<?php } ?>		
		<?php } ?>
		<?php } ?>
		<?php } ?>
		<?php } ?>
		
		
		<?php if(isset($_POST['paid'])){
			if (!$this->session->userdata('logged_in')) { ?>
		<div class="alert alert-danger">Vous devez être connecté pour acheter ce produit !</div>
			<?php }else{
			if($verify__payement__existe == 0){
			if($user['argent'] >= $product['price']){
				
				$this->db->set('argent', $user['argent']-$product['price']);
                $this->db->where('id', $user['id']);
                $this->db->update('user'); // déduction argent 
				
				$data__payement = array(
				    'id_product' => $product['id'],
				    'user' => $user['id'],
				    'price' => $product['price'],
					'type' => "PAYEMENT",
					'product__version' => $version_id
				);
				$this->db->insert('products__payements', $data__payement);
				
				$this->db->where('id',$product['user']);
				$query_user = $this->db->get('user');
				foreach ($query_user->result() as $row){
			    	$this->db->set('argent', $row->argent+$product['price']);
                    $this->db->where('id', $product['user']);
                    $this->db->update('user'); // ajout argent au vendeur
				}
		        $this->load->helper('download');
				
						$filename = "uploads/produits/".$version__file."";
		$file_zip_name = "CB-".$product['title'].".zip";
		header('Content-disposition: attachment; filename='.$file_zip_name.'');
        header('Content-type: application/zip');
        readfile($filename);
		
		?>
		<div class="alert alert-success">Vous venez d'acheter le produit !</div>
		<?php }else{ ?>
		<div class="alert alert-danger">Vous n'avez pas assez d'argent pour payer ce produit !</div>
		<?php } ?>
			<?php }else{ ?>
			<?php 
				$data__payement = array(
				    'id_product' => $product['id'],
				    'user' => $user['id'],
				    'price' => $product['price'],
					'type' => "DOWNLOAD__UPDATE",
					'product__version' => $version_id
				);
				$this->db->insert('products__payements', $data__payement);
				
$filename = "uploads/produits/".$version__file."";
$file_zip_name = "CB-".$product['title'].".zip";
header('Content-disposition: attachment; filename='.$file_zip_name.'');
header('Content-type: application/zip');
readfile($filename);
		
		?>
		<div class="alert alert-success">Vous venez d'acheter le produit !</div>
			<?php } ?>
		<?php } ?>
		<?php } ?>
        <div>
          <div class="service-images">
            <img class="img-fluid w-100" src="<?= $image; ?>" alt="">
          </div>
          <div class="service-details mt-4">
            <p><?= $product['description']; ?></p>
			<?php if($product['etat'] == 0){ ?>
            <blockquote>Ce produit n'est pas vérifié par notre équipe! Faites donc attention avant d'effectuer un paiement vers un produit non vérifié !</blockquote>
            <?php }else{ ?>
			
			<?php } ?>
		  </div>
        </div>
        <div class="tab mt-5 box-shadow">
          <!-- Nav tabs -->
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist"> <a class="nav-item nav-link active" id="nav-tab1" data-toggle="tab" href="#tab1-1" role="tab" aria-selected="true">Informations</a>
              <a class="nav-item nav-link" id="nav-tab2" data-toggle="tab" href="#tab1-2" role="tab" aria-selected="false"><?php if($product['price'] == 0){ ?>Télécharger<?php }else{ ?>Acheter<?php } ?></a>
            <a class="nav-item nav-link" id="nav-tab3" data-toggle="tab" href="#tab1-3" role="tab" aria-selected="false">Mises à jours (<?= $count__updates; ?>)</a>
            </div>
          </nav>
          <!-- Tab panes -->
          <div class="tab-content" id="nav-tabContent">
            <div role="tabpanel" class="tab-pane fade show active" id="tab1-1">
              <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                  <img alt="" src="<?= $image; ?>" class="img-fluid w-100">
                </div>
                <div class="col-lg-7 col-md-12 md-mt-5">
                  <p class="mb-5 lead">Toutes les informations sur le produit</p>
                  <ul class="list-unstyled list-icon">
                    <li class="mb-4"><i class="far fa-dot-circle"></i>  <span>Auteur: <?= $row_products__user->pseudo; ?></span></li>
                    <li class="mb-4"><i class="far fa-dot-circle"></i>  <span>Taille du fichier téléchargeable: <?= FileSizeConvert(filesize("uploads/produits/".$product['file']."")); ?></span></li>
                    <li class="mb-4"><i class="far fa-dot-circle"></i>  <span>Version actuelle: <?= $version_id; ?> <?= $version_name; ?></span></li>
                    <li class="mb-4"><i class="far fa-dot-circle"></i>  <span>Nombre de vente/téléchargement: <?= $count__payement; ?></span></li>
                    <li class="mb-4"><i class="far fa-dot-circle"></i>  <span>Dernière mise à jour: <?= $version_updated__date; ?></span></li>
					
					
                  </ul>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab1-2">
              <div class="row align-items-center">
                <div class="col-lg-7 col-md-12 md-mt-5">
                  <p class="mb-5 lead">
				  <?php if($product['etat'] != 0){ ?>
				  <?php if ($this->session->userdata('logged_in')) { ?>
				    <?php if($product['price'] == 0){ ?>
					<div class="row">
					<div class="col-lg-12 col-md-12">
					  <form method="POST">
					    <button type="submit" style="width:100%;" name="download" class="btn btn-sm btn-theme mb-2">Télécharger</button>
					  </form>
					</div>
				    </div>
					<?php }else{ ?>
					<div class="row">
					<?php if (file_exists("uploads/produits/".$version__file."")) {?>
					<div class="col-lg-6 col-md-12">
					  <form method="POST">
					    <button type="submit" name="paid" style="width:100%;" class="btn btn-sm btn-theme mb-2">Acheter avec votre solde (<?= $product['price']; ?>€)</button>
					  </form>
					</div>
					<div class="col-lg-6 col-md-12">
					  <a href="javascript:ouvre_popup('<?= base_url('products/paypal/'.$product['url'].''); ?>')" style="width:100%;background: #272867;" class="btn btn-sm btn-theme mb-2">Payer avec Paypal (<?= $product['price']; ?>€)</a>
					</div>
					<?php }else{ ?>
					<div class="col-lg-12 col-md-12">
					  <div class="alert alert-danger">Le fichier n'est plus disponible au téléchargement !</div>
					</div>
					<?php } ?>
					</div>
					<?php } ?>
				  <?php }else{ ?>
				    <a href="<?= base_url('connexion'); ?>" class="btn btn-sm btn-theme mb-2">Se connecter pour <?php if($product['price'] == 0){ ?>télécharger<?php }else{ ?>acheter<?php } ?> le produit</a> 
				  <?php } ?>
				  <?php }else{ ?><div class="alert alert-danger">Le produit n'est pas encore vérifié, il n'est donc pas possible de le télécharger/acheter.</div><?php } ?></p>
                  <ul class="list-unstyled list-icon">
                    <li class="mb-4"><i class="far fa-dot-circle"></i>  <span>Le prix du produit est de <?= $product['price']; ?>€ !</span>
                      Ce produit coûte <?= $product['price']; ?>€ ! <?php if($product['price'] != 0){ ?>
					  <?php $taxe = round($product['price']*6/100,2); ?>
					  <?php $anti_fraude = round($product['price']*1/100,2); ?>
					  
					  
					  <?php } ?></li>
                  </ul>
                </div>
				<div class="col-lg-5 col-md-12">
                  <img alt="" src="<?= $image; ?>" class="img-fluid w-100">
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab1-3">
              <div class="row align-items-center">
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
				    <?php if($product['price'] == 0){ ?>
					  <form method="POST">
					    <button type="submit" name="download__v<?= $row__update_02->id; ?>" class="btn btn-sm btn-theme mb-2">Télécharger</button>
					  </form>
					<?php }else{ ?>
					  <form method="POST">
					    <button type="submit" name="download__v<?= $row__update_02->id; ?>" class="btn btn-sm btn-theme mb-2">Télécharger</button>
					  </form>
					<?php } ?>
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
				    <?php if($product['price'] == 0){ ?>
					  <form method="POST">
					    <button type="submit" name="download__file" class="btn btn-sm btn-theme mb-2">Télécharger</button>
					  </form>
					<?php }else{ ?>
					  <form method="POST">
					    <button type="submit" name="paid" class="btn btn-sm btn-theme mb-2">Acheter (avec votre solde)</button>
					  </form>
					<?php } ?>
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
</div>

<!--service details end-->

		
						<?php } ?>
			<?php } ?>
<script type="text/javascript">
function ouvre_popup(page) {
 window.open(page,"Paypal Paiement","menubar=no, location=no, toolbar=no, status=no, scrollbars=no, menubar=no, width=626, height=336");
}
</script>