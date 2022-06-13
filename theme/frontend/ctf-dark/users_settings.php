<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => "$row->name- Settings",
    'description' => 'Users Profile Capture The Flag.',
    'favicon'     => _storage($websettings->seo_favicon),
    'thumb'       => _storage("avatar/$row->avatar"),
    'keywords'    => $websettings->seo_keywords,
    'url'         => base_url("users/$row->username"),
    'author'      => '',
]);?>
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/dashlite.css?ver=2.9.0">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/theme.css?ver=2.9.0">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/libs/themify-icons.css">
  <link href="<?=_backEnd()?>css/icons.min.css" rel="stylesheet"
    type="text/css" />
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/skins/theme-<?=$custom_theme['primary_color']?>.css">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
  <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
  <script src="https://unpkg.com/dropzone"></script>
  <script src="https://unpkg.com/cropperjs"></script>
  <style>
  .profilepic {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 2%;
    overflow: hidden;
  }

  .profilepic:hover .profilepic__content {
    opacity: 1;
  }

  .profilepic:hover .profilepic__image {
    opacity: .5;
  }

  .profilepic__image {
    object-fit: cover;
    opacity: 1;
    transition: opacity .2s ease-in-out;
  }

  .profilepic__content {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    opacity: 0;
    transition: opacity .2s ease-in-out;
  }

  .profilepic__icon {
    color: white;
    padding-bottom: 8px;
  }

  .gallery-avatar:focus {
    border-color: #fff;
  }
  </style>
</head>

