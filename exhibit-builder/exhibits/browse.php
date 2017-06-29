<?php
$title = __('Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<h1><?php echo $title; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php if (count($exhibits) > 0): ?>

<nav class="navigation secondary-nav">
    <?php echo nav(array(
        array(
            'label' => __('Browse All'),
            'uri' => url('exhibits')
        ),
        array(
            'label' => __('Browse by Tag'),
            'uri' => url('exhibits/tags')
        )
    )); ?>
</nav>

<?php if (get_theme_option('use_isotope')): ?>
  <p class="quicksearch__container"><input type="text" class="quicksearch" placeholder="Search Page" /></p>

  <h3 class="filter-label"><?php echo __('Filter by: '); ?></h3>
  <div class="button-group filter-button-group">
      <button data-filter="*">All</button>
    <button data-filter="recent">Recently Added</button>
  </div>

  <h3 class="sort-label"><?php echo __('Sort by date: '); ?></h3>
  <div class="sort-by button-group js-radio-button-group">
    <button class="button" data-sort-by="asc">Ascending</button>
    <button class="button" data-sort-by="desc">Descending</button>
  </div>
<?php endif; ?>

<?php $exhibitCount = 0; ?>
  <div class="grid">
    <?php $is_recent = date('Y-m-d', mktime(0, 0, 0, date("m")-3, date("d"), date("Y"))); ?>
<?php foreach (loop('exhibit') as $exhibit): ?>
    <?php $exhibitCount++; ?>
    <div class="exhibit card grid-item <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?><?php echo (($exhibit->added > $is_recent)?' recent' : ''); ?>">
        <h2 class="title"><?php echo link_to_exhibit(); ?></h2>
      <?php if ($exhibitImage = record_image($exhibit, 'thumbnail')): ?>
        <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
      <?php endif; ?>
        <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
          <div class="description"><?php echo $exhibitDescription; ?></div>
        <?php endif; ?>
        <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
          <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
              <?php echo $exhibitTags;  ?></p>
          </div>
        <?php endif; ?>
      <div class="hidden-isotope added asc desc"><?php echo ($exhibit->added); ?></div>
    </div>
<?php endforeach; ?>
  </div>

<?php echo pagination_links(); ?>

<?php else: ?>
<p><?php echo __('There are no exhibits available yet.'); ?></p>
<?php endif; ?>

<?php echo foot(); ?>
