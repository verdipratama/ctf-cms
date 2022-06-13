<?php if (is_login(false)) {
        $ceksolved = $this->db->get_where('chall_history', ['id_chall' => $row->id, 'id_users' => $this->session->userdata('id_login')])->num_rows();
    ?>
<div class="modal-header bg-light">
  <h6 class="modal-title text-primary"><?=$row->title?></h6>
  <a href="#" class="close" data-dismiss="modal" aria-label="Close">
    <em class="icon ni ni-cross"></em>
  </a>
</div>
<div class="modal-body body-scroll pt-0">
  <ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#tabItem5"><em
          class="icon ti-flag-alt-2"></em><span>Chall</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tabItem6"><em
          class="icon ti-search"></em><span>Hint</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tabItem7"><em
          class="icon ti-check"></em><span>Solved</span></a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tabItem5">
      <p class="mb-0">Author : <?=$row->name?></p>
      <p class="mb-0">Created at : <?=$row->created_at?></p>
      <p class="mb-0">Category : <?=$row->cate_title?></p>
      <hr style="border-top: 1px solid #29374a !important;">
      <p class="mb-0"><?=$row->description?></p>
    </div>
    <div class="tab-pane" id="tabItem6">
      <?php if ($ceksolved == 0) {
                  $hint = $this->db->get_where("chall_hint", ['id_chall' => $row->id])->result();
                  foreach ($hint as $hh):
                      if ($this->db->get_where('hint_users', ['id_hint' => $hh->id, 'id_users' => $this->session->userdata('id_login')])->num_rows() == 0) {
                      ?>
      <button onclick='useHint("<?=$hh->id?>","<?=$hh->points?>")'
        class="btn btn-block btn-outline-primary mb-1 rounded-0">Hint For
        -<?=$hh->points?> Points</button>
      <?php } else {?>
      <button onclick='loadHint("<?=$hh->id?>")'
        class="btn btn-block btn-outline-secondary mb-1 rounded-0">Hint For
        -<?=$hh->points?> Points</button>
      <?php
                  }
                      endforeach;
              }?>
    </div>
    <div class="tab-pane" id="tabItem7">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            <th scope="col">DATE</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
              foreach ($solved->result() as $s): ?>
          <tr>
            <th scope="row"><?=$i++?></th>
            <td><a href="<?=base_url("users/$s->username")?>"><?=$s->name?></a>
            </td>
            <td><?=$s->created_at?></td>
          </tr>
          <?php endforeach?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php if ($ceksolved == 0) {?>
<form id="flag-submit">
  <div class="modal-footer bg-light p-0">
    <div class="input-group">
      <input type="text" name="flag" class="form-control rounded-0"
        placeholder="Enter Flag" required autocomplete="off">
      <input type="hidden" name="id_chall" required value="<?=$row->id?>">
      <div id="btn">
        <button class="btn btn-primary rounded-0" type="submit"
          id="button-addon2"><em class="icon ti-flag-alt-2"></em>
          Submit</button>
      </div>
    </div>
  </div>
</form>
<?php } else {?>
<div class="modal-footer bg-light p-1" style="justify-content: center;">
  <div class="btn btn-outline-success btn-sm">SOLVED</div>
</div>
<?php }?>
<!-- Modal Zoom -->
<div class="modal fade zoom" tabindex="-1" id="hint">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header p-2">
        <h6 class="title">Hint For <?=$row->title?></h6>
      </div>
      <div class="modal-body" id="hint-content">

      </div>
    </div>
  </div>
</div>

<script>
function loadHint(id) {
  $("#hint-content").html(
    '<div class="text-center"><div class="spinner-border text-primary m-5" role="status"><span class="sr-only">Loading...</span></div></div>'
  );
  $("#hint-content").load("<?=base_url("challenge/ajax/gethint/")?>" + id)
  $("#hint").modal("show");
}

function useHint(id, points) {
  Swal.fire({
    title: 'Pakai Hint?',
    text: "Membuka hint ini akan mengurangi -" + points +
      " points yang kamu miliki.",
    icon: 'info',
    showCancelButton: true,
    confirmButtonText: 'Ya'
  }).then(function(result) {
    if (result.value) {
      $("#hint-content").load("<?=base_url("challenge/usehint/")?>" + id)
      loadHint(id)
    }
  });
}

$("#flag-submit").submit(function(e) {
  $("#btn").html(
    '<button class="btn btn-primary rounded-0" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span> Loading... </span></button>'
  );
  e.preventDefault();
  $.ajax({
    url: '<?=base_url("challenge/ajax/flagsubmit")?>',
    type: 'post',
    data: $(this).serialize(),
    success: function(data) {
      if (data == 'benar') {
        "use strict";
        (function(NioApp, $) {
          'use strict';
          toastr.clear();
          NioApp.Toast('Flag Benar.', 'success', {
            position: 'top-center'
          });
        })(NioApp, jQuery);
        getDetail("<?=$row->id?>")
      } else {
        document.getElementById("flag-submit").reset();
        "use strict";
        (function(NioApp, $) {
          'use strict';
          toastr.clear();
          NioApp.Toast(data, 'error', {
            position: 'top-center'
          });
        })(NioApp, jQuery);
      }
      $("#btn").html(
        '<button class="btn btn-primary rounded-0" type="submit" id="button-addon2"><em class="icon ti-flag-alt-2"></em> Submit</button>'
      );
    }
  });
});
</script>

<?php } else {?>
<div class="modal-header bg-light">
  <h6 class="modal-title">Login</h6>
  <a href="#" class="close" data-dismiss="modal" aria-label="Close">
    <em class="icon ni ni-cross"></em>
  </a>
</div>
<div class="modal-body pt-0 text-center">
  <h5 class="mt-5 mb-3">LOGIN TERLEBIH DAHULU</h5>
  <a href="<?=base_url("auth/login")?>" class="btn btn-primary">LOGIN</a>
</div>
<?php }?>