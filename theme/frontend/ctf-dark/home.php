<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => "$websettings->seo_title Home",
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
    href="<?=_frontEnd($websettings->theme_active)?>css/libs/themify-icons.css">
  <link href="<?=_backEnd()?>css/icons.min.css" rel="stylesheet"
    type="text/css" />
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/skins/theme-<?=$custom_theme['primary_color']?>.css">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/style.css">
</head>

<body class="nk-body dark-mode" theme="dark">
  <div class="nk-app-root">
    <div class="nk-wrap ">

      <?php require_once "include/header.php"?>
      <div class="nk-content ">
        <div class="container-fluid">
          <div class="nk-content-inner">
            <div class="nk-content-body">
              <div class="card">
                <div class="card-body">
                  <div class="text-center">
                    <img
                      src="<?=str_replace("@", base_url("public/storage/"), $custom_theme['img'])?>">
                    <h5 class="mt-3"><?=$custom_theme['title']?></h5>
                    <small id="headingTyped"></small>
                    <p class="mt-4"><?=$custom_theme['description']?></p>
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

  <script
    src="<?=_frontEnd($websettings->theme_active)?>js/bundle.js?ver=2.9.0">
  </script>
  <script
    src="<?=_frontEnd($websettings->theme_active)?>js/scripts.js?ver=2.9.0">
  </script>
  <?php require_once "include/script.php"?>
  <script src="<?=_frontEnd($websettings->theme_active)?>js/typed.min.js" defer>
  </script>
  <script type="text/javascript">
  (function($) {
    'use strict';
    $(document).ready(function() {
      $(function() {
        $("#headingTyped").typed({
          strings: [<?=$custom_theme['typed']?>],
          typeSpeed: 1,
          backDelay: 2000,
          loop: true
        });
      });
    })
  }(jQuery))
  </script>
</body>

</html>