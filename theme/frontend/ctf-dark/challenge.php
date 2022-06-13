<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="velix-url" url="<?=base_url()?>">
  <?=meta_tag([
    'title'       => $websettings->seo_title . ' Challenge',
    'description' => $websettings->seo_description,
    'favicon'     => _storage($websettings->seo_favicon),
    'thumb'       => _storage($websettings->seo_thumbnail),
    'keywords'    => $websettings->seo_keywords,
    'url'         => base_url('challenge'),
    'author'      => '',
]);?>
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/dashlite.css">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/theme.css">
  <link id="skin-default" rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/libs/themify-icons.css">
  <link href="<?=_backEnd()?>css/icons.min.css" rel="stylesheet"
    type="text/css" />
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/skins/theme-<?=$custom_theme['primary_color']?>.css">
  <link rel="stylesheet"
    href="<?=_frontEnd($websettings->theme_active)?>css/style.css">
  <style>
  .dialog-scroll {
    overflow-y: initial !important
  }

  .body-scroll {
    height: 10vh;
    overflow-y: auto;
  }
  </style>
</head>

<body class="nk-body dark-mode" theme="dark">
  <div class="nk-app-root">
    <div class="nk-wrap ">

      <?php require_once "include/header.php"?>
      <div class="nk-content p-0">
        <div class="container-fluid p-0">
          <div class="nk-content-inner">
            <div class="nk-content-body">
              <div class="nk-ibx">
                <div class="nk-ibx-aside" data-content="inbox-aside"
                  data-toggle-overlay="true" data-toggle-screen="lg">
                  <div class="nk-ibx-head">
                    <h6 class="mb-0 title"><i class="ti-flag-alt-2"></i> CTF
                      Challenge</h6>
                  </div>
                  <div class="nk-ibx-nav" data-simplebar>
                    <ul class="nk-ibx-menu">
                      <li class="active">
                        <a class="nk-ibx-menu-item" href="javascript:void(0)"
                          onclick='getChall("by=all")'>
                          <em class="icon uil-apps"></em>
                          <span class="nk-ibx-menu-text">All Challenge</span>
                        </a>
                      </li>
                      <?php foreach ($category as $c): ?>
                      <li>
                        <a class="nk-ibx-menu-item" href="javascript:void(0)"
                          onclick='getChall("category=<?=$c->cate_slug?>")'>
                          <?="<i class='icon $c->cate_icon'></i>"?>
                          <span
                            class="nk-ibx-menu-text"><?="$c->cate_title"?></span>
                          <span
                            class="badge badge-pill badge-primary"><?=$this->front->countChallby($c->cate_id)?></span>
                        </a>
                      </li>
                      <?php endforeach;?>
                    </ul>
                    <div class="nk-ibx-nav-head">
                      <h6 class="title">Level</h6>
                    </div>
                    <ul class="nk-ibx-label">
                      <li>
                        <a class="nk-ibx-menu-item" href="javascript:void(0)"
                          onclick='getChall("level=easy")'>
                          <i class='icon uil-coffee'></i>
                          <span class="nk-ibx-menu-text">Easy</span>
                        </a>
                      </li>
                      <li>
                        <a class="nk-ibx-menu-item" href="javascript:void(0)"
                          onclick='getChall("level=normal")'>
                          <i class='icon uil-circle'></i>
                          <span class="nk-ibx-menu-text">Normal</span>
                        </a>
                      </li>
                      <li>
                        <a class="nk-ibx-menu-item" href="javascript:void(0)"
                          onclick='getChall("level=hard")'>
                          <i class='icon uil-pentagon'></i>
                          <span class="nk-ibx-menu-text">Hard</span>
                        </a>
                      </li>
                      <li>
                        <a class="nk-ibx-menu-item" href="javascript:void(0)"
                          onclick='getChall("level=expert")'>
                          <i class='icon uil-polygon'></i>
                          <span class="nk-ibx-menu-text">Expret</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="nk-ibx-body bg-white">
                  <div class="nk-ibx-head">
                    <div class="nk-ibx-head-actions">
                      <ul class="nk-ibx-head-tools g-1">
                        <li><a href="javascript:void(0)"
                            onclick='getChall("by=all")'
                            class="btn btn-icon btn-trigger"><em
                              class="icon ni ni-undo"></em></a></li>
                      </ul>
                    </div>
                    <div>
                      <ul class="nk-ibx-head-tools g-1">
                        <li class="mr-n1 d-lg-none"><a href="#"
                            class="btn btn-trigger btn-icon toggle"
                            data-target="inbox-aside"><em
                              class="icon ni ni-menu-alt-r"></em></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="nk-ibx-list p-2" id="area-chall">

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

  <div class="modal fade zoom" tabindex="-1" id="detailchall">
    <div class="modal-dialog dialog-scroll"
      style="width: 100%; max-width: none; height: 100%; margin: 0;"
      role="document">
      <div class="modal-content" style="min-height: 100%;" id="detail-content">

      </div>
    </div>
  </div>

  <script
    src="<?=_frontEnd($websettings->theme_active)?>js/bundle.js?ver=2.9.0">
  </script>
  <script
    src="<?=_frontEnd($websettings->theme_active)?>js/scripts.js?ver=2.9.0">
  </script>
  <script>
  var chall_area = $("#area-chall")
  var detail_area = $("#detail-content")
  var detail_chall = $("#detailchall")

  function getDetail(id) {
    detail_chall.modal('show')
    detail_area.html(
      '<div class="modal-header bg-light"><a href="#" class="close" data-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a></div><div class="modal-body pt-0"><div class="text-center"><div class="spinner-border text-primary m-5" role="status"><span class="sr-only">Loading...</span></div></div></div><div class="modal-footer bg-light"><span class="sub-text">Loading..</span></div>'
      );
    detail_area.load("<?=base_url("challenge/ajax/getdetail/")?>" + id)
    history.pushState({
      foo: "bar"
    }, "", "?get=" + id);
  }

  function getChall(par = '') {
    chall_area.html(
      '<div class="text-center"><div class="spinner-border text-primary m-5" role="status"><span class="sr-only">Loading...</span></div></div>'
      );
    if (par != '') {
      par = "?" + par;
    }
    history.pushState({
      foo: "bar"
    }, "", par);
    chall_area.load("<?=base_url("challenge/ajax/getchall")?>" + par)
  }

  <?php
            if ($this->input->get('category')) {
                echo 'getChall("category=' . $this->input->get('category') . '")
            ';
            } else if ($this->input->get('level')) {
                echo 'getChall("level=' . $this->input->get('level') . '")
            ';
            } else {
                echo 'getChall()
            ';
            }

            if ($this->input->get('get')) {
                echo 'getDetail("' . $this->input->get('get') . '")';
            }
        ?>
  </script>
  <?php require_once "include/script.php"?>
</body>

</html>