<div class="nk-header is-light">
  <div class="container-fluid">
    <div class="nk-header-wrap">
      <div class="nk-menu-trigger mr-sm-2 d-lg-none">
        <a href="#" class="nk-nav-toggle nk-quick-nav-icon"
          data-target="headerNav"><em class="icon ni ni-menu"></em></a>
      </div>
      <div class="nk-header-brand">
        <a href="<?=base_url()?>" class="logo-link">
          <img class="logo-light logo-img"
            src="<?=_storage($websettings->site_logo)?>"
            srcset="<?=_storage($websettings->site_logo)?>" alt="logo">
          <img class="logo-dark logo-img"
            src="<?=_storage($websettings->site_logo)?>"
            srcset="<?=_storage($websettings->site_logo)?>" alt="logo-dark">
        </a>
      </div><!-- .nk-header-brand -->
      <div class="nk-header-menu ml-auto" data-content="headerNav">
        <div class="nk-header-mobile">
          <div class="nk-header-brand">
            <a href="<?=base_url()?>" class="logo-link">
              <img class="logo-light logo-img"
                src="<?=_storage($websettings->site_logo)?>"
                srcset="<?=_storage($websettings->site_logo)?>" alt="logo">
              <img class="logo-dark logo-img"
                src="<?=_storage($websettings->site_logo)?>"
                srcset="<?=_storage($websettings->site_logo)?>" alt="logo-dark">
            </a>
          </div>
          <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon"
              data-target="headerNav"><em
                class="icon ni ni-arrow-left"></em></a>
          </div>
        </div>
        <ul class="nk-menu nk-menu-main ui-s2">
          <?php
              foreach ($menus as $m):
                  if ($m->type == 'direct') {
                      echo '<li class="nk-menu-item"><a href="' . base_url($m->link) . '" class="nk-menu-link"><span class="nk-menu-text">' . $m->title . '</span></a></li>';
                  } else if ($m->type == 'dropdown') {
                  echo '<li class="nk-menu-item has-sub">';
                  echo '<a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text">' . $m->title . '</span></a>';
                  echo '<ul class="nk-menu-sub">';
                  $sub = $this->db->get_where('site_menus', ['type' => 'submenu', 'sub_id' => $m->id])->result();
                  foreach ($sub as $s) {
                      echo '<li class="nk-menu-item"><a href="' . base_url($s->link) . '" class="nk-menu-link"><span class="nk-menu-text">' . $s->title . '</span></a></li>';
                  }
                  echo '</ul>';
                  echo '</li>';
              }
              endforeach
          ?>
        </ul><!-- .nk-menu -->
      </div><!-- .nk-header-menu -->
      <div class="nk-header-tools">
        <ul class="nk-quick-nav">
          <li class="dropdown user-dropdown">
            <a href="javascript:void(0)" onclick="loadMyProfile()"
              class="dropdown-toggle" data-toggle="dropdown">
              <div class="user-toggle">
                <?php if (is_login(false)) {?>
                <div class="user-avatar sm">
                  <img src="<?=_storage("avatar/$us->avatar")?>"
                    onerror="this.onerror=null;this.src='<?=_storage('avatar/default.jpg')?>';">
                </div>
                <?php } else {?>
                <div class="user-avatar sm">
                  <em class="icon ni ni-user-alt"></em>
                </div>
                <?php }?>
              </div>
            </a>
            <div
              class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
              <div id="myprofile-header">

              </div>
            </div>
          </li><!-- .dropdown -->
        </ul><!-- .nk-quick-nav -->
      </div><!-- .nk-header-tools -->
    </div><!-- .nk-header-wrap -->
  </div><!-- .container-fliud -->
</div>