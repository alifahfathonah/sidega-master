<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Artikel </h2>
                <ol>
                    <li><a href="<?= site_url('first') ?>">Home</a></li>
                    <li>Artikel</li>
                </ol>
            </div>
        </div>
    </section><!-- End Breadcrumbs -->
    
    <?php if($single_artikel['id']) : ?>
    <main id="main">
        <?php $this->load->view($folder_themes .'/commons/header') ?>
		<?php $this->load->view($folder_themes .'/partials/article_detail.php') ?>
    </main><!-- End #main -->
    
        <?php $this->load->view($folder_themes .'/commons/footer') ?>
        <?php $this->load->view($folder_themes . '/commons/for_js') ?>
    
        <?php else : ?>
            <?php $this->load->view($folder_themes . '/commons/404') ?>
    <?php endif ?>
    <?php $this->load->view($folder_themes . '/widgets/chat') ?>

</body>
</html>