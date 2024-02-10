<?php

namespace Drupal\domain_theme_switch;

/**
 * Defines the interface for domain_theme_lookup.
 */
interface DomainThemeLookupInterface {

  /**
   * Gets the default theme for the domain.
   *
   * @param string $domain_id
   *   The domain ID.
   *
   * @return string
   *   The default theme.
   */
  public function getDefaultTheme($domain_id);

  /**
   * Gets the admin theme for the domain.
   *
   * @param string $domain_id
   *   The domain ID.
   *
   * @return string
   *   The admin theme.
   */
  public function getAdminTheme($domain_id);

}
