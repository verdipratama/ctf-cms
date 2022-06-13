<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?=meta_tag([
    'title'       => "$row->name",
    'description' => 'Users Profile Capture The Flag.',
    'favicon'     => _storage($websettings->seo_favicon),
    'thumb'       => _storage("avatar/$row->avatar"),
    'keywords'    => $websettings->seo_keywords,
    'url'         => base_url("users/$row->username"),
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
        <div class="container">
          <div class="nk-content-inner">
            <div class="nk-content-body">
              <div class="nk-block">
                <div class="card card-bordered">
                  <div class="card-content">
                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                      <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0)"><em
                            class="icon ni ni-user-circle"></em><span>Personal</span></a>
                      </li>
                      <?php if (is_login(false)) {
                              if ($this->session->userdata('id_login') == $row->id) {
                              ?>
                      <li class="nav-item">
                        <a class="nav-link"
                          href="<?=base_url("users/settings")?>"><em
                            class="icon ti-settings"></em><span>Settings</span></a>
                      </li>
                      <?php }
                      }?>
                    </ul>
                    <div class="card card-body">
                      <div class="row">
                        <div
                          class="col-12 col-xxl-4 col-xl-3 col-lg-4 col-md-3">
                          <div class="text-center">
                            <img class="rounded mb-2"
                              onerror="this.onerror=null;this.src='<?=_storage('avatar/default.jpg')?>';"
                              height="150"
                              src="<?=_storage("avatar/$row->avatar")?>">
                            <p class="mb-0 title h6"><?=$row->name?></p>
                            <p class="title"><?=$row->username?></p>
                          </div>
                        </div>
                        <div
                          class="col-12 col-xxl-8 col-xl-9 col-lg-8 col-md-9">
                          <div class="card-bordered p-2">
                            <div class="text-muted">bio~</div>
                            <small><?=$row->bio?></small>
                          </div>
                          <ul class="team-info">
                            <li>
                              <span>Points</span><span><?=format_number($row->points_asli)?></span>
                            </li>
                            <li><span>Points
                                Hint</span><span><?=format_number($row->points_hint)?></span>
                            </li>
                          </ul>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 col-xxl-3 col-xl-3 col-lg-3">
                    <div class="card card-bordered mb-3">
                      <div class="card-inner stretch flex-column">
                        <div class="card-title-group">
                          <div class="card-title card-title-sm">
                            <h6 class="title">Challenge Solve Rate</h6>
                          </div>
                        </div>

                        <div class="device-status my-auto">
                          <div class="device-status-ck">
                            <canvas class="analytics-doughnut"
                              id="deviceStatusData"></canvas>
                          </div>
                        </div><!-- .device-status -->
                      </div>
                    </div><!-- .card -->
                  </div>
                  <div class="col">
                    <div class="card card-bordered">
                      <div class="card-body">
                        <table class="table table-striped">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Challenge</th>
                              <th scope="col">Points</th>
                              <th scope="col">Solved</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                $i = 1;
                            foreach ($list_challSolved->result() as $rs): ?>
                            <tr>
                              <th scope="row"><?=$i++?></th>
                              <td><a
                                  href="<?=base_url("challenge?get=$rs->id_chall")?>"><?=$rs->chall_title?></a>
                              </td>
                              <td><?=$rs->score?></td>
                              <td><?=$rs->created_at?></td>
                            </tr>
                            <?php endforeach?>
                          </tbody>
                        </table>
                      </div>
                    </div>
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
  <script>
  "use strict";

  ! function(NioApp, $) {
    "use strict";
    var deviceStatusData = {
      labels: [<?=$category_solved?>],
      dataUnit: 'Solved',
      legend: false,
      datasets: [{
        borderColor: "#fff",
        background: [<?=$random_color?>],
        data: [<?=$count_solved?>]
      }]
    };

    function analyticsDoughnut(selector, set_data) {
      var $selector = selector ? $(selector) : $('.analytics-doughnut');
      $selector.each(function() {
        var $self = $(this),
          _self_id = $self.attr('id'),
          _get_data = typeof set_data === 'undefined' ? eval(_self_id) :
          set_data;

        var selectCanvas = document.getElementById(_self_id).getContext(
          "2d");
        var chart_data = [];

        for (var i = 0; i < _get_data.datasets.length; i++) {
          chart_data.push({
            backgroundColor: _get_data.datasets[i].background,
            borderWidth: 2,
            borderColor: _get_data.datasets[i].borderColor,
            hoverBorderColor: _get_data.datasets[i].borderColor,
            data: _get_data.datasets[i].data
          });
        }

        var chart = new Chart(selectCanvas, {
          type: 'doughnut',
          data: {
            labels: _get_data.labels,
            datasets: chart_data
          },
          options: {
            legend: {
              display: _get_data.legend ? _get_data.legend : false,
              labels: {
                boxWidth: 12,
                padding: 20,
                fontColor: '#6783b8'
              }
            },
            rotation: -1.5,
            cutoutPercentage: 70,
            maintainAspectRatio: false,
            tooltips: {
              enabled: true,
              rtl: NioApp.State.isRTL,
              callbacks: {
                title: function title(tooltipItem, data) {
                  return data['labels'][tooltipItem[0]['index']];
                },
                label: function label(tooltipItem, data) {
                  return data.datasets[tooltipItem.datasetIndex][
                    'data'
                  ][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                }
              },
              backgroundColor: '#fff',
              borderColor: '#eff6ff',
              borderWidth: 2,
              titleFontSize: 13,
              titleFontColor: '#6783b8',
              titleMarginBottom: 6,
              bodyFontColor: '#9eaecf',
              bodyFontSize: 12,
              bodySpacing: 4,
              yPadding: 10,
              xPadding: 10,
              footerMarginTop: 0,
              displayColors: false
            }
          }
        });
      });
    } // init chart
    NioApp.coms.docReady.push(function() {
      analyticsDoughnut();
    });
  }(NioApp, jQuery);
  </script>
</body>

</html>