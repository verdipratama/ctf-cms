<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => "$websettings->seo_title Users",
    'description' => $websettings->seo_description,
    'favicon'     => _storage($websettings->seo_favicon),
    'thumb'       => _storage($websettings->seo_thumbnail),
    'keywords'    => $websettings->seo_keywords,
    'url'         => base_url('users'),
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
              <div class="text-center mb-3">
                <h5 class="title">USERS CTF</h5>
                <small class="title">Menampikan Users yang terdaftar.</small>
              </div>
              <div class="row g-2">
                <?php foreach ($users as $r): ?>
                <div class="col-6 col-xxl-2 col-xl-2 col-lg-2 col-md-3">
                  <a href="<?=base_url("users/$r->username")?>">
                    <div class="card  p-1 text-center">
                      <img src="<?=_storage("avatar/$r->avatar")?>"
                        onerror="this.onerror=null;this.src='<?=_storage('avatar/default.jpg')?>';"
                        class="card-img">
                      <div class="p-1">
                        <div class="fw-bold text-muted"><?=$r->name?></div>
                        <span class="nk-ibx-menu-text"><i
                            class="ti-flag-alt-2"></i>
                          <?=format_number($r->points_asli)?></span>
                      </div>
                    </div>
                  </a>
                </div>
                <?php endforeach?>
              </div>
              <nav class="w-100 d-flex justify-content-center">
                <?=$this->pagination->create_links()?>
              </nav>
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