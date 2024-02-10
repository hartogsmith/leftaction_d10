<?php
/**
 * @file
 *	modified theme implementation to display a single Drupal page.
 *	see .info for regions
 *	see template.php for link / menu theme functions
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 *
 */

?>
<?php 
  if (menu_get_object()) {
    $type_name = node_type_get_name($node);
    $type_name = strtolower($type_name);
  } 
?>




<?php print render($page['content']['metatags']); ?>
    
<div class="page-container">

<header class="page-header">
  <div class="container-fluid text-inverse">
  
    <div class="row logo-navtoggle">
      <div class="col-xs-10 text-left col-logo"><!-- was col-sm-2 col-xs-3  text-right-->
        <?php if( $logo): ?>
          <div class="header-logo-wrap">
            <a href="<?php print $front_page; ?>" <?php if (!empty($site_name)): ?>title="<?php print $site_name; ?>"<?php endif; ?>><img src="<?php print $logo; ?>" alt="<?php if (!empty($site_name)): ?><?php print $site_name; ?>: <?php endif; ?><?php print t('Home'); ?>" /> </a>
            <a href="<?php print $front_page; ?>" <?php if (!empty($site_name)): ?>title="<?php print $site_name; ?>"<?php endif; ?>><?php if (!empty($site_name)): ?><h1 class="sr-only"><?php print $site_name; ?></h1><?php endif; ?></a>
           </div>
        <?php else: ?>
          <div class="header-logo-wrap">
            <a href="<?php print $front_page; ?>" <?php if (!empty($site_name)): ?>title="<?php print $site_name; ?>"<?php endif; ?>><?php if (!empty($site_name)): ?><h1 class="sr-only"><?php print $site_name; ?></h1><?php endif; ?> </a>
          </div>
        <?php endif; ?>
                
        <?php if (!empty($site_name) || !empty($site_slogan)): ?>
          <div class="site-info sr-only">
            <?php if (!empty($site_name)): ?>
            <h1><?php print $site_name; ?></h1>
            <?php endif; ?>
            <?php if (!empty($site_slogan)): ?>
            <h2><?php print $site_slogan; ?></h2>
            <?php endif; ?>
          </div>
        <?php endif; // site_name, site_slogan ?>

        <!-- trying nav here to simplify -->
        <?php if ($main_menu): ?>
          <div class="navbar-primary">
            <nav role="navigation">
              <?php print render($page['navigation']); ?>
            </nav>
          </div>
        <?php endif; ?>
      </div>

      <?php if ($main_menu): ?>
        <div class="col-xs-2 text-right col-navtoogle">
          <button type="button" id="navbar_toggle" class="navbar-toggle btn btn-nav">
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
            <span class="navbar-toggle-text sr-only">Menu</span>  
          </button>
        </div>
      <?php endif; ?>
    </div>

    <div class="row open-nav">
      
      <div class="col-sm-8 text-left open-nav-left">
        <?php if (!empty($page['open_nav_left'])): ?>
          <?php print render($page['open_nav_left']); ?>
        <?php endif; ?>
      </div>
      <div class="col-sm-4  open-nav-right">
        <?php if (!empty($page['open_nav_right'])): ?>
          <?php print render($page['open_nav_right']); ?>
        <?php endif; ?>
      </div>

    </div>

  </div>  
</header>


<div class="content-container">


  <?php if (!empty($page['main_jumbotron'])): ?>
    <?php print render($page['main_jumbotron']); ?>
  <!-- /#main_jumbotron -->
  <?php endif; ?>

  <?php if ($is_front): ?>
  
  <?php if (!empty($page['home_block_1'])): ?>
  <div class="container">
    <div class="row">
      <?php print render($page['home_block_1']); ?>
    </div>
  </div>
  <!-- /#home_block_1 -->
  <?php endif; ?>
  
  <div class="container">
    <div class="row">
    
    <?php if (!empty($page['home_block_2'])): ?>
    <?php print render($page['home_block_2']); ?>
    <!-- /#home_block_2 -->
    <?php endif; ?>

    <?php if (!empty($page['home_block_3'])): ?>
    <?php print render($page['home_block_3']); ?>
    <!-- /#home_block_3 -->
    <?php endif; ?>

    <?php if (!empty($page['home_block_4'])): ?>
    <?php print render($page['home_block_4']); ?>
    <!-- /#home_block_4 -->
    <?php endif; ?>
      <div class="clear"></div>
    </div>
  </div>

  <?php if (!empty($page['home_block_5'])): ?>
  <?php print render($page['home_block_5']); ?>
  <!-- /#home_block_5 -->
  <?php endif; ?>

  <?php if (!empty($page['home_block_6'])): ?>
  <?php print render($page['home_block_6']); ?>
  <!-- /#home_block_6 -->
  <?php endif; ?>

  
  <?php else: ?>
  <!-- end home-only regions -->
  

  <?php if (!empty($title)): ?>
		<div class="content-header">
		  <div class="container">	
			<div class="row">
			  <h1 class="col-xs-12 title"><?php print render($title) ?></h1>
			</div>
		  </div>  
		</div>
   <?php endif; ?>
  
          
  
  
  <div class="body-container <?php if (empty($page['sidebar_first'])): ?>no-sidebar<?php endif; ?>">
	<div class="container">
	  <div class="row">
	  
		<?php if (!empty($page['sidebar_first'])): ?>
		<aside class="col-sm-3 sidebar-wrapper" role="complementary"> <?php print render($page['sidebar_first']); ?> </aside>
		<?php endif; ?>
		<!-- /#sidebar-first -->
		
		<section class=" <?php if (!empty($page['sidebar_first'])): ?>col-sm-9<?php else: ?>col-xs-12<?php endif; ?> body-wrapper">
		  <?php if (!empty($page['highlighted'])): ?>
		  <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
		  <?php endif; ?>
		  <?php // if (!empty($breadcrumb)): print $breadcrumb; endif;?>
		  <a id="main-content"></a>
		  <?php if (!empty($page['subnav'])): ?>
		  <?php print render($page['subnav']); ?>
		  <?php endif; ?>
		  <?php print $messages; ?>
		  <?php if (!empty($tabs)): ?>
		  <?php print render($tabs); ?>
		  <?php endif; ?>
		  <?php if (!empty($page['help'])): ?>
		  <?php print render($page['help']); ?>
		  <?php endif; ?>
		  <?php if (!empty($action_links)): ?>
		  <ul class="action-links">
			<?php print render($action_links); ?>
		  </ul>
		  <?php endif; ?>
		  <?php print render($page['content']); ?> 
		  <?php if (!empty($page['shares'])): ?>
		  <?php print render($page['shares']); ?>
		  <?php endif; ?>
          </section>
	  </div>
	</div>
  </div>
  <?php endif; ?>
   
