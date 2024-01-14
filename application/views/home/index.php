    <?php $server_name = $this->permissions_model->get_config('server_name'); ?>
	
<section class="banner p-0 o-hidden dark-bg">
  <div class="bnr-animation"></div>
  <div class="main-slider owl-carousel owl-theme no-pb z-index-1" data-items="1" data-dots="false" data-autoplay="true">
    <?php $query_slider = $this->db->query("SELECT * FROM slider ORDER by id ASC"); ?>
    <?php foreach ($query_slider->result() as $row_slider){ ?>
	<div class="item grediant-overlay" data-bg-img="<?= $row_slider->image; ?>" data-overlay="5">
      <div class="align-center pt-0">
        <div class="container">
          <div class="row text-center">
            <div class="col-lg-10 col-md-12 ml-auto mr-auto">
              <h2 class="text-white letter-space-1 wow fadeInDown mb-2" data-wow-duration="0.7s" data-wow-delay="1s"><?= $row_slider->title; ?></h2>
              <h5 class="mb-4 text-white wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="2s"><?= $row_slider->description; ?></h5>
              
			  <?php if(!empty($row_slider->button_text1) && !empty($row_slider->button_url1)){ ?>
				<a class="btn btn-theme btn-border btn-circle" href="<?= $row_slider->button_url1; ?>" role="button"><?= $row_slider->button_text1; ?></a>
			  <?php } ?>
			  <?php if(!empty($row_slider->button_text2) && !empty($row_slider->button_url2)){ ?>
				<a class="btn btn-white btn-circle popup-youtube xs-mt-1" href="<?= $row_slider->button_url2; ?>" ya-lightbox role="button"><?= $row_slider->button_text2; ?></a>
			  <?php } ?>
			  
			  </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</section>	
<section class="grey-bg blog-main" data-bg-img="<?= base_url('assets/'); ?>images/pattern/01.png">
  <div class="container">
    <div class="row">
	    <div class="col-md-12">
	    <h3>Voici quelque produits sur CubeMarket</h3>
		</div>
		  <?php 
			$this->db->where('etat', 1);
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(12);
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
				  $image = "https://cdn.discordapp.com/attachments/653672049826463744/690289237257748692/unknown.png";
			  }else{
				  $image = base_url('uploads/images/'.$row_products->image.''); 
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