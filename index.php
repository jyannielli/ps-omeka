<?php echo head(array('bodyid'=>'home',)); ?>
<div id="primary">
<?php if ($homepageText = get_theme_option('Homepage Text')): ?>
  <div class="home__text">
    <?php if ($homepageHero = get_theme_option('Homepage Hero')): ?>
      <?php if ($homepageHeroLink = get_theme_option('Homepage Hero Link')): ?>
        <a href="<?php echo $homepageHeroLink; ?>">
        <img class="home__hero" src="/files/theme_uploads/<?php echo $homepageHero; ?>" />
        </a>
      <?php else: ?>
        <img class="home__hero" src="/files/theme_uploads/<?php echo $homepageHero; ?>" />
      <?php endif; ?>
    <?php endif; ?>
    <?php echo $homepageText; ?>
  </div>
<?php endif; ?>

</div><!-- end primary -->

<div id="secondary">
  <?php if (get_theme_option('Display Featured Item') == 1): ?>
    <!-- Featured Item -->
    <div id="featured-item">
      <h2><?php echo __('Featured Item'); ?></h2>
      <?php echo random_featured_items(1); ?>
    </div><!--end featured-item-->
  <?php endif; ?>

  <?php if (get_theme_option('Display Featured Collection')): ?>
    <!-- Featured Collection -->
    <div id="featured-collection">
      <h2><?php echo __('Featured Collection'); ?></h2>
      <?php echo random_featured_collection(); ?>
    </div><!-- end featured collection -->
  <?php endif; ?>

  <?php if ((get_theme_option('Display Featured Exhibit')) && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <!-- Featured Exhibit -->
    <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
  <?php endif; ?>

  <?php
  $recentExhibits = get_theme_option('Homepage Recent Exhibits');
  if ($recentExhibits === null || $recentExhibits === ''):
    $recentExhibitsCount = 2;
  else:
    $recentExhibitsCount = (int) $recentExhibits;
  endif;
  if ($recentExhibitsCount):
    ?>
    <div id="featured-exhibits" class="home__exhibits">
      <h2><?php echo __('Featured Exhibits'); ?></h2>
      <?php $exhibits = get_records('Exhibit', array('sort_field' => 'random', 'sort_dir' => 'd', 'featured' => 1, 'public' => 1), $recentExhibitsCount);
      foreach($exhibits as $exhibit) {
        echo '<div class="exhibit record">';
        echo '<h3>' . exhibit_builder_link_to_exhibit($exhibit) . '</h3>';
        if ($exhibitImage = record_image($exhibit, 'thumbnail')):
          echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image'));
        endif;
        echo '<p>' . $exhibit->description . '</p>';
        echo '</div>';
      }
      ?>
      <p class="view-exhibits-link"><a href="<?php echo html_escape(url('exhibits')); ?>"><?php echo __('View All Exhibits'); ?></a></p>
    </div><!--end recent-exhibits -->
  <?php endif; ?>

  <?php
  $recentItems = get_theme_option('Homepage Recent Items');
  if ($recentItems === null || $recentItems === ''):
    $recentItemsCount = 1;
  else:
    $recentItemsCount = (int) $recentItems;
  endif;
  if ($recentItemsCount):
    ?>
    <div id="recent-items" class="home__recent">
      <h2><?php echo __('Featured Source'); ?></h2>
      <?php echo random_featured_items($recentItemsCount); ?>
      <p class="view-items-link"><a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Sources'); ?></a></p>
    </div><!--end recent-items -->
  <?php endif; ?>

  <?php fire_plugin_hook('public_home', array('view' => $this)); ?>

</div><!-- end secondary -->
<?php echo foot(); ?>
