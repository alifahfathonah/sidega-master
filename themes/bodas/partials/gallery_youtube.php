<!-- ======= Gallery Youtube ======= -->
<section class="trending-product lazy">
      <div class="row">
<?php foreach ($gallery_youtube as $data) : ?>
        <?php if ($data['link']) : ?>

          <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="course-item bg-light shadow" style="padding: 10px 10px 10px 10px">
              <div class="position-relative overflow-hidden text-center">
                <iframe height="250px" width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data["link"]; ?>" title="<?= $data['nama'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                  <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3 border-end" style="border-radius: 30px 0 0 30px;"> Daftar Video <i class="fa fa-list"></i></a>
                  <!--<a href="<?= site_url('first/tawa') ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Putar</a>-->
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
      </div>
</section>