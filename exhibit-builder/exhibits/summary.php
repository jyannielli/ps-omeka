<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>

<h1><?php echo metadata('exhibit', 'title'); ?></h1>
<?php echo exhibit_builder_page_nav(); ?>

<div id="primary">
  <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
    <div class="exhibit-credits">
      <p><strong><?php echo 'By ' . $exhibitCredits; ?></strong></p>
    </div>
  <?php endif; ?>

  <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
    <div class="exhibit-description">
      <?php echo $exhibitDescription; ?>
    </div>
  <?php endif; ?>
</div>

<?php if ($exhibit->getPagesCount() > 0): ?>
  <nav id="exhibit-pages">
    <ul>
      <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
      <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
        <?php echo exhibit_builder_page_summary($exhibitPage); ?>
      <?php endforeach; ?>
    </ul>
  </nav>
<?php endif; ?>

<?php echo foot(); ?>
