<section class="page-title grediant-overlay text-center" data-bg-img="images/bg/01.jpg" data-overlay="6">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1>Produits</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('products'); ?>">Produits</a>
            </li>
			<?php if(isset($_GET['product'])){ ?>
            <li class="breadcrumb-item"><a href="<?= base_url('products'); ?>">Recherche</a>
			<li class="breadcrumb-item active" aria-current="page"><?= $this->input->get('product'); ?></li>
		  <?php }else{ ?>
            <li class="breadcrumb-item active" aria-current="page">Recherche</li>
		  <?php } ?>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>

<!--page title end-->


<!--body content start-->

<div class="page-content">

<section class="grey-bg blog-main" data-bg-img="<?= base_url('assets/'); ?>images/pattern/01.png">
  <div class="container">
    <div class="row">
		  <?php 
		  if(isset($_GET['product'])){
			$this->db->like('title', $this->input->get('product'));
		  }
			$this->db->where('etat', 1);
			$query_products = $this->db->get('products__list');
			foreach ($query_products->result() as $row_products){ ?>
			<?php
			
			$this->db->where('id', $row_products->category);
			$query_products__category = $this->db->get('products__category');
			foreach ($query_products__category->result() as $row_products__category){ ?>
			<?php
			$this->db->where('id', $row_products->user);
			$query_products__user = $this->db->get('user');
			foreach ($query_products__user->result() as $row_products__user){ ?>
            <div class="col-lg-4 col-md-6" style="margin-bottom: 1.5rem!important;">
              <div class="post style-2">
			  <?php if($row_products->image == ""){
				  $image = "https://cdn.discordapp.com/attachments/480077879473078282/685527588827037774/unknown.png";
			  }else{
				  $image = "".base_url('uploads/images/'.$row_products->image.''); 
			  }?>
                <div style="background: url('<?= $image; ?>');
    width: 100%!important;
    height: 200px!important;
    max-width: 100%;
    max-height: 100%;
    background-repeat: no-repeat;
    background-position: center;
}">			   
                <div style="padding: 0 2px 0 20px;
    text-align: center;
    background: #3735b8;
    display: inline-block;
    font-weight: bold;
    text-transform: uppercase;
    color: #ffffff;
    font-size: 16px;">
                 <?= $row_products__category->name; ?>
                </div>
                </div>
                <div class="post-desc">				
                <div class="post-title">
                  <h5><?= $row_products->title; ?></h5>
                </div>
                <p><?php if($row_products->price == 0){ ?>Le produit est <b>gratuit</b> !<?php }else{ ?>Le produit coûte <b><?= $row_products->price; ?>€</b><?php } ?></p>
                <div class="post-meta">
                  <ul class="list-inline">
                    <li><i class="flaticon-profile mr-2"></i> <?= $row_products__user->pseudo; ?></li>
                    <a href="<?= base_url('products/p/'.$row_products->url.''); ?>"><li><i class="flaticon-chat-1 mr-2"></i> Voir le produit</li></a>
                  </ul>
                </div>
                </div>
               </div>
              
            </div>
			<?php } ?>
			<?php } ?>
			<?php } ?>
			
			
    </div>
  </div>
</section>
</div>