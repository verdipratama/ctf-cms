<div class="row g-1">
  <?php foreach ($getChall as $gc): ?>
  <div class="col-12 col-xxl-2 col-xl-3 col-lg-4 col-md-6">
    <a href="javascript:void(0)" onclick='getDetail("<?=$gc->id?>")'>
      <div class="card chall_card card-bordered">
        <div class="card-header p-2">
          <div class="d-flex">
            <div class="fw-bolder text-primary"
              style="text-transform: uppercase;"><?=$gc->title?></div>
            <div class="ml-auto text-muted fw-bold">
              <?=trim(explode(" ", $gc->cate_title)[0])?></div>
          </div>
        </div>
        <p class="card-body p-2 text-muted chall-desc">
          <small><?=strip_tags(word_limiter($gc->description, 40))?></small>
        </p>
        <div class="card-footer p-2">
          <div class="d-flex">
            <div class="text-muted" style="text-transform: capitalize;">
              <?=$gc->level?></div>
            <div class="ml-auto"><span class="nk-ibx-menu-text"><i
                  class="ti-flag-alt-2 "></i>
                <?=format_number($gc->score)?></span></div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <?php endforeach?>
</div>