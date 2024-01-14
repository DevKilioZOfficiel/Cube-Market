    <div class="row">
<?php if(isset($_POST['recherche'])){
  echo '';
	$recherche = htmlspecialchars($this->input->post('recherche'));
	//utilisateurs
  $query_recherche = $this->db->query("SELECT * FROM user WHERE pseudo LIKE '%".$recherche."%'"); ?>
  <?php foreach ($query_recherche->result() as $recherche_minecraft){ ?>
    <?php $this->db->where('pseudo', $recherche_minecraft->pseudo);
    $this->db->from('user');
    $verif_exist = $this->db->count_all_results(); ?>
    <?php if($verif_exist != 0){
    		$query_user_permission = $this->db->query("SELECT * FROM permissions WHERE id_grade='".$recherche_minecraft->grade."'");
    		foreach ($query_user_permission->result() as $minecraft_permissions){
            $rank = $minecraft_permissions->name;
    				$color = $minecraft_permissions->color;
    		}

    	}else{ $rank = ""; $color=""; } ?>
        <div class="col-md-3 col-xs-12 col-lg-3">
	        <a class="avatar-card" href="<?= base_url('player/'.$recherche_minecraft->pseudo.''); ?>" style="margin-bottom: 20px;">
		        <div>
				    <div class="avatar-title"><?= $recherche_minecraft->pseudo; ?></div>
					<p class="avatar-text" style="color:#<?= $color; ?>"><?= $rank; ?></p>
				</div>
			    <img src="https://minotar.net/avatar/<?= $recherche_minecraft->pseudo; ?>/64" alt="">
		    </a>
		</div>
    <?php } ?>
  <?php } ?>
    </div>
