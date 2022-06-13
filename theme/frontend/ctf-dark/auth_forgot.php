<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => $websettings->seo_title . ' Forgot',
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

              <?php if (isset($row)) {?>
              <form method="POST">
                <input type="hidden" name="tipe" value="kirim">
                <input type="hidden" name="id_users" value="<?=$row->id?>">
                <div class="user-card user-card-s2">
                  <div class="user-avatar md bg-primary">
                    <img src="<?=_storage("avatar/$row->avatar")?>"
                      onerror="this.onerror=null;this.src='<?=_storage('avatar/default.jpg')?>';"
                      alt="">
                    <div class="status dot dot-lg dot-warning"></div>
                  </div>
                  <div class="user-info">
                    <h6><?=$row->username?></h6>
                    <span class="sub-text"><?=$row->email?></span>
                  </div>
                  <small class="mt-2">Apakah ini akun kamu? jika iya lanjutkan
                    kirim reset password.</small>
                </div>
                <div class="form-group" id="btn">
                  <button type="submit"
                    class="btn btn-lg btn-primary btn-block">Kirim Email Reset
                    Password</button>
                </div>
              </form>
              <?php } else {?>
              <div class="nk-block-head">
                <div class="nk-block-head-content">
                  <h4 class="nk-block-title">Forgot Password</h4>
                </div>
              </div>
              <form method="POST">
                <input type="hidden" name="tipe" value="cari">
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label">Email or Username</label>
                  </div>
                  <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg"
                      name="usermail"
                      placeholder="Enter your email address or username"
                      required>
                  </div>
                </div>
                <div class="form-group" id="btn">
                  <button type="submit"
                    class="btn btn-lg btn-primary btn-block">Cari</button>
                </div>
              </form>
              <?php }?>
              <div class="form-note-s2 text-center pt-4">Sudah punya akun? <a
                  href="<?=base_url("auth/LOGIN")?>">Login</a>
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
  <?php require_once "include/script.php"?>
</body>

</html>