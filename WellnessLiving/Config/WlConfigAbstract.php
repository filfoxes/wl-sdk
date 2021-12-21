<?php

namespace WellnessLiving\Config;

use WellnessLiving\WlAssertException;
use WellnessLiving\WlRegionSid;

/**
 * Contains WellnessLiving SDK configuration.
 *
 * This class cannot be used as a parent of your config class.
 * Your config class must inherit from {@link \WellnessLiving\Config\WlConfigDeveloper} or
 * {@link \WellnessLiving\Config\WlConfigProduction}.
 *
 * The following constants should be overridden in your class:
 * * {@link \WellnessLiving\Config\WlConfigAbstract::AUTHORIZE_CODE};
 * * {@link \WellnessLiving\Config\WlConfigAbstract::AUTHORIZE_ID}.
 *
 * To create a configuration object, use the {@link \WellnessLiving\Config\WlConfigAbstract::create()} method
 * on behalf of your class configuration class. For example:<code>
 * <?php
 *     ...
 *     $o_config=ExampleConfig::create(WlRegionSid::US_EAST_1);
 *     ...
 * </code>
 *
 * @see \WlSdkExample\ExampleConfig
 */
abstract class WlConfigAbstract
{
  /**
   * The agent name in the http-request header.
   */
  public const AGENT='WellnessLiving SDK/1.1 (WellnessLiving SDK)';

  /**
   * Secret code to authorize application.
   *
   * The value `null` is not valid. This constant must be overridden in inherited classes.
   *
   * @var string
   * @see \WlSdkExample\ExampleConfig
   */
  public const AUTHORIZE_CODE=null;

  /**
   * Application ID.
   *
   * The value `null` is not valid. This constant must be overridden in inherited classes.
   *
   * @var string
   * @see \WlSdkExample\ExampleConfig
   */
  public const AUTHORIZE_ID=null;

  /**
   * Name of a persistent cookie.
   *
   * The value `null` is not valid. This constant must be overridden in inherited classes.
   *
   * @see \WellnessLiving\Config\WlConfigProduction
   * @see \WellnessLiving\Config\WlConfigDeveloper
   */
  protected const COOKIE_PERSISTENT=null;

  /**
   * Name of a transient cookie.
   *
   * The value `null` is not valid. This constant must be overridden in inherited classes.
   *
   * @see \WellnessLiving\Config\WlConfigProduction
   * @see \WellnessLiving\Config\WlConfigDeveloper
   */
  protected const COOKIE_TRANSIENT=null;

  /**
   * URL of the API endpoint by regions.
   *
   * The value `null` is not valid. This constant must be overridden in inherited classes.
   *
   * The correct value for the constant is an array.
   * The key of array is data center region id. One of {@link \WellnessLiving\WlRegionSid} constant.
   * The value is URL of the API endpoint for region.
   *
   * @see \WellnessLiving\Config\WlConfigProduction
   * @see \WellnessLiving\Config\WlConfigDeveloper
   */
  protected const REGION_URL=null;

  /**
   * List of rules, which is used to convert error codes to HTTP codes.
   *
   * Keys are names of class model or empty string.
   * * Empty string in a case if this is default rule.
   * * Class name in a case if there are specific rules for particular class. Class specific rules will override default rules.
   *
   * Value is a string with list of rules separated by comma. Each rule has the following format: <ul>
   *   <li>
   *     <tt>default</tt>
   *     Special rule with already predefined list of rules.
   *   </li>
   *   <li>
   *     <tt>[http code] [rule]</tt>
   *     Allow only 4xx codes. Check the list here: {@link https://en.wikipedia.org/wiki/List_of_HTTP_status_codes}.
   *     Rules can be in next format:<dl>
   *       <dt>[status]</dt>
   *       <dd>Exact value of the status.</dd>
   *       <dt>-[value]</dt>
   *       <dd>Can be used for any status, which ends with -[value].</dd>
   *       <dt>-[value]-/dt>
   *       <dd>Can be used for any status, which includes -[value]-.</dd>
   *       <dt>[value]-/dt>
   *       <dd>Can be used for any status, which starts with [value]-.</dd>
   *       <dt>-</dt>
   *       <dd>Code, which should be set, if status is not <tt>ok</tt>,but we do not have any corresponding code in the rules.</dd>
   *     </dl>
   *   </li>
   * </ul>
   *
   * Example: <code>
   *   public const RESULT_CONVERSION_RULES = [
   *     '' => 'default',
   *     \WellnessLiving\Core\Passport\User\LoginModel::class => '418 code-teapot,451 signature-empty'
   *   ];
   * </code>
   *
   * @var array
   */
  public const RESULT_CONVERSION_RULES = [];

