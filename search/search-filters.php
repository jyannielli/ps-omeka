<div id="<?php echo $options['id']; ?>">
<!--  <ul>-->
<!--    <li>--><?php //echo __('Query:');?><!-- --><?php //echo html_escape($query); ?><!--</li>-->
<!--    <li>--><?php //echo __('Query type:');?><!-- --><?php //echo html_escape($query_type); ?><!--</li>-->
<!--    <li>--><?php //echo __('Record types:');?>
<!--      <ul>-->
<!--        --><?php //foreach ($record_types as $record_type): ?>
<!--          <li>--><?php //echo html_escape($record_type); ?><!--</li>-->
<!--        --><?php //endforeach; ?>
<!--      </ul>-->
<!--    </li>-->
<!--  </ul>-->
  <p class="quicksearch__container"><input type="text" class="quicksearch" placeholder="Search" /></p>

  <h3 class="filter-label"><?php echo __('Filter by: '); ?></h3>
  <div class="button-group filter-button-group">
    <button data-filter="*">all</button>
  </div>

  <h3 class="sort-label"><?php echo __('Sort by: '); ?></h3>
  <div class="sort-by button-group js-radio-button-group">
    <button class="button" data-sort-by="title">Title</button>
    <button class="button" data-sort-by="date">Date</button>
  </div>
</div>
