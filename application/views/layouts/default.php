<?php
    $server_name = $this->permissions_model->get_config('server_name');
    $server_infos = $this->permissions_model->get_config('server_infos');
    $site__licence_kilioz = $this->permissions_model->get_config('site__licence_kilioz');
?>
<?php
$this->db->where('ip', $_SERVER['REMOTE_ADDR']);
$this->db->from('online');
$count_online_by_ip = $this->db->count_all_results();

if (!$this->session->userdata('logged_in')) {
	$users = "1";
}else{
	$users = $user['id'];
}

if($count_online_by_ip == 0){
	$data = array(
        'user' => $users,
        'ip' => $_SERVER['REMOTE_ADDR'],
        'expiration' => time()
    );

    $this->db->insert('online', $data);
} ?>

<?php $timestamp_5min = time() - (60 * 5); // 60 * 5 = nombre de secondes écoulées en 5 minutes; ?>
<?php $query = $this->db->query("SELECT * FROM online WHERE expiration < ".$timestamp_5min.""); ?>
<?php foreach ($query->result() as $row){ ?>
<?php $this->db->query("DELETE FROM online WHERE id = ".$row->id.""); ?>
<?php } ?>



<?php //$key = $site__licence_kilioz['value'];$licence__api = "https://dev-time.eu/developers/api/api__license/DT-001-3891-996002-684945/".$key."/DP-001336115903837667980";$curl = curl_init();curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);curl_setopt($curl, CURLOPT_URL, $licence__api);curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);$result = curl_exec($curl);curl_close($curl);$response = json_decode($result); ?>
<?php //if($response->{'data'}->valid == 1){ ?>
<?php //}else{
	//echo "Licence suspendu: ".$response->{'data'}->message."";
//} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="Cube-Market" />
<meta name="description" content="<?= $server_infos['value']; ?>" />
<meta name="author" content="KilioZ" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Cube-Market - <?= $title; ?></title>

<!-- favicon icon -->
<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/972150681874092102/978182580031594516/6.png" />

<!-- inject css start -->
<!--== bootstrap -->
<link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!--== animate -->
<link href="<?= base_url('assets/'); ?>css/animate.css" rel="stylesheet" type="text/css" />

<!--== fontawesome -->
<link href="<?= base_url('assets/'); ?>css/fontawesome-all.css" rel="stylesheet" type="text/css" />

<!--== themify-icons -->
<link href="<?= base_url('assets/'); ?>css/themify-icons.css" rel="stylesheet" type="text/css" />

<!--== audioplayer -->
<link href="<?= base_url('assets/'); ?>css/audioplayer/media-player.css" rel="stylesheet" type="text/css" />

<!--== magnific-popup -->
<link href="<?= base_url('assets/'); ?>css/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

<!--== owl-carousel -->
<link href="<?= base_url('assets/'); ?>css/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />

<!--== base -->
<link href="<?= base_url('assets/'); ?>css/base.css" rel="stylesheet" type="text/css" />

<!--== shortcodes -->
<link href="<?= base_url('assets/'); ?>css/shortcodes.css" rel="stylesheet" type="text/css" />

<!--== default-theme -->
<link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet" type="text/css" />

<!--== responsive -->
<link href="<?= base_url('assets/'); ?>css/responsive.css" rel="stylesheet" type="text/css" />

<!-- inject css end -->

</head>

<body>

<!-- page wrapper start -->

<div class="page-wrapper">

<!--header start-->

