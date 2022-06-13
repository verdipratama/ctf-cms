<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => $websettings->seo_title . ' REGISTER',
    'description' => $websettings->seo_description,
    'favicon'     => _storage($websettings->seo_favicon),
    'thumb'       => _storage($websettings->seo_thumbnail),
    'keywords'    => $websettings->seo_keywords,
    'url'         => base_url(),
    'author'      => '',
]);?>
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/dashlite.css?ver=2.9.0">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/theme.css?ver=2.9.0">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/style.css">
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/skins/theme-blue.css">
  <link href="<?=_backEnd()?>css/icons.min.css" rel="stylesheet"
    type="text/css" />
</head>

<body class="nk-body dark-mode" theme="dark">
  <div class="nk-app-root">
    <div class="nk-wrap nk-wrap-nosidebar">

      <?php require_once "include/header.php"?>
      <!-- <div class="nk-content ">
                <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                    <div class="card">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">REGISTER</h4>
                                </div>
                            </div>
                            <form id="form-login">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label">Full Name</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" name="name" placeholder="Nama akun yang ditampilkan" value="<?=$this->session->flashdata("val_name")?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label">Email</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control form-control-lg" name="email" placeholder="Email digunakan untuk verifikasi dan lainya" value="<?=$this->session->flashdata("val_email")?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label">Username</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Username untuk login" value="<?=$this->session->flashdata("val_username")?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label">Password</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" name="password" placeholder="Password untuk login" required>
                                    </div>
                                </div>
                                <div class="form-group" id="btn">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                                </div>
                            </form>
                            <div class="form-note-s2 text-center pt-4"> Tidak punya akun? <a href="<?=base_url("auth/register")?>">Buat akun</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

      <!-- content @s -->
      <div class="nk-content ">
        <div class="nk-split nk-split-page nk-split-md">
          <div
            class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
              <a href="#" class="toggle btn btn-white btn-icon btn-light"
                data-target="athPromo"><em class="icon ni ni-info"></em></a>
            </div>
            <div class="nk-block nk-block-middle nk-auth-body">
              <div class="nk-block-head">
                <div class="nk-block-head-content">
                  <h5 class="nk-block-title">Register</h5>
                  <div class="nk-block-des">
                    <p>Create New <?=$websettings->seo_title?> Account</p>
                  </div>
                </div>
              </div>
              <form method="POST">
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label">Full Name</label>
                  </div>
                  <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg"
                      name="name" placeholder="Nama akun yang ditampilkan"
                      value="<?=$this->session->flashdata("val_name")?>"
                      required autocomplete="off" minlength="4">
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label">Email</label>
                  </div>
                  <div class="form-control-wrap">
                    <input type="email" class="form-control form-control-lg"
                      name="email"
                      placeholder="Email digunakan untuk verifikasi dan lainya"
                      value="<?=$this->session->flashdata("val_email")?>"
                      required autocomplete="off">
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label">Username</label>
                  </div>
                  <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg"
                      name="username" id="input_username"
                      placeholder="Username untuk login"
                      value="<?=$this->session->flashdata("val_username")?>"
                      required autocomplete="off" minlength="4">
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label">Password</label>
                  </div>
                  <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg"
                      name="password" placeholder="Password untuk login"
                      required autocomplete="off" minlength="5">
                  </div>
                </div>
                <div class="form-group" id="btn">
                  <button type="submit"
                    class="btn btn-lg btn-primary btn-block">Register</button>
                </div>
              </form>
              <div class="form-note-s2 pt-4"> Already have an account ? <a
                  href="<?=base_url("auth/login")?>"><strong>Sign in
                    instead</strong></a>
              </div>
            </div>
          </div>
          <div
            class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right"
            data-content="athPromo" data-toggle-screen="lg"
            data-toggle-overlay="true">
            <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
              <div class="slider-init"
                data-slick='{"dots":true, "arrows":false}'>
                <div class="slider-item">
                  <div class="nk-feature nk-feature-center">
                    <div class="nk-feature-content py-4 p-sm-5">
                      <h4><?=$websettings->seo_title?></h4>
                      <p><?=$websettings->seo_description?></p>
                    </div>
                  </div>
                </div><!-- .slider-item -->
              </div><!-- .slider-init -->
            </div><!-- .slider-wrap -->
          </div><!-- nk-split-content -->
        </div><!-- nk-split -->
      </div>
      <!-- wrap @e -->
    </div>
  </div>
  <?php require_once "include/footer.php"?>
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
  $("#input_username").keyup(function() {
    var username = validateUserName($("#input_username").val())
    $("#input_username").val(username)
  })

  function validateUserName(username) {
    return username.toLowerCase()
      .replace(/ /g, '-')
      .replace(/[^\w-]+/g, '');
  }
  </script>
</body>

</html>