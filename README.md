#Historicity

This Omeka theme was originally developed for the Center for Digital Humanities at Princeton University.

##Appearance Configuration
This theme is meant as a customizable base for building a unique design and allows site administrators greater control over the branding of their site via configuration settings.   

###Design
Set the global colors, backgrounds,  for the site

- **Text**: Defines the hex code for headings, paragraphs, and other text on the site
- **Background Color**: Defines the hex code for the <body> background color.
- **Background Image**: Defines a graphic to use for the <body> background. This will repeat by default, but can be overridden in the theme's CSS.
- **Links**: Defines the hex code for links on the site.
- **Buttons**: Defines the hex code for the default primary button background.
- **Buttons Hover**: Defines the hex code for the default primary button hover state.
- **Buttons Text**: Defines the hex code for button text.

###Header
Set the style and content for the footer area

- **Site Title**: Defines the hex code for the site title, if a logo is not used.
- **Logo**: This theme will show a high definition logo when the user's device has a high pixel density.
  - _**Standard**_: The standard logo should be a PNG file with a maximum height of 150px.
  - _**HiDPI-optimized**_: The HiDPI-optimized logo should be twice as large as the standard logo upload.
- **Background Image**: An image to be used behind the logo in the header.
- **Background Color**: A hex code value for the header background.

### Menu
By default this theme uses meaMenu (http://www.meanthemes.com/plugins/meanmenu/) to convert the standard navigation into a mobile/tablet navigation. Full documentation is available on meanMenu's GitHub repo. Noted below are the different default values for Historicity.

- **Use meanMenu**: Checked by default. Uncheck to disable meanMenu.
- **meanMenuContainer**: This is set to place the mobile/tablet menu in the "#search-container" container.
- **meanScreenWidth**: This is set so the meanMenu becomes visible at "767", which is currently below an iPad's width in portrait orientation. If you wish to use this pattern on iPad in portrait orientation, simply change this value to "768".
- **meanNavReveal**: This will show a hamburger icon created by 3 <span></span> tags by default. This value can be any text or markup.

###Homepage
This theme provides some custom areas on the homepage, as noted below.

- **Text**: A block of introductory text for the website to describe it's purpose and engage visitors.
- **Hero**: Provide an image to use for a static design element. By default this image will be wrapped by the homepage text, however this can be altered in the /themes/historicity/index.php file.
  - **Link**: The hero image can be linked to any page, item, collection, or exhibit in the current site. Simply add the path preceded by a forward slash (e.g. /items/show/1).
- **Recent Items**: Defines the number of Recent Items to show on the homepage. Currently optimized to show 1 item only.
- **Recent Exhibits**: Defines the number of Recent Exhibts to show on the homepage. Currently optimized to show 2 exhibits.

###Isotope
This provides an engaging filter and sort for items, exhibits, and collections in Historicity. In addition this provides the masonry grid layout on the browse pages. The implementation of this theme is documented below. Full documentation and demos can be found at http://isotope.metafizzy.co/

- **Use Isotope**: Checked by default. Uncheck to disable Isotope.

####Usage

- **Search Page**: The code behind this allows for dynamic searching of the browse page content. This can easily be removed from any of the browse pages by removing or commenting out the following code in the browse.php files for items, collections, and/or exhibits.

    `<p class="quicksearch__container"><input type="text" class="quicksearch" placeholder="Search Page" /></p>`
    
- **Filter by**: Currently this only allows for filtering of All entries on a page or Recently Added entries. Recently added is currently set to within the past 3 months. The code for the filters can be adjusted as needed. In the default case items that are "recently added" will have the ".recent" CSS class applied to them and therefore be filterable. Furthermore, the filtering functionality can be extended to include any number of options. The simplest and currently implemented approach is to add unique classes for the different filters.
    
    **_Date range example:_**
    
    `<?php $is_recent = date('Y-m-d', mktime(0, 0, 0, date("m")-3, date("d"), date("Y"))); ?>`
    
    **_Dynamic class example:_**
    
    `<?php echo (($item->added > $is_recent)?' recent' : ''); ?>`
    
- **Sort by**:
  - **_Title_**: Used on Items and Collections to sort entries alphabetically.
  - **_Date_**: Used on Items to sort entries (ascending) by the historical date of the item.
  - **_Added_**: Used on Collections and Exhibits (defaults to descending).

###Colorbox
http://www.jacklmoore.com/colorbox/

###Footer
Set the style and content for the footer area

- **Footer Background Color**: Defines the hex code for the <footer> background color.
- **Footer Text Color**: Defines the hex code for the <footer> text color.
- **Footer Text**: Provides a textarea to enter custom content.
- **Display Copyright in Footer**: Toggles showing the "Site Copyright Information" entered on the admin settings screen.

##License
GPL v3