  /**
   * Timeout to wait for connection to establish.
   */
  public const TIMEOUT_CONNECT=60;

  /**
   * Timeout to wait for data reading from an established connection.
   */
  public const TIMEOUT_READ=600;

  /**
   * ID of a region in which information about this business is stored.
   * One of {@link \WellnessLiving\WlRegionSid} constants.
   *
   * @var int
   */
  private $id_region;

  /**
   * Prevents manual creation of a configuration object.
   *
   * @see \WellnessLiving\Config\WlConfigAbstract::create()
   */
  protected function __construct()
  {
  }

  /**
   * Gets the name of a persistent cookie in the current configuration.
   *
   * @return string The name of a persistent cookie in the current configuration.
   */
  final public function cookiePersistent(): string
  {
    return static::COOKIE_PERSISTENT;
  }

  /**
   * Gets the name of a transient cookie in the current configuration.
   *
   * @return string The name of a transient cookie in the current configuration.
   */
  final public function cookieTransient(): string
  {
    return static::COOKIE_TRANSIENT;
  }

  /**
   * Creates a configuration object.
   *
   * @param int $id_region ID of a data center region in which information about this business is stored.
   *   One of {@link \WellnessLiving\WlRegionSid} constants.
   * @return WlConfigAbstract Configuration object.
   * @throws WlAssertException In a case of an error with argument.
   */
  final public static function create(int $id_region): WlConfigAbstract
  {
    WlAssertException::assertTrue(is_string(static::AUTHORIZE_CODE) && strlen(static::AUTHORIZE_CODE)>0,[
      'text_class' => static::class,
      'text_message' => 'The AUTHORIZE_CODE constant is not set. You need to override this constant in your configuration class.'
    ]);

    WlAssertException::assertTrue(is_string(static::AUTHORIZE_ID) && strlen(static::AUTHORIZE_ID)>0,[
      'text_class' => static::class,
      'text_message' => 'The AUTHORIZE_ID constant is not set. You need to override this constant in your configuration class.'
    ]);

    WlAssertException::assertTrue(is_string(static::COOKIE_TRANSIENT) && strlen(static::COOKIE_TRANSIENT)>0,[
      'text_class' => static::class,
      'text_message' => 'The COOKIE_TRANSIENT constant is not set. Use the correct parent class: WlConfigDeveloper or WlConfigProduction.'
    ]);

    WlAssertException::assertTrue(is_string(static::COOKIE_PERSISTENT) && strlen(static::COOKIE_PERSISTENT)>0,[
      'text_class' => static::class,
      'text_message' => 'The COOKIE_PERSISTENT constant is not set. Use the correct parent class: WlConfigDeveloper or WlConfigProduction.'
    ]);

    WlAssertException::assertTrue(is_array(static::REGION_URL),[
      'text_class' => static::class,
      'text_message' => 'The REGION_URL constant is not set. Use the correct parent class: WlConfigDeveloper or WlConfigProduction.'
    ]);

    $a_region_all = WlRegionSid::all();
    WlAssertException::assertTrue(in_array($id_region,$a_region_all),[
      'id_region' => $id_region,
      'text_class' => static::class,
      'text_message' => 'Region does not exist. Please enter the correct region from "\WellnessLiving\WlRegionSid" class.'
    ]);

    WlAssertException::assertTrue(isset(static::REGION_URL[$id_region]),[
      'text_class' => static::class,
      'text_message' => 'The URL endpoint API is not set for the requested data center region id. Let the developers know about it.'
    ]);

    $o_config = new static();
    $o_config->id_region = $id_region;

    return $o_config;
  }

  /**
   * Returns CSRF code.
   *
   * @param string $s_session_key Session key.
   * @return string Returns CSRF code based on specified session key.
   * @throws WlAssertException In a case of an error with configuration settings.
   */
  final public function csrfCode(string $s_session_key): string
  {
    $t_time = time();
    return hash('sha3-512',$s_session_key.'::'.$this::AUTHORIZE_CODE.'::'.$t_time).'.'.$t_time.'.'.substr($s_session_key,0,5);
  }

  /**
   * Returns URL of the server in the current configuration (including trailing slash).
   *
   * @return string URL of the server in the current configuration (including trailing slash).
   */
  final public function url(): string
  {
    return static::REGION_URL[$this->id_region];
  }
}