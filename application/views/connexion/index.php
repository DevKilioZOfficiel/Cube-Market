<!--page title start-->

<section class="page-title grediant-overlay text-center" data-bg-img="<?= base_url('assets/'); ?>images/bg/01.jpg" data-overlay="6">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1>Connexion</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Authentification</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Connexion</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>

<!--page title end-->
    <?php $server_name = $this->permissions_model->get_config('server_name'); ?>
<section class="contact-2">
  <div class="contact-box">
    <div class="container">
      <div class="row row-eq-height no-gutters box-shadow">
	  <?php if(!empty(@$notif_l)){ ?>
					<?php if(@$notif_l['type'] == "success"){ ?>
					    <?php redirect(''); exit(); ?>
					<?php } ?>
					<div class="col-lg-12 col-md-12"
            		    <div id="login-alert" class="alert alert-<?php echo @$notif_l['type'];?> col-sm-12"><?php echo @$notif_l['message'];?></div>
					</div>
            	    <?php } ?>
        <div class="col-lg-12 col-md-12">
          <div class="contact-main dark-bg">
            <h2 class="title mb-3">Connexion à <span><?= $server_name['value']; ?></span></h2> 
            <form class="row" method="post">
              <div class="form-group col-sm-12">
                <input id="form_name" type="text" name="pseudo" class="form-control" placeholder="Votre pseudo" required="required" data-error="Le pseudo est requis.">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group col-sm-12">
                <input id="form_phone" type="password" name="pass1" class="form-control" placeholder="Mot de passe" required="required" data-error="Mot de passe requis">
                <div class="help-block with-errors"></div>
              </div>
              <div class="col-sm-12">
                <button type="submit" name="connexion" class="btn btn-border btn-radius"><span>Connexion</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>