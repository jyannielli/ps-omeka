<?php
$pageTitle = __('Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php echo pagination_links(); ?>

<?php if (get_theme_option('use_isotope')): ?>
  <p><input type="text" class="quicksearch" placeholder="Search Page" /></p>

  <h3 class="filter-label"><?php echo __('Filter by: '); ?></h3>
  <div class="button-group filter-button-group">
    <button data-filter="*">All</button>
    <button data-filter=".recent">Recently Added</button>
  </div>

  <h3 class="sort-label"><?php echo __('Sort by: '); ?></h3>
  <div class="sort-by button-group js-radio-button-group">
    <button class="button" data-sort-by="title">Title</button>
    <button class="button" data-sort-by="asc">Date Ascending</button>
    <button class="button" data-sort-by="desc">Date Descending</button>
  </div>
<?php endif; ?>

<div class="grid">
<?php $is_recent = date('Y-m-d', mktime(0, 0, 0, date("m")-3, date("d"), date("Y"))); ?>
<?php foreach (loop('collections') as $collection): ?>

  <div class="collection grid-item card<?php echo (($collection->added > $is_recent)?' recent' : ''); ?>">

    <h2 class="title"><?php echo link_to_collection(); ?></h2>

    <?php if ($collectionImage = record_image('collection', 'thumbnail')): ?>
      <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
    <?php endif; ?>

    <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
      <div class="collection-description">
        <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
      </div>
    <?php endif; ?>

    <?php if ($collection->hasContributor()): ?>
      <div class="collection-contributors">
        <p>
          <strong><?php echo __('Contributors'); ?>:</strong>
          <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
        </p>
      </div>
    <?php endif; ?>

    <div class="hidden-isotope added asc desc"><?php echo ($collection->added); ?></div>

    <p class="view-items-link"><?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id'))); ?></p>

    <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>

  </div><!-- end class="collection" -->

<?php endforeach; ?>
</div>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>
