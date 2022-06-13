<script>
<?php if ($this->session->flashdata("success")) {?>
  "use strict";
(function(NioApp, $) {
  'use strict';
  toastr.clear();
  NioApp.Toast('<?=$this->session->flashdata("success")?>', 'success', {
    position: 'top-center'
  });
})(NioApp, jQuery);
<?php } else if ($this->session->flashdata("error")) {?>
  "use strict";
(function(NioApp, $) {
  'use strict';
  toastr.clear();
  NioApp.Toast('<?=$this->session->flashdata("error")?>', 'error', {
    position: 'top-center'
  });
})(NioApp, jQuery);
<?php }?>

function loadMyProfile() {
  $("#myprofile-header").html(
    '<div class="text-center m-5"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
  )
  $("#myprofile-header").load('<?=base_url("users/ajax/getmyprofile")?>')
}
</script>