<body class="nk-body dark-mode" theme="dark">
  <div class="nk-app-root">
    <div class="nk-wrap ">

      <?php require_once "include/header.php"?>
      <div class="nk-content ">
        <div class="container">
          <div class="nk-content-inner">
            <div class="nk-content-body">
              <div class="nk-block">
                <div class="card card-bordered">
                  <div class="card-content">
                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                      <li class="nav-item">
                        <a class="nav-link"
                          href="<?=base_url("users/$row->username")?>"><em
                            class="icon ni ni-user-circle"></em><span>Personal</span></a>
                      </li>
                      <?php if (is_login(false)) {
                              if ($this->session->userdata('id_login') == $row->id) {
                              ?>
                      <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0)"><em
                            class="icon ti-settings"></em><span>Settings</span></a>
                      </li>
                      <?php }
                      }?>
                    </ul>
                    <div class="card card-body">
                      <div class="row">
                        <div class="col-12 col-xxl-3 col-xl-3 col-lg-3">
                          <div class="d-flex justify-content-center mb-2">
                            <div class="">
                              <div class="dropdown">
                                <a class="dropdown-toggle profilepic"
                                  href="javascript:void(0)"
                                  data-toggle="dropdown">
                                  <img
                                    src="<?=_storage("avatar/$row->avatar")?>"
                                    onerror="this.onerror=null;this.src='<?=_storage('avatar/default.jpg')?>';"
                                    id="uploaded_image"
                                    class="profilepic__image" />
                                  <div class="profilepic__content">
                                    <span class="profilepic__icon"><i
                                        class="ti-gallery"></i></span>
                                  </div>
                                </a>
                                <div class="dropdown-menu">
                                  <ul class="link-list-opt no-bdr">
                                    <li><a href="javascript:void(0)">
                                        <label for="upload_image" class="m-0">
                                          <em class="icon ti-upload mr-2"></em>
                                          <span>Upload Avatar</span>
                                          <input type="file" name="image"
                                            class="image" id="upload_image"
                                            style="display:none">
                                        </label>
                                      </a>
                                    </li>
                                    <li><a href="javascript:void(0)"
                                        data-toggle="modal"
                                        data-target="#modalavatar"><em
                                          class="icon ti-gallery"></em><span>Change
                                          Avatar</span></a></li>
                                  </ul>

                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <form action="" method="post">
                            <div class="form-group">
                              <label class="form-label"
                                for="default-03">Name</label>
                              <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                  <em class="icon ni ni-user"></em>
                                </div>
                                <input type="text" class="form-control"
                                  value="<?=$row->name?>" name="name"
                                  id="default-03" placeholder="Enter Name"
                                  required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label"
                                for="default-03">Bio</label>
                              <div class="form-control-wrap">
                                <textarea class="form-control" name="bio"
                                  placeholder="Bio"><?=$row->bio?></textarea>
                              </div>
                            </div>
                            <div class="d-flex justify-content-end">
                              <button class="btn btn-primary" type="submit">Save
                                Change</button>
                            </div>
                          </form>
                          <hr style="border-top: 1px solid #29374a !important;">
                          <div class="nk-block">
                            <div class="card card-bordered">
                              <div class="card-inner-group">
                                <div class="card-inner">
                                  <div
                                    class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="nk-block-text">
                                      <h6>Change Email</h6>
                                      <p>Ganti Email lama ke email baru.</p>
                                    </div>
                                    <div
                                      class="nk-block-actions flex-shrink-sm-0">
                                      <ul
                                        class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                        <li class="order-md-last">
                                          <a href="javascript:void(0)"
                                            data-toggle="modal"
                                            data-target="#modachangeemail"
                                            class="btn btn-primary">Change
                                            Email</a>
                                        </li>
                                        <li>
                                          <em
                                            class="text-soft text-date fs-12px"><?=$row->email?></em>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="card-inner">
                                  <div class="between-center flex-wrap g-3">
                                    <div class="nk-block-text">
                                      <h6>Change Username</h6>
                                      <p>Ganti username lama ke yang baru.</p>
                                    </div>
                                    <div
                                      class="nk-block-actions flex-shrink-sm-0">
                                      <ul
                                        class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                        <li class="order-md-last">
                                          <a href="javascript:void(0)"
                                            data-toggle="modal"
                                            data-target="#modachangeusername"
                                            class="btn btn-primary">Change
                                            Username</a>
                                        </li>
                                        <li>
                                          <em
                                            class="text-soft text-date fs-12px"><?=$row->username?></em>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                  <div
                                    class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="nk-block-text">
                                      <h6>Change Password</h6>
                                      <p>Ganti Password lama ke yang baru.</p>
                                    </div>
                                    <div
                                      class="nk-block-actions flex-shrink-sm-0">
                                      <ul
                                        class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                        <li class="order-md-last">
                                          <a href="javascript:void(0)"
                                            data-toggle="modal"
                                            data-target="#modachangepass"
                                            class="btn btn-primary">Change
                                            Password</a>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div><!-- .card-inner -->
                              </div><!-- .card-inner-group -->
                            </div><!-- .card -->
                          </div><!-- .nk-block -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require_once "include/footer.php"?>
    </div>
  </div>

  <div class="modal fade zoom" tabindex="-1" id="modachangepass">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Password</h5>
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
        </div>
        <form id="changepassword">
          <div class="modal-body">
            <div id="alertpass">

            </div>
            <div class="form-group">
              <label class="form-label" for="default-03">Old Password</label>
              <div class="form-control-wrap">
                <div class="form-icon form-icon-left">
                  <em class="icon ni ni-lock"></em>
                </div>
                <input type="text" class="form-control" name="old_password"
                  id="default-03" placeholder="*******" required>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label" for="default-03">New Password</label>
              <div class="form-control-wrap">
                <div class="form-icon form-icon-left">
                  <em class="icon ni ni-lock"></em>
                </div>
                <input type="text" class="form-control" name="new_password"
                  id="default-03" placeholder="*******" required minlength="5">
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light p-1 btn-save">
            <button type="submit" class="btn btn-primary">Save Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade zoom" tabindex="-1" id="modachangeemail">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Email</h5>
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
        </div>
        <form id="changeemail">
          <div class="modal-body">
            <div class="form-group">
              <label class="form-label" for="default-03">New Email</label>
              <div class="form-control-wrap">
                <div class="form-icon form-icon-left">
                  <em class="icon ni ni-mail"></em>
                </div>
                <input type="email" class="form-control" name="new_email"
                  placeholder="Masukan email baru" required>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label" for="default-03">Password</label>
              <div class="form-control-wrap">
                <div class="form-icon form-icon-left">
                  <em class="icon ni ni-lock"></em>
                </div>
                <input type="text" class="form-control" name="password"
                  id="default-03" placeholder="*******" required>
                <small>Untuk keperluan keamanan, masukan password.</small>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light p-1 btn-save">
            <button type="submit" class="btn btn-primary">Save Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade zoom" tabindex="-1" id="modachangeusername">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Username</h5>
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
        </div>
        <form id="changeusername">
          <div class="modal-body">
            <div class="form-group">
              <label class="form-label" for="default-03">New Username</label>
              <div class="form-control-wrap">
                <div class="form-icon form-icon-left">
                  <em class="icon ni ni-user"></em>
                </div>
                <input type="text" class="form-control" name="new_username"
                  id="input_username" placeholder="Masukan username baru"
                  required>
                <small>Gunakan - untuk mengganti spasi, dan hanya di bolehkan
                  huruf kecil semua.</small>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light p-1 btn-save">
            <button type="submit" class="btn btn-primary">Save Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade zoom" tabindex="-1" id="modalavatar">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Avatar</h5>
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
        </div>
        <div class="modal-body" id="content-galleryavatar">
          <div class="row g-1">
            <div
              class="col-6 col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-ssm-3">
              <a onclick='changeAvatar("default.jpg")'
                href="javascript:void(0)">
                <div class="card card-bordered mb-2">
                  <img class="rounded"
                    src="<?=_storage("avatar/default.jpg")?>">
                </div>
              </a>
            </div>
            <?php foreach ($galleryavatar as $ga): ?>
            <div
              class="col-6 col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-ssm-3">
              <a onclick='changeAvatar("default/<?=$ga?>")'
                href="javascript:void(0)">
                <div class="card card-bordered mb-2">
                  <img class="rounded"
                    src="<?=_storage("avatar/default/$ga")?>">
                </div>
              </a>
            </div>
            <?php endforeach?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade zoom" tabindex="-1" id="modalupavatar">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Uplaod Avatar</h5>
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
        </div>
        <div class="modal-body">
          <div class="card">
            <img class="card-img" src="" id="sample_image">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-dismiss="modal">Cancel</button>
          <div class="btn-save">
            <button type="button" class="btn btn-primary" id="crop">Crop &
              Change</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script
    src="<?=_frontEnd($websettings->theme_active)?>js/bundle.js?ver=2.9.0">
  </script>
  <script
    src="<?=_frontEnd($websettings->theme_active)?>js/scripts.js?ver=2.9.0">
  </script>
  <?php require_once "include/script.php"?>
  <script>
  $("#changepassword").submit(function(e) {
    $(".btn-save").html(
      '<button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span> Loading... </span></button>'
    );
    e.preventDefault();
    $.ajax({
      url: '<?=base_url("users/ajax/changepassword")?>',
      type: 'post',
      data: $(this).serialize(),
      success: function(data) {
        if (data == 'berhasil') {
          location.reload();
        } else {
          "use strict";
          (function(NioApp, $) {
            'use strict';
            toastr.clear();
            NioApp.Toast(data, 'error', {
              position: 'top-center'
            });
          })(NioApp, jQuery);
        }
        $(".btn-save").html(
          '<button type="submit" class="btn btn-primary">Save Change</button>'
        );
      }
    });
  })

  $("#changeusername").submit(function(e) {
    $(".btn-save").html(
      '<button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span> Loading... </span></button>'
    );
    e.preventDefault();
    $.ajax({
      url: '<?=base_url("users/ajax/changeusername")?>',
      type: 'post',
      data: $(this).serialize(),
      success: function(data) {
        if (data == 'berhasil') {
          location.reload();
        } else {
          "use strict";
          (function(NioApp, $) {
            'use strict';
            toastr.clear();
            NioApp.Toast(data, 'error', {
              position: 'top-center'
            });
          })(NioApp, jQuery);
        }
        $(".btn-save").html(
          '<button type="submit" class="btn btn-primary">Save Change</button>'
        );
      }
    });
  })

  $("#changeemail").submit(function(e) {
    $(".btn-save").html(
      '<button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span> Loading... </span></button>'
    );
    e.preventDefault();
    $.ajax({
      url: '<?=base_url("users/ajax/changeemail")?>',
      type: 'post',
      data: $(this).serialize(),
      success: function(data) {
        if (data == 'berhasil') {
          location.reload();
        } else {
          "use strict";
          (function(NioApp, $) {
            'use strict';
            toastr.clear();
            NioApp.Toast(data, 'error', {
              position: 'top-center'
            });
          })(NioApp, jQuery);
        }
        $(".btn-save").html(
          '<button type="submit" class="btn btn-primary">Save Change</button>'
        );
      }
    });
  })

  $("#input_username").keyup(function() {
    var username = validateUserName($("#input_username").val())
    $("#input_username").val(username)
  })

  function validateUserName(username) {
    return username.toLowerCase()
      .replace(/ /g, '-')
      .replace(/[^\w-]+/g, '');
  }

  function changeAvatar(filename) {
    if (filename == "<?=$row->avatar?>") {
      "use strict";
      (function(NioApp, $) {
        'use strict';
        toastr.clear();
        NioApp.Toast('Avatar sudah kamu gunakan.', 'info', {
          position: 'top-center'
        });
      })(NioApp, jQuery);
    } else {
      $("#content-galleryavatar").html(
        '<div class="text-center"><div class="spinner-border text-primary m-5" role="status"><span class="sr-only">Loading...</span></div></div>'
      )
      $.ajax({
        url: '<?=base_url("users/ajax/changeavatar")?>',
        type: 'post',
        data: {
          avatar: filename
        },
        success: function(data) {
          if (data == 'berhasil') {
            location.reload();
          } else {
            "use strict";
            (function(NioApp, $) {
              'use strict';
              toastr.clear();
              NioApp.Toast(data, 'error', {
                position: 'top-center'
              });
            })(NioApp, jQuery);
          }
        }
      });
    }
  }

  var $modal = $('#modalupavatar');
  var image = document.getElementById('sample_image');
  var cropper;
  $('#upload_image').change(function(event) {
    var files = event.target.files;
    var done = function(url) {
      image.src = url;
      $modal.modal('show');
    };

    if (files && files.length > 0) {
      reader = new FileReader();
      reader.onload = function(event) {
        done(reader.result);
      };
      reader.readAsDataURL(files[0]);
    }
  });

  $modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 3,
      preview: '.preview'
    });
  }).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
  });

  $("#crop").click(function() {
    $(".btn-save").html(
      '<button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span> Loading... </span></button>'
    );
    canvas = cropper.getCroppedCanvas({
      width: 400,
      height: 400,
    });

    canvas.toBlob(function(blob) {
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function() {
        var base64data = reader.result;
        $.ajax({
          url: "<?=base_url("users/ajax/uploadavatar")?>",
          method: "POST",
          data: {
            image: base64data
          },
          success: function(data) {
            if (data == 'kesalahan') {
              "use strict";
              (function(NioApp, $) {
                'use strict';
                toastr.clear();
                NioApp.Toast('Terjadi kesalahan, coba lagi.',
                  'error', {
                    position: 'top-center'
                  });
              })(NioApp, jQuery);
            } else if (data == "notlogin") {
              "use strict";
              (function(NioApp, $) {
                'use strict';
                toastr.clear();
                NioApp.Toast('Sessi anda hilang.', 'error', {
                  position: 'top-center'
                });
              })(NioApp, jQuery);
            } else {
              $('#uploaded_image').attr('src', data);
              "use strict";
              (function(NioApp, $) {
                'use strict';
                toastr.clear();
                NioApp.Toast('Berhasil Upload Avatar.',
                  'success', {
                    position: 'top-center'
                  });
              })(NioApp, jQuery);
            }
            $modal.modal('hide');
            $(".btn-save").html(
              '<button type="button" class="btn btn-primary" id="crop">Crop & Change</button>'
            );
          }
        });
      }
    });
  });
  </script>
</body>

</html>