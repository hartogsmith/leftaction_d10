<?php

namespace Drupal\domain_theme_switch;

use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * The domain theme lookup service.
 *
 * Used for retrieving the default and admin theme for a given domain.
 */
class DomainThemeLookup implements DomainThemeLookupInterface {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * DomainThemeLookup constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory->get('domain_theme_switch.settings');
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultTheme($domain_id) {
    return $this->configFactory->get($domain_id . '_site');
  }

  /**
   * {@inheritdoc}
   */
  public function getAdminTheme($domain_id) {
    return $this->configFactory->get($domain_id . '_admin');
  }

}
