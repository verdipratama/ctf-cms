<script src="<?=_backEnd()?>tinymce/tinymce.min.js"></script>
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
          <div class="d-flex justify-content-end">
            <button class="btn btn-primary" type="submit"><i
                class="uil-enter"></i> Update User</button>
          </div>
          <div class="d-flex justify-content-center my-2">
            <label class="avatar-lg" style="cursor: pointer;">
              <img id="output" src="<?=_storage("avatar/$row->avatar")?>" alt=""
                class="rounded-circle img-thumbnail"
                style="width: 100px; height: 95px;">
              <input type="file" name="avatar" accept="image/*"
                onchange="loadFile(event)" style="display: none;">
            </label>
          </div>
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="name"
              value="<?=$row->name?>" placeholder="Full Name" required
              autocomplete="off">
          </div>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username"
              value="<?=$row->username?>" placeholder="Full Name" required
              autocomplete="off">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email"
              value="<?=$row->email?>" placeholder="Email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" name="password"
              placeholder="Password">
            <small>Leave it blank if you don't want to change the
              password.</small>
          </div>
          <div class="mb-3">
            <label for="example-select" class="form-label">Role</label>
            <select class="form-select" name="role" id="example-select">
              <option value="admin"
                <?=($row->role == 'admin') ? "selected" : ''?>>Admin</option>
              <option value="user"
                <?=($row->role == 'user') ? "selected" : ''?>>User</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="example-select" class="form-label">Status</label>
            <select class="form-select" name="status" id="example-select">
              <option value="inactive"
                <?=($row->status == 'inactive') ? "selected" : ''?>>inactive
              </option>
              <option value="active"
                <?=($row->status == 'active') ? "selected" : ''?>>active
              </option>
              <option value="banned"
                <?=($row->status == 'banned') ? "selected" : ''?>>banned
              </option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Points</label>
            <input type="number" class="form-control" name="points"
              value="<?=$row->points?>" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label class="form-label">Hint Points</label>
            <input type="number" class="form-control" name="points_hint"
              value="<?=$row->points_hint?>" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea name="bio" class="form-control"
              rows="10"><?=$row->bio?></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?=_backEnd()?>js/vendor.min.js"></script>
<script src="<?=_backEnd()?>js/app.min.js"></script>
<script>
var loadFile = function(event) {
  var output = document.getElementById('output');
  output.src = URL.createObjectURL(event.target.files[0]);
};
</script>