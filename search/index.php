<?php
$pageTitle = __('Search') . ' ' . __('(%s total)', $total_results);
echo head(array('title' => $pageTitle, 'bodyclass' => 'search'));
$searchRecordTypes = get_search_record_types();
?>
<h1><?php echo $pageTitle; ?></h1>
<?php echo search_filters(); ?>
<?php if ($total_results): ?>
  <?php echo pagination_links(); ?>
  <div id="search-results" class="grid">
    <?php $filter = new Zend_Filter_Word_CamelCaseToDash; ?>
    <?php foreach (loop('search_texts') as $searchText): ?>
      <?php $record = get_record_by_id($searchText['record_type'], $searchText['record_id']); ?>
      <?php $recordType = $searchText['record_type']; ?>
      <?php set_current_record($recordType, $record); ?>
      <div class="<?php echo strtolower($filter->filter($recordType)); ?> grid-item card">
      <?php if($recordType == 'Item'): ?>
          <h3 class="title">
              <a href="<?php echo record_url($record, 'show'); ?>"><?php echo $searchText['title'] ? $searchText['title'] : '[Unknown]'; ?></a>
          </h3>
          <?php if ($recordImage = record_image($recordType, 'square_thumbnail')): ?>
            <?php echo link_to_item(item_image('thumbnail', array('alt' => metadata('item', array('Dublin Core', 'Title'))))); ?>
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
      <?php elseif($recordType == 'Exhibit') : ?>
          <h2 class="title">
            <a href="<?php echo record_url($record, 'show'); ?>"><?php echo $searchText['title'] ? $searchText['title'] : '[Unknown]'; ?></a>
          </h2>
          <?php if ($recordImage = record_image($recordType, 'square_thumbnail')): ?>
            <?php echo exhibit_builder_link_to_exhibit($record, $recordImage, array('class' => 'image')); ?>
          <?php endif; ?>
          <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
            <div class="description"><?php echo $exhibitDescription; ?></div>
          <?php endif; ?>
          <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
            <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                <?php echo $exhibitTags;  ?></p>
            </div>
          <?php endif; ?>
      <?php else: ?>
            <h3 class="title"><a  href="<?php echo record_url($record, 'show'); ?>"><?php echo $searchText['title'] ? $searchText['title'] : '[Unknown]'; ?></a></h3>
            <?php if ($recordImage = record_image($recordType, 'square_thumbnail')): ?>
              <?php echo link_to($record, 'show', $recordImage, array('class' => 'image')); ?>
            <?php endif; ?>
      <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <?php echo pagination_links(); ?>
<?php else: ?>
  <div id="no-results">
    <p><?php echo __('Your query returned no results.');?></p>
  </div>
<?php endif; ?>
<?php echo foot(); ?>