<header id="site-header" class="header">
  <div class="top-bar xs-text-center">
    <div class="container">
      <div class="top-bar-inner">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-7 col-sm-6">
          <div class="topbar-link text-left">
            <ul class="list-inline">
			<?php if (!$this->session->userdata('logged_in')) { ?>
                        <li class="list-inline-item"><a class="nav-link" href="<?= base_url('connexion'); ?>"><span class="d-none d-md-inline-block">Connexion</span><span class="d-inline-block d-md-none"></span></a></li>
                        <li class="list-inline-item"><a class="nav-link" href="<?= base_url('inscription'); ?>"><span class="d-none d-md-inline-block">Inscription</span><span class="d-inline-block d-md-none"></span></a></li>
                    <?php }else{ ?>
                        <li class="list-inline-item"><a class="nav-link" href="<?= base_url('parametres'); ?>"><span class="d-none d-md-inline-block"><?= $user['pseudo']; ?></span><span class="d-inline-block d-md-none"></span></a></li>
                        <?php if($permission['is_admin'] == 1){ ?>
						<li class="list-inline-item"><a class="nav-link" href="<?= base_url('admin'); ?>"><span class="d-none d-md-inline-block">Admin</span><span class="d-inline-block d-md-none"></span></a></li>
                        <?php } ?>
						<li class="list-inline-item"><a class="nav-link" href="<?= base_url('credit'); ?>"><span class="d-none d-md-inline-block">Argent</span><span class="d-inline-block d-md-none"></span></a></li>
						<li class="list-inline-item"><a class="nav-link" href="<?= base_url('logout'); ?>"><span class="d-none d-md-inline-block">Déconnexion</span><span class="d-inline-block d-md-none"></span></a></li>


					<?php } ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-md-5 col-sm-6 text-sm-right d-flex align-items-center justify-content-sm-end justify-content-center">
          <div class="social-icons social-hover top-social-list text-right">
            <ul class="list-inline">
              <li><a href="#"><i class="fab fa-facebook-f"></i></a>
              </li>
              <li><a href="#"><i class="fab fa-twitter"></i></a>
              </li>
            </ul>
          </div>
          <li class="list-inline-item search-icon mx-2">
                <div class="search-wrap">
                  <button id="btn-search" class="btn-search"><i class="ti-search"></i>
                  </button>
                </div>
           </li>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div id="header-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand logo" href="<?= base_url(); ?>">
              <img id="logo-img" class="img-center" src="https://cdn.discordapp.com/attachments/972150681874092102/978182580031594516/6.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <!-- Left nav -->
              <ul id="main-menu" class="nav navbar-nav ml-auto mr-auto">
			    <?php $query_navigation = $this->db->query("SELECT * FROM navigation ORDER by id ASC"); ?>
                        <?php foreach ($query_navigation->result() as $navigation){ ?>
                            <?php if($navigation->type == 0){ ?>
						    <li class="nav-item dropdown">
								<a class="nav-link" href="<?= $navigation->url; ?>"><?= $navigation->name; ?></a>
							</li>
							<?php } ?>
							<?php if($navigation->type == 1){ ?>
							<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $navigation->name; ?></a>
                                <div class="dropdown-menu">
								<?php $query_navigation_dropdown = $this->db->query("SELECT * FROM navigation WHERE type='2' AND dropdown_id='".$navigation->id."' ORDER by id ASC"); ?>
                                    <?php foreach ($query_navigation_dropdown->result() as $navigation_dropdown){ ?>
                                          <a class="dropdown-item" href="<?= $navigation_dropdown->url; ?>"><?= $navigation_dropdown->name; ?></a>
                                    <?php } ?>
								</div>
                            </li>
							<?php } ?>
						<?php } ?>
			  </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="search">
  <button id="btn-search-close" class="btn-search-close" aria-label="Fermer le menu"><i class="ti-close"></i>
  </button>
  <form class="search-form" method="GET" action="<?= base_url('products'); ?>">
    <input class="search-input" name="product" type="search" placeholder="Cube-Market" /> <span class="search-info">Recherchez des plugins/serveurs/maps et bien plus !</span>
  </form>
</div>

<?php $this->load->view($content);?>
<!--footer start-->

