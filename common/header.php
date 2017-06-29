<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
  <?php endif; ?>
  <?php
  if (isset($title)) {
    $titleParts[] = strip_formatting($title);
  }
  $titleParts[] = option('site_title');
  ?>
  <title><?php echo implode(' &middot; ', $titleParts); ?></title>

  <?php echo auto_discovery_link_tags(); ?>

  <!-- Plugin Stuff -->

  <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


  <!-- Stylesheets -->
  <?php if (get_theme_option('use_meanmenu')): ?>
    <link rel="stylesheet" href="/themes/historicity/css/meanmenu.min.css" media="all" />
  <?php endif; ?>
  <?php
  queue_css_file(array('iconfonts','style'));
  queue_css_url('//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic');
  echo head_css();

  echo theme_header_background();
  ?>

  <?php
  ($backgroundColor = get_theme_option('background_color')) || ($backgroundColor = "#FFFFFF");
  ($backgroundImage = get_theme_option('background_image'));
  ($textColor = get_theme_option('text_color')) || ($textColor = "#444444");
  ($linkColor = get_theme_option('link_color')) || ($linkColor = "#888888");
  ($buttonColor = get_theme_option('button_color')) || ($buttonColor = "#000000");
  ($buttonHoverColor = get_theme_option('button_color_hover')) || ($buttonColor = "#000000");
  ($buttonTextColor = get_theme_option('button_text_color')) || ($buttonTextColor = "#FFFFFF");
  ($titleColor = get_theme_option('header_title_color')) || ($titleColor = "#000000");
  ($headerBackgroundImage = get_theme_option('header_background'));
  ($headerBackgroundColor = get_theme_option('header_background_color')) || ($headerBackgroundColor = "#111111");
  ?>
  <style>
    body {
      background-color: <?php echo $backgroundColor; ?>;
      background-image: url('/files/theme_uploads/<?php echo $backgroundImage; ?>');
      color: <?php echo $textColor; ?>;
    }
    header {
      background-color: <?php echo $headerBackgroundColor; ?>;
      background-image: url('/files/theme_uploads/<?php echo $headerBackgroundImage; ?>');
    }
    #site-title a:link, #site-title a:visited,
    #site-title a:active, #site-title a:hover {
      color: <?php echo $titleColor; ?>;
    <?php if (get_theme_option('header_background')): ?>
      text-shadow: 0px 0px 20px #000;
    <?php endif; ?>
    }
    a:link {
      color: <?php echo $linkColor; ?>;
    }
    a:visited {
      color: <?php echo $linkColor; ?>;
    }
    a:hover, a:active, a:focus {
      color: <?php echo $linkColor; ?>;
    }

    .button, button,
    input[type="reset"],
    input[type="submit"],
    input[type="button"],
    .pagination_next a,
    .pagination_previous a {
      background-color: <?php echo $buttonColor; ?>;
      color: <?php echo $buttonTextColor; ?> !important;
    }

    .button:hover, button:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover,
    input[type="button"]:hover,
    .pagination_next a:hover,
    .pagination_previous a:hover {
      background-color: <?php echo $buttonHoverColor; ?>;
    }

    .mobile li {
      background-color: <?php echo $buttonColor; ?>;
    }

    .mobile li ul li {
      background-color: <?php echo $buttonColor; ?>;
    }

    .mobile li li li {
      background-color: <?php echo $buttonColor; ?>;
    }
  </style>
  <!-- JavaScripts -->
  <?php
  queue_js_file('vendor/modernizr');
  queue_js_file('vendor/selectivizr', 'javascripts', array('conditional' => '(gte IE 6)&(lte IE 8)'));
  queue_js_file('vendor/respond');
  queue_js_file('vendor/jquery-accessibleMegaMenu');
  queue_js_file('globals');
  queue_js_file('default');
  echo head_js();
  ?>

  <?php if (get_theme_option('use_isotope')): ?>
    <script src="/themes/historicity/javascripts/imagesloaded.pkgd.min.js"></script>
    <script src="https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js"></script>
    <script>
      (function ($) {
        $(document).ready(function () {
          // quick search regex
          var qsRegex;

          // init isotope
          var $grid = $('.grid');

          $grid.imagesLoaded( function () {
            $grid.isotope({
              // options
              itemSelector: '.grid-item',
              layoutMode: 'masonry',
              getSortData: {
                title: '.title',
                date: '.date',
                asc: '.asc',
                desc: '.desc'
              },
              sortAscending: {
                title: true,
                date: true,
                asc: true,
                desc: false
              },
              filter: function() {
                return qsRegex ? $(this).text().match( qsRegex ) : true;
              }
            });
          });

          // bind sort button click
          $('.sort-by').on('click', 'button', function () {
            var sortValue = $(this).attr('data-sort-by');
            $grid.isotope({sortBy: sortValue});
          });

          // change is-checked class on buttons
          $('.button-group').each(function (i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', 'button', function () {
              $buttonGroup.find('.is-checked').removeClass('is-checked');
              $(this).addClass('is-checked');
            });
          });

          // filter items on button click
          $('.filter-button-group').on( 'click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
          });

          // use value of search field to filter
          var $quicksearch = $('.quicksearch').keyup( debounce( function() {
            qsRegex = new RegExp( $quicksearch.val(), 'gi' );
            $grid.isotope();
          }, 200 ) );

          // debounce so filtering doesn't happen every millisecond
          function debounce( fn, threshold ) {
            var timeout;
            return function debounced() {
              if ( timeout ) {
                clearTimeout( timeout );
              }
              function delayed() {
                fn();
                timeout = null;
              }
              timeout = setTimeout( delayed, threshold || 100 );
            }
          }
        });
      }(jQuery));
    </script>
  <?php endif; ?>

  <!-- Font -->
  <link href="//fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
<?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

<header role="banner">
  <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
  <div class="header__inner container">
    <div id="site-title"><?php echo link_to_home_page(theme_logo()); ?></div>
    <div id="search-container" role="search" class="search">
      <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
        <?php echo search_form(array('show_advanced' => true)); ?>
      <?php else: ?>
        <?php echo search_form(); ?>
      <?php endif; ?>
    </div>
  </div>
</header>
<nav id="primary-nav" role="navigation">
  <?php echo public_nav_main(array('role' => 'navigation')); ?>
</nav>
<div id="wrap">
  <div id="content" role="main" tabindex="-1" class="container">
    <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
