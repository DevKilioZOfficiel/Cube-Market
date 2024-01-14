<section class="page-title grediant-overlay text-center" data-bg-img="<?= $image; ?>" data-overlay="6">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1><?= $page['name']; ?></h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('products'); ?>">Page</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?= $page['name']; ?></li>
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
        <?= $page['content']; ?>
		<hr>
		Dernière modification le <?= $page['last_edit']; ?>
      </div>
    </div>
  </div>
</section>
</div>
<!--service details end-->