<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
  <?=meta_tag([
    'title'       => $websettings->seo_title . ' Verify Account',
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
  <link href="<?=_backEnd()?>css/icons.min.css" rel="stylesheet"
    type="text/css" />
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/skins/theme-blue.css">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/style.css">
</head>

<body class="nk-body dark-mode npc-general pg-auth">
  <div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
      <!-- wrap @s -->
      <div class="nk-wrap nk-wrap-nosidebar">
        <!-- content @s -->
        <div class="nk-content ">
          <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="card card-bordered">
              <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                  <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Verify Email</h5>
                    <div class="nk-block-des">
                      <p>Periksa Email <span
                          class="fw-bolder text-dark"><?=$us->email?></span>
                        untuk mendapatkan link pengaktifan akun ctf kamu, jika
                        tidak ada cek di bagian spam.</p>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <form method="POST">
                    <input type="hidden" name="token" value="ASULU">
                    <button type="submit"
                      class="btn btn-lg btn-primary btn-block">Resend
                      Email</button>
                  </form>
                </div>
                <div class="form-note-s2 text-center ">
                  <a
                    href="<?=base_url("auth/logout")?>"><strong>Logout</strong></a>
                </div>
              </div>
            </div>
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

</html>