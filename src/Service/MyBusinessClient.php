<?php

namespace Drupal\google_mybusiness_api\Service;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Google_Service_MyBusiness;


/**
 * Class Google My Business API Client Service.
 *
 * @package Drupal\google_mybusiness_api\Service
 */
class MyBusinessClient {

  /**
   * The logger factory.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $loggerFactory;

  /**
   * Uneditable Config.
   *
   * @var \Drupal\Core\Config\Config|\Drupal\Core\Config\ImmutableConfig
   */
  private $config;

  /**
   * Cache.
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  private $cacheBackend;

  /**
   * Google Service MyBusiness
   * @var \Google_Service_MyBusiness
   */
  private $googleMyBusiness;

  /**
   * Callback Controller constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactory $config
   *   An instance of ConfigFactory.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $loggerFactory
   *   LoggerChannelFactoryInterface.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cacheBackend
   *   Cache Backend.
   */
  public function __construct(ConfigFactory $config,
                              LoggerChannelFactoryInterface $loggerFactory,
                              CacheBackendInterface $cacheBackend) {
    $this->config = $config->get('google_mybusiness_api.settings');
    $this->loggerFactory = $loggerFactory;
    $this->cacheBackend = $cacheBackend;
    $this->googleMyBusiness = new Google_Service_MyBusiness();
  }


}
