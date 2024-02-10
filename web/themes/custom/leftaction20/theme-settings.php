<?php
function leftaction20_form_system_theme_settings_alter(&$form, $form_state) {
  $form['theme_settings']['typekit'] = array(
    '#type' => 'textfield',
    '#title' => t('Typekit ID'),
    '#default_value' => theme_get_setting('typekit'),
  );
  //
}
?>