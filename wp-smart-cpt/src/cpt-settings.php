<section class="cpt-banner">
    <img src="<?php echo plugin_dir_url(__DIR__) ?>assets/images/cpt-banner.jpg" />
</section>

<section class="heading-sec">
    <h1>WP SMART CPT</h1>
    <p>Empower your content with WP Smart CPT Generator!</p>
</section>

<section class="cpt-details">
    <div class="cpt-tabs">
        <ul id="tabs-nav">
            <li><a href="#tab1">Generate Smart CPT</a></li>
            <li><a href="#tab2">All Smart CPTs</a></li>
            <li><a href="#tab3">Website Statistics</a></li>
        </ul> <!-- END tabs-nav -->
        <div id="tabs-content">
            <div id="tab1" class="tab-content">
                <?php require_once(plugin_dir_path(__DIR__) . 'includes/generate-smart-cpt.php'); ?>
            </div>
            <div id="tab2" class="tab-content">
                <h2>All Details</h2>
                <div id="custom-post-types-list"></div>
            </div>
            <div id="tab3" class="tab-content">
                <?php require_once(plugin_dir_path(__DIR__) . 'includes/web-statistics.php'); ?>
            </div>
        </div> <!-- END tabs-content -->
    </div> <!-- END tabs -->
</section>