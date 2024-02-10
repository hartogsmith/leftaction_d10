<?php // modified for custom field display
?>

  <!-- Interior Headers --> 

  <?php  
  // get info from field_hero_image (don't use isset: https://drupal.stackexchange.com/questions/11238/check-if-a-field-is-empty)
  $key_image = field_get_items('node', $node, 'field_action_img');
  if ($key_image):
	  $key_url = $node->field_action_img['und'][0]['uri'];
	  $styled_key_url = image_style_url("hero2", $key_url); 
		if ($styled_key_url): 
			print '<style>';
			print 'body.not-front .content-header {';
			print 'background-image: url(' . render($styled_key_url) . ');';
			print 'padding-top: 33vw ;';
			print '}';
			print '</style>';
		endif;
	endif;
    ?>


<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>> <?php print $user_picture; ?> <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
  <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($display_submitted): ?>
  <span class="submitted"><?php print $submitted ?></span>
  <?php endif; ?>
  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
    <div class="links"><?php print render($content['links']); ?></div>
    <?php endif; ?>
    <?php print render($content['comments']); ?> </div>
</div>
