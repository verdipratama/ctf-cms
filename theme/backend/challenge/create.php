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
          <div class="row">
            <div class="col-12 col-xxl-6 col-xl-6 col-lg-6 col-md-6">
              <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value=""
                  placeholder="Title Challenge" required>
              </div>
            </div>
            <div class="col-12 col-xxl-6 col-xl-6 col-lg-6 col-md-6">
              <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-control" name="status" required>
                  <option value="1">Publish</option>
                  <option value="0">Draft</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-xxl-6 col-xl-6 col-lg-6 col-md-6">
              <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-control" name="category" required>
                  <?php foreach ($category as $c): ?>
                  <option value="<?=$c->cate_id?>"><?=$c->cate_title?></option>
                  <?php endforeach?>
                </select>
              </div>
            </div>
            <div class="col-12 col-xxl-6 col-xl-6 col-lg-6 col-md-6">
              <div class="mb-3">
                <label class="form-label">Level</label>
                <select class="form-control" name="level" required>
                  <option value="easy">Easy</option>
                  <option value="normal">Normal</option>
                  <option value="hard">Hard</option>
                  <option value="expert">Expert</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-xxl-6 col-xl-6 col-lg-6 col-md-6">
              <div class="mb-3">
                <label class="form-label">Flag</label>
                <input type="text" class="form-control seo_input" name="flag"
                  value="" placeholder="Flag" required>
              </div>
            </div>
            <div class="col-12 col-xxl-6 col-xl-6 col-lg-6 col-md-6">
              <div class="mb-3">
                <label class="form-label">Score</label>
                <input type="number" class="form-control seo_input" name="score"
                  value="" placeholder="Score Challenge" required>
              </div>
            </div>
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