</div>

<footer class="footer section">
    <?php if (!empty($page['footer_signup'])): ?>
    <?php print render($page['footer_signup']); ?>
    <!-- /#footer_signup -->
    <?php endif; ?>
 
		<?php if( $logo): ?>
         <div class="container">
          <div class="footer-logo-wrap text-center">
           <a href="<?php print $front_page; ?>" <?php if (!empty($site_name)): ?>title="<?php print $site_name; ?>"<?php endif; ?>><img src="<?php print $logo; ?>" alt="<?php if (!empty($site_name)): ?><?php print $site_name; ?>: <?php endif; ?><?php print t('Home'); ?>" /></a>
           <a href="<?php print $front_page; ?>" <?php if (!empty($site_name)): ?>title="<?php print $site_name; ?>"<?php endif; ?>><?php if (!empty($site_name)): ?><h2 class="sr-only"><?php print $site_name; ?></h2><?php endif; ?></a> 
         </div>
         </div>
        <?php else: ?>
        <div class="container">
           <div class="footer-logo-wrap text-center">
            <a href="<?php print $front_page; ?>" <?php if (!empty($site_name)): ?>title="<?php print $site_name; ?>"<?php endif; ?>><?php if (!empty($site_name)): ?><h2 class="sr-only"><?php print $site_name; ?></h2><?php endif; ?> </a> 
          </div>
         </div>
        <?php endif; ?>

        
     <?php if ( ( !empty($page['footer_upper_left']) ) || ( !empty($page['footer_upper_right']) ) ): ?>
      	<div class="container">  
      	  <div class="row footer-upper">
      	<?php endif; ?>
      
      	<?php if (!empty($page['footer_upper_left'])): ?>
        	<div class="col-sm-6 text-left text-xs-center">
            <?php print render($page['footer_upper_left']); ?>
          </div>
         <?php endif; ?>

        <?php if (!empty($page['footer_upper_right'])): ?>
        	<div class="col-sm-6 text-sm-right text-xs-center">
            <?php print render($page['footer_upper_right']); ?>
          </div>
        <?php endif; ?>

      <?php if ( ( !empty($page['footer_upper_left']) ) || ( !empty($page['footer_upper_right']) ) ): ?>  
        </div>
      </div>
    <?php endif; ?>  

      
    <?php if ( !empty($page['footer_lower_left']) || !empty($page['footer_lower_right']) ): ?>
    	<div class="container">
        <div class="row footer-lower">
    <?php endif; ?>

     	<?php if (!empty($page['footer_lower_left'])): ?>
        <div class="col-sm-6 text-left text-xs-center">
          <?php print render($page['footer_lower_left']); ?>
        </div>
      <?php endif; ?>
         
		  <?php if (!empty($page['footer_lower_right'])): ?>
        <div class="col-sm-6 text-right">
          <?php print render($page['footer_lower_right']); ?>
        </div>
      <?php endif; ?>

    <?php if ( !empty($page['footer_lower_left']) || !empty($page['footer_lower_right']) ): ?>
        </div>
      <div>
    <?php endif; ?>

	</div>

<div class="row admin">
  <div class="col-sm-6 text-left">
    <?php if (!empty($page['admin_left'])): ?>
    <?php print render($page['admin_left']); ?>
    <!-- /#admin_left -->
    <?php endif; ?>
  </div>
  <div class="col-sm-6 text-right">
    <?php if (!empty($page['admin_right'])): ?>
    <?php print render($page['admin_right']); ?>
    <!-- /#admin_right -->
    <?php endif; ?>
  </div>
</div>

</footer>
</div>