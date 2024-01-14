<!--page title start-->

<section class="page-title grediant-overlay text-center" data-bg-img="<?= base_url('assets/'); ?>images/bg/01.jpg" data-overlay="6">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1>Inscription</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Authentification</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Inscription</li>
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
	  <?php if(!empty(@$notif_r)){ ?>
	    <div class="col-lg-12 col-md-12">
            <div id="login-alert" class="alert alert-<?php echo @$notif_r['type'];?> col-sm-12"><?php echo @$notif_r['message'];?></div>
		</div>
        <?php } ?>
        <div class="col-lg-12 col-md-12">
          <div class="contact-main dark-bg">
            <h2 class="title mb-3">Inscription à <span><?= $server_name['value']; ?></span></h2> 
            <form class="row" method="post">
              <div class="form-group col-sm-6">
                <input id="form_name" type="text" name="pseudo" class="form-control" placeholder="Votre pseudo" required="required" data-error="Le pseudo est requis pour votre inscription.">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group col-sm-6">
                <input id="form_email" type="email" name="email" class="form-control" placeholder="Email" required="required" data-error="Email requise.">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group col-sm-6">
                <input id="form_phone" type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" data-error="Mot de passe requis">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group col-sm-6">
                <input id="form_subject" type="password" name="repeat-password" class="form-control" placeholder="Confirmation du mot de passe" required="required" data-error="Confirmation du mot de passe requis">
                <div class="help-block with-errors"></div>
              </div>
              <div class="col-sm-12">
                <button type="submit" name="inscription" class="btn btn-border btn-radius"><span>S'inscrire</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
