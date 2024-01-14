<script src="https://cdn.tiny.cloud/1/9oz3kyx8osjmb872y4pbdmps4pydonphzft8bbabrnbmdq5o/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

tinymce.init({
  selector: 'textarea',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ],
  //link_list: [
  //  { title: 'My page 1', value: 'http://www.tinymce.com' },
  //  { title: 'My page 2', value: 'http://www.moxiecode.com' }
  //],
  //image_list: [
  //  { title: 'My page 1', value: 'http://www.tinymce.com' },
  //  { title: 'My page 2', value: 'http://www.moxiecode.com' }
  //],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_drawer: 'sliding',
  contextmenu: "link image imagetools table",
 });
</script>

<div class="wrapper-content">
  <div class="container">
    <div class="row  align-items-center justify-content-between">
      <div class="col-11 col-sm-12 page-title">
        <h3>Bienvenue, <?= $permission['nom']; ?> <?= $user['pseudo']; ?></h3>
        <p>Le panel est en <b>BÊTA</b></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-16">
	  <?php
$this->db->order_by('id', 'ASC');
$query3 = $this->db->get('news');						 
foreach ($query3->result() as $row3){ ?>
<?php if(isset($_POST['title_'.$row3->id.''])){ ?>
<?php if($this->input->post('title') != $row3->title){
	$this->db->set('title', $this->input->post('title'));
	$this->db->where('id', $row3->id);
	$this->db->update('news'); ?>
	<div class="alert alert-success">Vous venez de modifier le titre de l'article !</div>
<?php } ?>
<?php } ?>

<?php if(isset($_POST['text_'.$row3->id.''])){ ?>
<?php if($this->input->post('argent') != $row3->argent){
	$this->db->set('description', htmlentities($this->input->post('text')));
	$this->db->where('id', $row3->id);
	$this->db->update('news'); ?>
	<div class="alert alert-success">Vous venez de modifier la description de l'article !</div>
<?php } ?>
<?php } ?>
<?php
   if(isset($_POST['delete_'.$row3->id.''])){
    $this->db->where('id', $this->input->post('cid'));
    $this->db->delete('news'); ?>
	<div class="alert alert-info">L'article vient d'être supprimé !</div>
    <?php } ?>


<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Actualités <small>(<?= $this->db->count_all_results('news'); ?>)</small></h5>
          </div>
          <div class="card-body">
            <table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Titre</th>
                  <th>Auteur</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('news');						 
				foreach ($query->result() as $row){ ?>
				<?php 
				$this->db->where('id', $row->user);
				$query = $this->db->get('user');						 
				foreach ($query->result() as $row_user){ ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->title; ?></td>
                  <td><?= $row_user->pseudo; ?></td>
                  <td class="center">
				  <button style="display:inline;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $row->id; ?>">Modifier</button>
				  <form method="POST" style="display:inline;"><input type="hidden" value="<?= $row->id; ?>" name="cid"><button type="submit" name="delete_<?= $row->id; ?>" class="btn btn-danger">Supprimer</button>
				  </td>
                </tr>
				<?php } ?>
				<?php } ?>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>


<?php
$this->db->order_by('id', 'ASC');
$query2 = $this->db->get('news');						 
foreach ($query2->result() as $row2){ ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $row2->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $row2->id; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier les informations de l'article <?= $row2->title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <form method="POST">
		<div class="form-row">
          <div class="col-md-12">
            <input type="text" name="title" class="form-control" id="text" placeholder="Titre" value="<?= $row2->title; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="title_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		<br>
		<form method="POST">
		<div class="form-row">
          <div class="col-md-12">
		    <textarea name="text" class="form-control"><?= html_entity_decode($row2->description); ?></textarea>
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="text_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>


<script src="<?= base_url('assets/admin/'); ?>vendor/flot/excanvas.min.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.pie.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.resize.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.time.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>