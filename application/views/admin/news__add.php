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
<?php if(isset($_POST['submit'])){ ?>
<?php 
$data = array(
        'title' => $this->input->post('nom'),
        'image' => $this->input->post('image'),
        'description' => htmlentities($this->input->post('description')),
        'user' => $user['id']
);

$this->db->insert('news', $data);
 ?>
	<div class="alert alert-success">L'article vient d'être publié avec succès !</div>
<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Création d'un nouveau article</h5>
          </div>
          <div class="card-body">
            <form method="POST">
		        <div class="form-row">
		            <div class="col-md-16">
		                <input type="text" name="nom" class="form-control" placeholder="Nom de l'article">
		            </div>
		        </div>
		        <br>
				<div class="form-row">
		            <div class="col-md-16">
		                <input type="url" name="image" class="form-control" placeholder="Bannière de l'article">
		            </div>
		        </div>
		        <br>
		        <div class="form-row">
		            <div class="col-md-16">
						<textarea name="description"class="form-control" placeholder="Description"></textarea>
		            </div>
		        </div>
		        <br>
				<div class="col-md-16">
                    <button type="submit" name="submit" class="btn btn-primary mb-2">Créer</button>
		        </div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>