<?php
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "To",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "Go",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "Mo",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "Ko",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "o",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

class DiskStatus {

  const RAW_OUTPUT = true;

  private $diskPath;


  function __construct($diskPath) {
    $this->diskPath = $diskPath;
  }


  public function totalSpace($rawOutput = false) {
    $diskTotalSpace = @disk_total_space($this->diskPath);

    if ($diskTotalSpace === FALSE) {
      throw new Exception('totalSpace(): Invalid disk path.');
    }

    return $rawOutput ? $diskTotalSpace : $this->addUnits($diskTotalSpace);
  }


  public function freeSpace($rawOutput = false) {
    $diskFreeSpace = @disk_free_space($this->diskPath);

    if ($diskFreeSpace === FALSE) {
      throw new Exception('freeSpace(): Invalid disk path.');
    }

    return $rawOutput ? $diskFreeSpace : $this->addUnits($diskFreeSpace);
  }


  public function usedSpace($precision = 1) {
    try {
      return round((100 - ($this->freeSpace(self::RAW_OUTPUT) / $this->totalSpace(self::RAW_OUTPUT)) * 100), $precision);
    } catch (Exception $e) {
      throw $e;
    }
  }


  public function getDiskPath() {
    return $this->diskPath;
  }


  private function addUnits($bytes) {
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB' );

    for($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++ ) {
      $bytes /= 1024;
    }

    return round($bytes, 1).' '.$units[$i];
  }

}



try {
  $diskStatus = new DiskStatus('/www/wwwroot/cube-market.fr/uploads/');

  $freeSpace = $diskStatus->freeSpace();
  $totalSpace = $diskStatus->totalSpace();
  $barWidth = ($diskStatus->usedSpace()/100) * 400;

} catch (Exception $e) {
  echo 'Error ('.$e->getMessage().')';
  exit();
}

 ?>
<div class="wrapper-content">
  <div class="container">
    <div class="row  align-items-center justify-content-between">
      <div class="col-11 col-sm-12 page-title">
        <h3>Bienvenue, <?= $permission['nom']; ?> <?= $user['pseudo']; ?></h3>
        <p>Le panel est en <b>BÊTA</b></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block success">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament">
			  <?php $this->db->like('date', ''.date('Y').'-'.date('m').'');
			  echo $this->db->count_all_results('products__list'); ?></span></h5>
              <p>Nouveaux produits</p>
            </div>
            <i class="fa fa-cubes"></i> </div>
		</div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block danger">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament"><?= $this->db->count_all_results('user'); ?></span></h5>
              <p>Membres</p>
            </div>
            <i class="fa fa-users"></i> </div>
		</div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block warning">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament"><?= $this->db->count_all_results('paiement__mobile')+$this->db->count_all_results('paiement__paypal'); ?></span></h5>
              <p>Achats</p>
            </div>
            <i class="fa fa-cart-arrow-down"></i> </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block primary">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament"><?= $this->db->count_all_results('online'); ?></span></h5>
              <p>Visiteurs actuellement</p>
            </div>
            <i class="fa fa-users"></i> </div>
        </div>
      </div>
	  <?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
	  <?php
	  function shapeSpace_server_memory_usage() {

	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2] / $mem[1] * 100;

	return $memory_usage;

}
 ?>
	  <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block primary">
          <div class="media">
            <div class="media-body">
              <h5><span class=""><?= shapeSpace_server_memory_usage(); ?></span></h5>
              <p>Mémoire du serveur (%)</p>
            </div>
            <i class="fa fa-server"></i> </div>
        </div>
      </div>
	  <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block secondary">
          <div class="media">
            <div class="media-body">
              <h5><span class=""><?= FileSizeConvert(disk_total_space("/www/wwwroot/cube-market.fr/")); ?></span></h5>
              <p>Espace disque total</p>
            </div>
            <i class="fa fa-server"></i> </div>
        </div>
      </div>
	  <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block info">
          <div class="media">
            <div class="media-body">
              <h5><span class=""><?= FileSizeConvert(disk_free_space("/www/wwwroot/cube-market.fr/")); ?></span></h5>
              <p>Espace disque libre</p>
            </div>
            <i class="fa fa-server"></i> </div>
        </div>
      </div>
	</div>
	<div class="row">

	  <div class="col-md-16 col-lg-16 col-xl-16">
	      <div class="card">
		    <div class="card-content">
	<?php
	$query = $this->db->get('paiement__transfert');

	foreach ($query->result() as $row){ ?>
	<?php if(isset($_POST['payement__'.$row->id.''])){
	$this->db->set('etat', $this->input->post('etat__'.$row->id.''));
	$this->db->set('paypal_id', $this->input->post('paypal_id__'.$row->id.''));
	$this->db->where('id', $row->id);
	$this->db->update('paiement__transfert');
	} ?>
	<?php } ?>

	  <table class="table table-striped">
 					 <thead>
 					   <tr>
 					     <th scope="col">#</th>
 					     <th scope="col">Paypal</th>
 					     <th scope="col">Solde</th>
 					     <th scope="col">ID Paypal</th>
 					     <th scope="col">Validation</th>
 					     <th scope="col">Action</th>
 					   </tr>
  					</thead>
 					 <tbody>
					 <?php
					 $this->db->where('etat', 'inwork');
					 $query = $this->db->get('paiement__transfert');

					 foreach ($query->result() as $row){ ?>
					 <form method="POST">
 					   <tr>
  					    <th scope="row">#<?= $row->id; ?></th>
 					     <td><?= $row->paypal; ?></td>
  					    <td><?= $row->solde; ?></td>
  					    <td><input type="text" name="paypal_id__<?= $row->id; ?>" placeholder="ID Paiement paypal" class="form-control"></td>
						<td><select name="etat__<?= $row->id; ?>" class="form-control">
						<option value="inwork">En cours</option>
						<option value="cancel">Annulé</option>
						<option value="accepted">Validé</option>
						</select></td>
  					    <td><button type="submit" name="payement__<?= $row->id; ?>" class="btn btn-success">Modifier</button></td>
  					  </tr>
					  </form>
					 <?php } ?>
					 </tbody>
					</table>
			  </div>
		  </div>
	  </div>


	  <?php } ?>

    </div>

  </div>
</div>


<script src="<?= base_url('assets/admin/'); ?>vendor/flot/excanvas.min.js"></script>
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.js"></script>
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.pie.js"></script>
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.resize.js"></script>
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.time.js"></script>
<script src="<?= base_url('assets/admin/'); ?>vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
