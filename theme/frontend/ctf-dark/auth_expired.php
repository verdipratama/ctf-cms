<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
  <?=meta_tag([
    'title'       => 'Expired Token',
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
                  <div class="nk-block-head-content text-center">
                    <h5 class="nk-block-title">Expired Token</h5>
                    <div class="nk-block-des">
                      <p>Token tidak bisa di gunakan.</p>
                    </div>
                  </div>
                </div>
                <div class="form-note-s2 text-center ">
                  <a href="<?=base_url()?>"><strong>Home</strong></a>
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