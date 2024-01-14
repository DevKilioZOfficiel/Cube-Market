<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="https://bootstraptemplatedesign.com/website/Adminux/favicon.ico">
<title><?= $title; ?></title>
<!-- Fontawesome icon CSS -->
<script src="https://kit.fontawesome.com/f05b1a7516.js" crossorigin="anonymous"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= base_url('assets/admin/'); ?>vendor/bootstrap-4.1.1/css/bootstrap.css" type="text/css">

<!-- DataTables Responsive CSS -->
<link href="<?= base_url('assets/admin/'); ?>vendor/datatables/css/dataTables.bootstrap4.css" rel="stylesheet">
<link href="<?= base_url('assets/admin/'); ?>vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">

<!-- jvectormap CSS -->
<link href="<?= base_url('assets/admin/'); ?>vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet">

<!-- Adminux CSS -->
 <link rel="stylesheet" href="<?= base_url('assets/admin/'); ?>css/light_adminux.css" type="text/css">
</head>
<body class="menuclose menuclose-right">

<header class="navbar-fixed">
  <nav class="navbar navbar-toggleable-md navbar-inverse bg-faded">
    <div class="sidebar-left"> <a class="navbar-brand" href="<?= base_url('/admin'); ?>"><h2>CMarket</h2></a>
      <button class="btn btn-link icon-header mr-sm-2 pull-right menu-collapse" ><span class="fa fa-bars"></span></button>
    </div>
    <div class="d-flex mr-auto"> &nbsp;</div>
    <ul class="navbar-nav content-right">
      <li class="nav-item "> <a class="btn btn-link icon-header menu-collapse-right" href="#"><span class="fa fa-podcast"></span> </a> </li>
    </ul>
    <div class="sidebar-right pull-right">
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item">
          <a class="btn-link btn userprofile" href="<?= base_url('parametres'); ?>"><span class="userpic"><img src="https://minotar.net/avatar/<?= $user['pseudo']; ?>/32" alt="user pic"></span> <span class="text"><?= $user['pseudo']; ?></span></a>
        </li>
        <li><a href="<?= base_url('deconnexion'); ?>" class="btn btn-link icon-header" ><span class="fa fa-sign-out"></span></a></li>
      </ul>
    </div>
  </nav>
</header>
<div class="sidebar-left">
<div class="user-menu-items">
    <div class="list-unstyled btn-group">
      <button class="media btn btn-link"> <span class="message_userpic"><img class="d-flex" src="https://minotar.net/avatar/<?= $user['pseudo']; ?>/100" alt="Generic user image"></span> <span class="media-body"> <span class="mt-0 mb-1"><?= $user['pseudo']; ?></span> <small><?= $permission['nom']; ?></small> </span> </button>
    </div>
  </div>
  <br>
  <ul class="nav flex-column in" id="side-menu">
    <li class="title-nav">MENU</li>
    <li class="nav-item "> 
	<a href="<?= base_url('admin'); ?>" class="nav-link">Accueil</a> 
    </li>
	<?php if($permission['PERM__ADM_EDIT_USER'] == 1){ ?>
    <li class="nav-item "> 
	  <a href="javascript:void(0)" class="menudropdown nav-link">Membres<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="in nav-item"><a  href="<?= base_url('admin/users'); ?>" class="nav-link ">Utilisateurs</a></li>
        <li class="nav-item"><a  href="<?= base_url('admin/staff'); ?>" class="nav-link ">Staff</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
	<?php } ?>
	<?php if($permission['PERM__ADM_EDIT__PRODUCT'] == 1){ ?>
    <li class="nav-item "> 
	  <a href="javascript:void(0)" class="menudropdown nav-link">Boutique<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="in nav-item"><a  href="<?= base_url('admin/store'); ?>" class="nav-link ">Produits</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
	<?php } ?>
	
	<?php if($permission['PERM__ADM_ADD_NEWS'] == 1){ ?>
    <li class="nav-item "> 
	  <a href="javascript:void(0)" class="menudropdown nav-link">News<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="in nav-item"><a  href="<?= base_url('admin/news'); ?>" class="nav-link ">Actualités</a></li>
        <li class="nav-item"><a  href="<?= base_url('admin/news__add'); ?>" class="nav-link ">Nouvelle news</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
	<?php } ?>
	<?php if($permission['PERM__ADM_PAGE'] == 1){ ?>
	<li class="nav-item "> 
	<a href="<?= base_url('admin/page'); ?>" class="nav-link">Pages customs</a> 
    </li>
	<?php } ?>
	<?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
    <li class="nav-item "> 
	  <a href="javascript:void(0)" class="menudropdown nav-link">Configuration<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="in nav-item"><a  href="<?= base_url('admin/configs_site'); ?>" class="nav-link ">Informations du site</a></li>
        <li class="nav-item"><a  href="<?= base_url('admin/navigation'); ?>" class="nav-link ">Navigation</a></li>
        <li class="nav-item"><a  href="<?= base_url('admin/permissions'); ?>" class="nav-link ">Permissions</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
	<?php } ?>
  </ul>
  <hr>
  <br>
  <br>
