<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => $websettings->seo_title . ' LOGIN',
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
    <div class="nk-wrap ">

      <?php require_once "include/header.php"?>
      <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
          <div class="card">
            <div class="card-inner card-inner-lg">
              <div class="nk-block-head">
                <div class="nk-block-head-content">
                  <h4 class="nk-block-title">Login</h4>
                </div>
              </div>
              <form id="form-login">
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label">Email or Username</label>
                  </div>
                  <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg"
                      name="username"
                      placeholder="Enter your email address or username"
                      required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label" for="password">Password</label>
                    <a class="link link-primary link-sm"
                      href="<?=base_url("auth/forgot")?>">Lupa Password?</a>
                  </div>
                  <div class="form-control-wrap">
                    <a href="#"
                      class="form-icon form-icon-right passcode-switch lg"
                      data-target="password">
                      <em class="passcode-icon icon-show icon ni ni-eye"></em>
                      <em
                        class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg"
                      name="password" placeholder="Enter your password"
                      required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-control-sm custom-checkbox">
                    <input type="checkbox" checked class="custom-control-input"
                      name="remember">
                    <label class="custom-control-label" for="checkbox">Remember
                      Me</label>
                  </div>
                </div>
                <div class="form-group" id="btn">
                  <button type="submit"
                    class="btn btn-lg btn-primary btn-block">Login</button>
                </div>
              </form>
              <div class="form-note-s2 text-center pt-4"> Tidak punya akun? <a
                  href="<?=base_url("auth/register")?>">Buat akun</a>
              </div>
            </div>
          </div>
        </div>
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
  <script>
  $(document).ready(function() {
    $("#form-login").submit(function(e) {
      $("#btn").html(
        '<button class="btn btn-lg btn-primary btn-block" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span> Loading... </span></button>'
        );
      e.preventDefault();
      $.ajax({
        url: '<?=base_url("auth/login")?>',
        type: 'post',
        data: $(this).serialize(),
        success: function(data) {
          if (data == 'berhasil') {
            "use strict";
            (function(NioApp, $) {
              'use strict';
              toastr.clear();
              NioApp.Toast(
                'Berhasil login, tunggu sedang redirect.',
                'success', {
                  position: 'top-center'
                });
            })(NioApp, jQuery);
            window.location = "<?=base_url()?>";
          } else {
            document.getElementById("form-login").reset();
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
            '<button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>'
            );
        }
      });
    });
  })
  </script>
  <?php require_once "include/script.php"?>
</body>

</html>