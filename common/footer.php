</div><!-- end content -->

</div><!-- end wrap -->

<?php
$footerBackgroundColor = get_theme_option('footer_background_color');
$footerTextColor = get_theme_option('footer_text_color');
?>
<footer role="contentinfo" style="background-color: <?php echo $footerBackgroundColor; ?>; color: <?php echo $footerTextColor; ?>">

  <div id="footer-text" class="container">
    <?php echo get_theme_option('Footer Text'); ?>
    <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
      <p>&copy; <?php echo $copyright; ?></p>
    <?php endif; ?>
  </div>

  <?php fire_plugin_hook('public_footer', array('view' => $this)); ?>

</footer><!-- end footer -->

<script type="text/javascript">
  jQuery(document).ready(function () {
    Omeka.showAdvancedForm();
    Omeka.skipNav();
    Omeka.megaMenu();
  });
</script>
<?php if (get_theme_option('use_meanmenu')): ?>
  <script src="/themes/historicity/javascripts/jquery.meanmenu.min.js"></script>
<?php endif; ?>
<?php if (get_theme_option('use_colorbox')): ?>
  <script src="/themes/historicity/javascripts/jquery.colorbox-min.js"></script>
<?php endif; ?>
<script>
jQuery(document).ready(function () {
  <?php if (get_theme_option('use_meanmenu')): ?>
    jQuery('nav#primary-nav').meanmenu({
      meanMenuContainer: '#search-container',
      meanMenuClose: 'X',
      meanCloseSize: '18px',
      meanMenuOpen: '<span></span><span></span><span></span>',
      meanRevealPosition: 'right',
      meanRevealPositionDistance: '0',
      meanRevealColour: '',
      meanScreenWidth: '767',
      meanNavPush: '',
      meanShowChildren: true,
      meanExpandableChildren: true,
      meanExpand: '+',
      meanContract: '-',
      meanRemoveAttrs: false,
      onePage: false,
      removeElements: '',
      meanDisplay: 'block'
    });
  <?php endif; ?>

  <?php if (get_theme_option('use_colorbox')): ?>
    //Examples of how to assign the Colorbox event to elements
    jQuery(".image-jpeg a").colorbox({opacity: 1, maxWidth: '100%', maxHeight: '100%'});
    jQuery(".image-png a").colorbox({opacity: 1, maxWidth: '100%', maxHeight: '100%'});
    jQuery(".image-gif a").colorbox({opacity: 1, maxWidth: '100%', maxHeight: '100%'});
  <?php endif; ?>
});
</script>

</body>
</html>