</div>
<?php $this->load->view($content);?>
<div class="sidebar-right">
  <ul class="nav flex-column " >
    <li class="nav-item text-center">
      <div class="progressprofile">
        <div class="progress_profile " data-value="0.90"  data-size="140"  data-thickness="4"  data-animation-start-value="0" data-reverse="false" ></div>
        <div class="user-details">
          <figure><img src="https://minotar.net/avatar/<?= $user['pseudo']; ?>/100" alt="complete profile"></figure>
          <p class=""><?= $permission['nom']; ?></p>
        </div>
        <div class="clearfix"></div>
      </div>
    </li>
  </ul>
  <hr>
  <hr>
  <br>
  <br>
</div>

 

<!-- jQuery first, then Tether, then Bootstrap JS. -->

<script src="<?= base_url('assets/admin/'); ?>js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
	
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
    </script>
	

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> 

<script src="<?= base_url('assets/admin/'); ?>vendor/bootstrap4beta/js/bootstrap.min.js" type="text/javascript"></script> 
    
<!--Cookie js for theme chooser and applying it --> 
<script src="<?= base_url('assets/admin/'); ?>vendor/cookie/jquery.cookie.js"  type="text/javascript"></script> 

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?= base_url('assets/admin/'); ?>js/ie10-viewport-bug-workaround.js"></script>

<!-- Circular chart progress js --> 
<script src="<?= base_url('assets/admin/'); ?>vendor/cicular_progress/circle-progress.min.js" type="text/javascript"></script> 

<!--sparklines js--> 
<script type="text/javascript" src="<?= base_url('assets/admin/'); ?>vendor/sparklines/jquery.sparkline.min.js"></script> 

<!-- jvectormap JavaScript --> 
<script src="<?= base_url('assets/admin/'); ?>vendor/jquery-jvectormap/jquery-jvectormap.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script> 

<!-- chart js --> 
<script src="<?= base_url('assets/admin/'); ?>vendor/chartjs/Chart.bundle.min.js" type="text/javascript"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/chartjs/utils.js" type="text/javascript"></script> 

<!-- spincremente js --> 
<script src="<?= base_url('assets/admin/'); ?>vendor/spincrement/jquery.spincrement.min.js" type="text/javascript"></script> 

<!-- DataTables JavaScript --> 
<script src="<?= base_url('assets/admin/'); ?>vendor/datatables/js/jquery.dataTables.min.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/datatables/js/dataTables.bootstrap4.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/datatables/js/dataTables.responsive.min.js"></script> 

<!-- custome template js --> 
<script src="<?= base_url('assets/admin/'); ?>js/adminux.js" type="text/javascript"></script> 
<script src="<?= base_url('assets/admin/'); ?>js/dashboard1.js"></script>
</html>

