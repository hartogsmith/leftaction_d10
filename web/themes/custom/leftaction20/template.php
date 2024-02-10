<?php

/**
 * @file
 * template.php
 */
 

//
/**
 * Add font-awesome markup to elements with fa classes
 */
function leftaction20_link (array $variables) {
  $attributes = $variables['options']['attributes'];

  // If there is a CSS class on the link that starts with "fa-", create
  // additional HTML markup for the icon, and move that specific classname there.

  // Exclusion List for settings eg http://fontawesome.io/examples/
  $exclusion = array(
    'fa-lg','fa-2x','fa-3x','fa-4x','fa-5x','fa-6x','fa-2','fa-3','fa-4','fa-5','fa-6',
    'fa-fw',
    'fa-ul', 'fa-li',
    'fa-border',
    'fa-spin',
    'fa-rotate-90', 'fa-rotate-180','fa-rotate-270','fa-flip-horizontal','fa-flip-vertical',
    'fa-stack', 'fa-stack-1x', 'fa-stack-2x',
    'fa-inverse'
  );

  if (isset($attributes['class'])) {
    foreach ($attributes['class'] as $key => $class) {
      if ((substr($class, 0, 3) == 'fa-' && !in_array($class,$exclusion)) ) {

        // We're injecting custom HTML into the link text, so if the original
        // link text was not set to allow HTML (the usual case for menu items),
        // we MUST do our own filtering of the original text with check_plain(),
        // then specify that the link text has HTML content.
        if (!isset($variables['options']['html']) || empty($variables['options']['html'])) {
          $variables['text'] = check_plain($variables['text']);
          $variables['options']['html'] = TRUE;
        }

        // Add the default-FontAwesome-prefix so we don't need to add it manually in the menu attributes
        $class = 'fa ' . $class;

        // Create additional HTML markup for the link's icon element and wrap
        // the link text in a SPAN element, to easily turn it on or off via CSS.
        $variables['text'] = '<i class="' . $class . '"></i> <span class="sr-only">' . $variables['text'] . '</span>';

        // Finally, remove the icon class from link options, so it is not printed twice.
        unset($variables['options']['attributes']['class'][$key]);
      }
    }
  }

  return theme_link($variables);
}


/**
 * Add bootstrap markup to menu items
 */
 
function leftaction20_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/* bootstrap theme, menu-tree.func.php */

function leftaction20_menu_tree(&$variables) {
  return '<ul class="menu nav">' . $variables['tree'] . '</ul>';
}

/**
 * Bootstrap theme wrapper function for the primary menu links.
 main-menu
 */
function leftaction20_menu_tree__main_menu(&$variables) {
  return '<ul class="menu nav navbar-nav main-links">' . $variables['tree'] . '</ul>';
}
function leftaction20_menu_tree__menu_meta_links(&$variables){
  return '<ul class="menu meta-links">' . $variables['tree'] . '</ul>';
}
function leftaction20_menu_tree__secondary_menu(&$variables){
  return '<ul class="menu footer-links">' . $variables['tree'] . '</ul>';
}
function leftaction20_menu_tree__menu_social_links(&$variables){
  return '<ul class="menu social-links">' . $variables['tree'] . '</ul>';
}
function leftaction20_menu_tree__menu_home_menu(&$variables){
  return '<ul class="row menu home-about-links">' . $variables['tree'] . '</ul>';
}

function leftaction20_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs--primary nav nav-tabs">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }

  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs--secondary pagination pagination-sm">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}
function leftaction20_menu_local_action($variables) {
  $link = $variables['element']['#link'];

  $options = isset($link['localized_options']) ? $link['localized_options'] : array();

  // If the title is not HTML, sanitize it.
  if (empty($options['html'])) {
    $link['title'] = check_plain($link['title']);
  }

  $icon = _bootstrap_iconize_text($link['title']);

  // Format the action link.
  $output = '';
  if (isset($link['href'])) {
    // Turn link into a mini-button and colorize based on title.
    if ($class = _bootstrap_colorize_text($link['title'])) {
      if (!isset($options['attributes']['class'])) {
        $options['attributes']['class'] = array();
      }
      $string = is_string($options['attributes']['class']);
      if ($string) {
        $options['attributes']['class'] = explode(' ', $options['attributes']['class']);
      }
      $options['attributes']['class'][] = 'btn';
      $options['attributes']['class'][] = 'btn-xs';
      $options['attributes']['class'][] = 'btn-' . $class;
      if ($string) {
        $options['attributes']['class'] = implode(' ', $options['attributes']['class']);
      }
    }
    // Force HTML so we can render any icon that may have been added.
    $options['html'] = !empty($options['html']) || !empty($icon) ? TRUE : FALSE;
    $output .= l($icon . $link['title'], $link['href'], $options);
  }
  else {
    $output .= $icon . $link['title'];
  }

  return $output;
}
function leftaction20_menu_local_task($variables) {
  $link = $variables['element']['#link'];
  $link_text = $link['title'];
  $attributes = array();

  if (!empty($variables['element']['#active'])) {
    // Add text to indicate active tab for non-visual users.
    $active = '<span class="element-invisible">' . t('(active tab)') . '</span>';

    // If the link does not contain HTML already, check_plain() it now.
    // After we set 'html'=TRUE the link will not be sanitized by l().
    if (empty($link['localized_options']['html'])) {
      $link['title'] = check_plain($link['title']);
    }
    $link['localized_options']['html'] = TRUE;
    $link_text = t('!local-task-title!active', array('!local-task-title' => $link['title'], '!active' => $active));

    $attributes['class'][] = 'active';
  }

  return '<li' . drupal_attributes($attributes) . '>' . l($link_text, $link['href'], $link['localized_options']) . "</li>\n";
}


function leftaction20_form_alter(&$form, &$form_state, $form_id){
  if ($form_id == 'webform_client_form_2') {
    $form['actions']['submit']['#attributes']['class'][] = 'btn btn-primary btn-block';
    $form['actions']['submit']['#prefix'] = '<div class="form-actions">';
    $form['actions']['submit']['#suffix'] = '</div>';    
  }
}

/**
* hook_form_FORM_ID_alter
* we want  a button  for submit (not default submit input) and some other bootstrap markup tweaks
* some additional lifting done in load.js
*/ 
function leftaction20_form_search_block_form_alter(&$form, &$form_state, $form_id) {
  $form['#attributes']['class'][] = 'form-inline'; // the form
  $form['search_block_form']['#attributes']['title'] = t('Enter your search term(s)'); // search field
  $form['search_block_form']['#attributes']['placeholder'] = t('Search');
  $form['search_block_form']['#attributes']['class'] = array(
    'form-item', // 
  );
  $form['actions']['#attributes']['class'] = array(
    'form-group', // 
  );
} 