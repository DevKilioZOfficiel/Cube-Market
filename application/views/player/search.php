    <?php $server_name = $this->permissions_model->get_config('server_name'); ?>
	<?php $banner = $this->permissions_model->get_config('banner'); ?>
<script>
    function ajax_search(){
    var url = "<?= base_url('player/api__search'); ?>";
    var recherches = document.getElementById('search').value;
    if(recherches != ''){
          $.ajax({
              url: url,
              type: "POST",
              data: { recherche: recherches },
              success: function(donnees){
                  document.getElementById('result').innerHTML = donnees;
              }
          });
    }else{
      document.getElementById('result').innerHTML = '';
    }
}
</script>
        <div class="site-content" role="main">
            <section class="overflow-hidden py-0" data-parallax="scroll" data-image-src="<?= $banner['value']; ?>">
                <div class="overlay" ya-style="background-color: #36373a;opacity: .9"></div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-white py-7 mb-0 mt-3">Rechercher un joueur sur le serveur</h1></div>
                    </div>
                    <div class="row">
                        <div class="col d-flex align-items-center">
						</div>
                    </div>
                </div>
            </section>
			<section class="border-bottom-dashed">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form onSubmit="ajax_search(); return false;">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg form-control-inline" id="search" onkeyup="ajax_search();" placeholder="Rechercher un joueur">
                                    <div class="input-group-append">
                                        <button name="search" class="btn btn-light border-left-0 btn-lg px-3" type="button"><i class="ya ya-search m-0"></i></button>
                                    </div>
                                </div>
								<div id="result2"></div>
								</form>
                            <!-- end form -->
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="container">
					<div id="result"></div>
				</div>
			</section>
		</div>