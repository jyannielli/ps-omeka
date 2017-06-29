<?php
echo head(array(
  'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
  'bodyclass' => 'exhibits show'));
?>

<nav id="exhibit-pages">
  <h2><?php echo $exhibit->title; ?></h2>
  <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
    <div class="exhibit-credits">
      <p><strong><?php echo 'By ' . $exhibitCredits; ?></strong></p>
    </div>
  <?php endif; ?>
  <?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?>
</nav>

<div id="exhibit-blocks">
  <?php exhibit_builder_render_exhibit_page(); ?>
</div>

<div id="exhibit-page-navigation">
  <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
    <div id="exhibit-nav-prev">
      <?php echo $prevLink; ?>
    </div>
  <?php endif; ?>
  <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
    <div id="exhibit-nav-next">
      <?php echo $nextLink; ?>
    </div>
  <?php endif; ?>
</div>

<?php echo foot(); ?>