<footer class="footer dark-bg">
  <div class="primary-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="media-icon list-inline d-flex flex-md-row flex-column align-content-center justify-content-between align-items-between">
            <li> <i class="flaticon-contact"></i>
              <span>Email:</span>
              <a href="mailto:contact@cube-market.fr">contact@cube-market.fr</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-4 col-md-6">
          <div class="footer-logo mb-4">
            <img class="img-center" src="https://cdn.discordapp.com/attachments/972150681874092102/978182580031594516/6.png" alt="">
          </div>
          <p class="mb-4">Cube-Market est le meilleur moyen de vendre vos produits sur Internet. Tout est vérifié par notre équipe afin d'éviter toute les fraudes</p>
          <div class="social-icons circle social-colored">
            <ul class="list-inline mb-0">
              <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a>
              </li>
              <li class="social-twitter"><a href="#"><i class="fab fa-twitter"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 sm-mt-5 footer-list pl-xl-5">
          <h5>Liens utiles</h5>
          <ul class="list-unstyled">
            <li><a href="<?= base_url('p/about'); ?>">A Propos</a>
            </li>
            <li><a href="<?= base_url('p/faq'); ?>">FAQ</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 sm-mt-5 footer-list">
          <h5>Conditions</h5>
          <ul class="list-unstyled">
            <li><a href="<?= base_url('p/cgu'); ?>">CGU</a></li>
            <li><a href="<?= base_url('p/mentions'); ?>">Mentions légales</a></li>
            <li><a href="<?= base_url('p/cgv'); ?>">CGV</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="secondary-footer">
    <div class="container">
      <div class="copyright">
        <div class="row align-items-center">
          <div class="col-md-6"> <span>Copyright <?= date('Y'); ?> | Tous droits réservés</span>
          </div>
          <div class="col-md-6 text-md-right"> <span>Développé par <a href="https://dev-time.eu/"><u>KilioZ</u></a> </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!--footer end-->


</div>

<!-- page wrapper end -->


<!--back-to-top start-->

<div class="scroll-top"><a class="smoothscroll" href="#top"><i class="flaticon-arrow-pointing-upwards"></i></a></div>

<!--back-to-top end-->



<!-- inject js start -->

<!--== jquery -->
<script src="<?= base_url('assets/'); ?>js/jquery.3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>

<!--== popper -->
<script src="<?= base_url('assets/'); ?>js/popper.min.js"></script>

<!--== bootstrap -->
<script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>

<!--== appear -->
<script src="<?= base_url('assets/'); ?>js/jquery.appear.js"></script>

<!--== modernizr -->
<script src="<?= base_url('assets/'); ?>js/modernizr.js"></script>

<!--== menu -->
<script src="<?= base_url('assets/'); ?>js/menu/jquery.smartmenus.js"></script>

<!--== search -->
<script src="<?= base_url('assets/'); ?>js/search.js"></script>

<!--== magnific-popup -->
<script src="<?= base_url('assets/'); ?>js/magnific-popup/jquery.magnific-popup.min.js"></script>

<!--== owl-carousel -->
<script src="<?= base_url('assets/'); ?>js/owl-carousel/owl.carousel.min.js"></script>

<!--== counter -->
<script src="<?= base_url('assets/'); ?>js/counter/counter.js"></script>

<!--== countdown -->
<script src="<?= base_url('assets/'); ?>js/countdown/jquery.countdown.min.js"></script>

<!--== isotope -->
<script src="<?= base_url('assets/'); ?>js/isotope/isotope.pkgd.min.js"></script>

<!--== nice-select -->
<script src="<?= base_url('assets/'); ?>js/jquery.nice-select.js"></script>

<!--== wow -->
<script src="<?= base_url('assets/'); ?>js/wow.min.js"></script>

<!--== theme-script -->
<script src="<?= base_url('assets/'); ?>js/theme-script.js"></script>

<!-- inject js end -->
<script>
      $('#summernote').summernote({
        placeholder: 'Description',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
	  $('#summernote2').summernote({
        placeholder: 'Description',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
</body>


</html>
