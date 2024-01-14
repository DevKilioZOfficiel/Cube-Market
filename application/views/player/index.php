    <?php $server_name = $this->permissions_model->get_config('server_name'); ?>
	<?php $banner = $this->permissions_model->get_config('banner'); ?>
<?php
			  $query_user_permission = $this->db->query("SELECT * FROM permissions WHERE id_grade='".$player['grade']."'");
		  	foreach ($query_user_permission->result() as $minecraft_permissions){
            $rank = $minecraft_permissions->name;
						$color = $minecraft_permissions->color;
						$rank = $minecraft_permissions->name;
				} ?>
<?php
$this->db->where('name', $player['pseudo']);
$this->db->from('bans');
$bans = $this->db->count_all_results();
$this->db->where('name', $player['pseudo']);
$this->db->from('warnings');
$warnings = $this->db->count_all_results();
$this->db->where('name', $player['pseudo']);
$this->db->from('mutes');
$mutes = $this->db->count_all_results();
$sanctions = $mutes+$warnings+$bans;
?>

        <div class="site-content" role="main">
            <section class="bg-image bg-dark d-flex align-items-end py-3" style="background-color: #3a3a3c !important;min-height: 320px;"><img class="background" src="<?= $banner['value']; ?>" alt="" ya-style="opacity: .25">
                <div class="container position-relative">
                    <div class="row">
                        <div class="col d-flex flex-column flex-lg-row align-items-center text-center position-absolute bottom left pl-lg-8">
                            <a class="avatar-thumbnail avatar-lg d-lg-none bg-dark mb-3 mb-lg-0 border-0" href="#"><img src="https://minotar.net/avatar/<?= $player['pseudo']; ?>/200" alt=""></a>
                            <h2 class="h4 text-white mb-0 ml-2 pl-lg-8"><?= $player['pseudo']; ?></h2>
                            <div class="ml-lg-auto mt-4 mb-3 my-lg-0">
							</div>
                        </div>
                    </div>
                </div>
            </section>
			<section class="bg-white border-bottom nav-profile py-0" ya-sticky>
                <div class="container">
                    <div class="row">
                        <div class="col d-flex align-items-center">
						    <a class="avatar-thumbnail avatar-xl position-absolute d-none d-lg-block" href="#"><img src="https://minotar.net/avatar/<?= $player['pseudo']; ?>/200" alt=""></a>
                            <div class="avatar-fixed d-none d-lg-block">
                                <a class="avatar-tile" href="#"><img src="https://minotar.net/avatar/<?= $player['pseudo']; ?>/64" alt="">
                                    <div><strong><?= $player['pseudo']; ?></strong><span class="d-block">@<?= $player['pseudo']; ?></span></div>
                                </a>
                            </div>
                            <div class="nav-scroll">
							<nav>
							  <div class="nav nav-list nav-list-profile" id="nav-tab" role="tablist">
 							   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Informations de <?= $player['pseudo']; ?></a>
							   <a class="nav-item nav-link" id="nav-sanctions-tab" data-toggle="tab" href="#nav-sanctions" role="tab" aria-controls="nav-sanctions" aria-selected="false">Sanctions (<?= $sanctions; ?>)</a>
 							 </div>
							</nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			<section class="py-lg-5">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<!-- ACCUEIL -->
				<div class="container">
				    <div class="row">
						<div class="col-lg-3 order-2 order-lg-1">
                            <div class="widget mt-4">
                                <div class="widget-header">A propos</div>
                                <div class="widget-body">
                                    <p><?= $player['pseudo']; ?> est un <?= $rank; ?> sur <?= $server_name['value']; ?>.</p>
                                    <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-calendar mr-1"></i> Inscrit le <?= $player['date']; ?></p>
							                  </div>
                            </div>
                        </div>
						<div class="col-lg-9 order-2 order-lg-1">
							<div class="alert alert-info">Il y a encore aucune information à voir ici. Revenez plus tard...</div>
						</div>
					</div>
				</div>
				<!-- FIN ACCUEIL -->
				</div>
                <div class="tab-pane fade" id="nav-sanctions" role="tabpanel" aria-labelledby="nav-sanctions-tab">
				  <div class="container">
				    <div class="row">
						<div class="col-md-12">
							<div class="widget-header"><h2>Sanctions de <?= $player['pseudo']; ?></h2></div>
						</div>
						<table class="table table-striped align-items-center">
								    <thead>
									    <tr>
										    <th scope="col">
											    #
											</th>
											<th scope="col">Type</th>
											<th scope="col">Modérateur</th>
											<th scope="col">Raison</th>
											<th scope="col">Infos</th>
										</tr>
									</thead>
									<tbody>
									<?php $this->db->where('name', $player['pseudo']);
									$query = $this->db->get('bans');
									foreach ($query->result() as $row){ ?>
									    <tr>
										    <th scope="row">
											    <?= $row->id; ?>
											</th>
											<td>Bannissement</td>
											<td><?= $row->banner; ?></td>
											<td><?= $row->reason; ?></td>
											<td>
											    <button class="btn btn-link btn-icon px-0 mr-2" data-toggle="tooltip" title="" data-original-title="<?= 'Du '.date('d/m/Y', $row->time).' &agrave; '.date('H:i:s', $row->time); ?>">Début</button>
											  	<button class="btn btn-link btn-icon px-0" data-toggle="tooltip" title="" data-original-title="<?= 'Au '.date('d/m/Y', $row->expires).' &agrave; '.date('H:i:s', $row->expires); ?>">Fin</button>
											</td>
										</tr>
									<?php } ?>
                  <?php $this->db->where('name', $player['pseudo']);
									$query = $this->db->get('mutes');
									foreach ($query->result() as $row){ ?>
									    <tr>
										    <th scope="row">
											    <?= $row->id; ?>
											</th>
											<td>Mute</td>
											<td><?= $row->muter; ?></td>
											<td><?= $row->reason; ?></td>
											<td>
											    <button class="btn btn-link btn-icon px-0 mr-2" data-toggle="tooltip" title="" data-original-title="<?= 'Du '.date('d/m/Y', $row->time).' &agrave; '.date('H:i:s', $row->time); ?>">Début</button>
											  	<button class="btn btn-link btn-icon px-0" data-toggle="tooltip" title="" data-original-title="<?= 'Au '.date('d/m/Y', $row->expires).' &agrave; '.date('H:i:s', $row->expires); ?>">Fin</button>
											</td>
										</tr>
									<?php } ?>
                  <?php $this->db->where('name', $player['pseudo']);
									$query = $this->db->get('warnings');
									foreach ($query->result() as $row){ ?>
									    <tr>
										    <th scope="row">
											    <?= $row->id; ?>
											</th>
											<td>Avertissement</td>
											<td><?= $row->banner; ?></td>
											<td><?= $row->reason; ?></td>
											<td>
											    <button class="btn btn-link btn-icon px-0" data-toggle="tooltip" title="" data-original-title="<?= 'Expire le '.date('d/m/Y', $row->expires).' &agrave; '.date('H:i:s', $row->expires); ?>">Fin</button>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
					</div>
				  </div>
				</div>
            </div>
			</section>
		</div>