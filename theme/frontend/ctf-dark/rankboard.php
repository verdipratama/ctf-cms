<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => "$websettings->seo_title Rankboard",
    'description' => $websettings->seo_description,
    'favicon'     => _storage($websettings->seo_favicon),
    'thumb'       => _storage($websettings->seo_thumbnail),
    'keywords'    => $websettings->seo_keywords,
    'url'         => base_url('rankboard'),
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
                <h5 class="title">TOP 100 CTF</h5>
                <small class="title">Menampikan 100 User yang memiliki Skor /
                  Point tertinggi</small>
              </div>
              <div class="row g-2">
                <?php
                                    $i = 1;
                                foreach ($rank as $r): ?>
                <div class="col-6 col-xxl-2 col-xl-2 col-lg-2 col-md-3">
                  <a href="<?=base_url("users/$r->username")?>">
                    <div class="card  p-1 text-center">
                      <?php if ($i == 1) {
                                                        echo '<h6 class="title text-warning"><i class="ti-crown"></i> <br>' . $i . '</h6>';
                                                    } else if ($i == 2) {
                                                        echo '<h6 class="title text-secondary"><i class="ti-crown"></i> <br>' . $i . '</h6>';
                                                    } else if ($i == 3) {
                                                        echo '<h6 class="title"><i class="ti-crown"></i> <br> ' . $i . '</h6>';
                                                    } else {
                                                        echo '<h6 class="title"><i class="ti-medall-alt"></i> <br>' . $i . '</h6>';
                                                    }
                                                ?>
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
                <?php
                                    $i++;
                                endforeach?>
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