<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => $websettings->seo_title . "- Update Password",
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
      <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
          <div class="card">
            <div class="card-inner card-inner-lg">
              <div class="nk-block-head">
                <div class="nk-block-head-content">
                  <h4 class="nk-block-title">Update Password</h4>
                </div>
              </div>
              <form method="POST">
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label" for="password">New
                      Password</label>
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
                      name="password" placeholder="Enter New Password" required
                      minlength="5">
                  </div>
                </div>
                <div class="form-group" id="btn">
                  <button type="submit"
                    class="btn btn-lg btn-primary btn-block">Update
                    Password</button>
                </div>
              </form>
              <div class="form-note-s2 text-center pt-4"> Login account? <a
                  href="<?=base_url("auth/login")?>">Login</a>
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
</body>

</html>