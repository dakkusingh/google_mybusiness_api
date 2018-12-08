<?php

namespace Drupal\google_mybusiness_api\Service;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\google_api_client\Service\GoogleApiClient;
use Exception;
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
   * Uneditable Tokens Config.
   *
   * @var \Drupal\Core\Config\Config|\Drupal\Core\Config\ImmutableConfig
   */
  private $configTokens;

  /**
   * Cache.
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  private $cacheBackend;

  /**
   * Google MyBusiness Service
   *
   * @var \Google_Service_MyBusiness
   */
  public $googleServiceMyBusiness;

  /**
   * Google API Client.
   *
   * @var \Drupal\google_api_client\Service\GoogleApiClient
   */
  private $googleApiClient;

  /**
   * Callback Controller constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactory $config
   *   An instance of ConfigFactory.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $loggerFactory
   *   LoggerChannelFactoryInterface.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cacheBackend
   *   Cache Backend.
   * @param \Drupal\google_api_client\Service\GoogleApiClient $googleApiClient
   */
  public function __construct(ConfigFactory $config,
                              LoggerChannelFactoryInterface $loggerFactory,
                              CacheBackendInterface $cacheBackend,
                              GoogleApiClient $googleApiClient) {
    $this->config = $config->get('google_api_client.settings');
    $this->configTokens = $config->get('google_api_client.tokens');

    $this->loggerFactory = $loggerFactory;
    $this->cacheBackend = $cacheBackend;

    $this->googleApiClient = $googleApiClient;
    $this->googleServiceMyBusiness = $this->getGoogleMyBusinessClient();
  }

  private function getGoogleMyBusinessClient() {
    // See https://developers.google.com/my-business/content/basic-setup
    $this->googleApiClient->googleClient->setScopes(["https://www.googleapis.com/auth/plus.business.manage"]);
    $googleServiceMyBusiness = new Google_Service_MyBusiness($this->googleApiClient->googleClient);
    return $googleServiceMyBusiness;
  }

  public function doRequest() {
    try {
      $accounts = $this->googleServiceMyBusiness->accounts->listAccounts();
      //ksm($accounts);
    }
    catch (Exception $e) {
      //ksm($e);
    }

  }


}
