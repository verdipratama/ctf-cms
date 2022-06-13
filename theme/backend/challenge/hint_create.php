<script src="<?=_backEnd()?>tinymce/tinymce.min.js?v=123"></script>
<!-- start page title -->

<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">

        </ol>
      </div>
      <h4 class="page-title"><?=$title?></h4>
    </div>
  </div>
</div>
<!-- end page title -->

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary mx-1" type="submit" name="save"
              value="save">Create</button>
            <!-- <button class="btn btn-secondary" type="submit" name="save" value="saveexit">Update & Exit</button> -->
          </div>
          <div class="mb-3">
            <label class="form-label">Minus Points</label>
            <input type="number" class="form-control seo_input" name="score"
              value="" placeholder="- Points" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="content" id="content"></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?=_backEnd()?>js/vendor.min.js"></script>
<script src="<?=_backEnd()?>js/app.min.js"></script>

<script>
tinymce.init({
  selector: '#content',
  plugins: 'link lists image advlist fullscreen media code table emoticons textcolor codesample hr preview mediaGallery',
  height: 400,
  menubar: false,
  relative_urls: false,
  remove_script_host: false,
  convert_urls: true,
  skin: "oxide-dark",
  content_css: "dark",
  toolbar: [
    'bold italic underline strikethrough forecolor backcolor bullist numlist | alignleft aligncenter alignright alignjustify | mediaGallery link table emoticons hr | code codesample | fullscreen',
  ],
  codesample_languages: [{
      text: 'HTML/XML',
      value: 'html'
    },
    {
      text: 'JavaScript',
      value: 'javascript'
    },
    {
      text: 'CSS',
      value: 'css'
    },
    {
      text: 'PHP',
      value: 'php'
    },
    {
      text: 'Ruby',
      value: 'ruby'
    },
    {
      text: 'Python',
      value: 'python'
    },
    {
      text: 'Java',
      value: 'java'
    },
    {
      text: 'C',
      value: 'c'
    },
    {
      text: 'C#',
      value: 'csharp'
    },
    {
      text: 'C++',
      value: 'cpp'
    }
  ],
});
tinymce.PluginManager.add('mediaGallery', function(editor, url) {
  var openDialog = function() {
    loaddir("files")
    $('#skfindershow').modal('show');
  };
  editor.ui.registry.addButton('mediaGallery', {
    icon: 'gallery',
    onAction: function() {
      // Open window
      openDialog();
    }
  });
});
</script>
<!-- Modal -->
<div class="modal fade m-0 p-0" style="z-index: 999999999999;" id="skfindershow"
  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">SKFinder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-hidden="true"></button>
      </div> <!-- end modal header -->
      <div class="modal-body" id="skfinder">

      </div>
    </div> <!-- end modal content-->
  </div> <!-- end modal dialog-->
</div> <!-- end modal-->

<script>
var content = $("#skfinder")
var start = $("#showskfinder")

function loaddir(cmd) {
  content.append(
    '<div style="background-color: #0000008c; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999;"><div id="status"><div class="bouncing-loader"><div></div><div></div><div></div></div></div></div>'
    )
  content.load('<?=base_url('admin/storage/')?>' + encodeURIComponent(cmd))
}

function setitem(file) {
  var ed = tinymce.activeEditor;
  var img = '<img src="' + file +
    '" alt="ilhamsk" style="border-radius:.25rem;">';
  ed.selection.setContent(img);
  $('#skfindershow').modal('hide');
}
</script>