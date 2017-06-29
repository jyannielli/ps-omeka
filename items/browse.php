<?php
$pageTitle = __('Sources');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
  <?php echo public_nav_items(); ?>
</nav>

<?php if ((get_theme_option('use_isotope')) && ($total_results > 0)): ?>
  <p class="quicksearch__container"><input type="text" class="quicksearch" placeholder="Search Page" /></p>

  <h3 class="filter-label"><?php echo __('Filter by: '); ?></h3>
  <div class="button-group filter-button-group">
    <button data-filter="*">All</button>
    <button data-filter=".recent">Recently Added</button>
  </div>

  <h3 class="sort-label"><?php echo __('Sort by: '); ?></h3>
  <div class="sort-by button-group js-radio-button-group">
    <button class="button" data-sort-by="title">Title</button>
    <button class="button" data-sort-by="date">Date</button>
  </div>
<?php endif; ?>

<div class="grid">
  <?php $is_recent = date('Y-m-d', mktime(0, 0, 0, date("m")-3, date("d"), date("Y"))); ?>
  <?php foreach (loop('items') as $item): ?>
  <div class="item hentry grid-item card<?php echo (($item->added > $is_recent)?' recent' : ''); ?>">
      <h3><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink title')); ?></h3>
    <?php if (metadata('item', 'has thumbnail')): ?>
      <div class="item-img">
        <?php echo link_to_item(item_image('thumbnail', array('alt' => metadata('item', array('Dublin Core', 'Title'))))); ?>
      </div>
    <?php endif; ?>
      <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
        <div class="item-description">
          <?php echo $description; ?>
        </div>
      <?php endif; ?>
      <?php if(metadata('item', array('Dublin Core', 'Date'))) :
          $itemDate = metadata('item', array('Dublin Core', 'Date'));
          if(preg_match('/\d{4}-\d{2}-\d{2}/', $itemDate)) {
            $itemEpoch = strtotime($itemDate);
            $itemDateDisplay = date('F j, Y', $itemEpoch);
          } else {
            $itemDateDisplay = $itemDate;
          }
         ?>
          <div class="hidden-isotope date"><?php echo $itemDate; ?></div>
          <p class="date-display"><strong>Date:</strong> <?php echo $itemDateDisplay; ?></p>
      <?php endif; ?>

      <?php if (metadata('item', 'has tags')): ?>
        <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
            <?php echo tag_string('items'); ?></p>
        </div>
      <?php endif; ?>

      <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

  </div><!-- end class="item hentry" -->
<?php endforeach; ?>

</div>
<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
