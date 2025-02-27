<?php 

namespace WellnessLiving\Wl\Appointment\Book\Service;

use WellnessLiving\WlModelAbstract;

/**
 * Retrieves information about services in the current service category.
 */
class ServiceListModel extends WlModelAbstract
{
  /**
   * The class tab key to filter services. If empty, find on a standard book now tab.
   *
   * If multiple tabs are sent, appointment types, which are in at least one of the tabs, will be in the result.
   *
   * @get get
   * @var string[]
   */
  public $a_class_tab = [];

  /**
   * A list of services with information about them.
   *
   * Key - the service key from {@link \RsServiceSql} table
   * Value - an array, where every element has next keys:
   * <dl>
   *   <dt>
   *     array <var>a_class_tab</var>
   *   </dt>
   *   <dd>
   *     The list of tab keys for service.
   *   </dd>
   *   <dt>
   *     array <var>a_image</var>
   *   </dt>
   *   <dd>
   *     The appointment image. See {@link \RsServiceLogo::data()} for details.
   *   </dd>
   *   <dt>
   *     string <var>f_deposit</var>
   *   </dt>
   *   <dd>
   *     The amount of deposit required.
   *   </dd>
   *   <dt>
   *     string <var>f_offline_max</var>
   *   </dt>
   *   <dd>
   *     The maximum offline price.
   *   </dd>
   *   <dt>
   *     string <var>f_offline_min</var>
   *   </dt>
   *   <dd>
   *     The minimum offline price.
   *   </dd>
   *   <dt>
   *     string <var>f_online</var>
   *   </dt>
   *   <dd>
   *     The online price.
   *   </dd>
   *   <dt>
   *     bool <var>hide_application</var>
   *   </dt>
   *   <dd>
   *      Whether services will be hidden in the White Label mobile application.
   *      <tt>true</tt> means that service won't be displayed; <tt>false</tt> if otherwise.
   *   </dd>
   *   <dt>
   *     int <var>i_age_from</var>
   *   </dt>
   *   <dd>
   *     The required minimum client age to book an appointment.
   *   </dd>
   *   <dt>
   *     int <var>i_age_to</var>
   *   </dt>
   *   <dd>
   *     The required maximum client age to book an appointment.
   *   </dd>
   *   <dt>
   *     int <var>i_price</var>
   *   </dt>
   *   <dd>
   *     The price type. One of {@link \RsServicePriceSid} constants.
   *   </dd>
   *   <dt>
   *     int <var>i_duration</var>
   *   </dt>
   *   <dd>
   *     The appointment duration in minutes.
   *   </dd>
   *   <dt>
   *     int <var>id_book_flow</var>
   *   </dt>
   *   <dd>
   *     The type of client booking flow. One of {@link \Wl\Service\ServiceBookFlowSid} constants.
   *   </dd>
   *   <dt>
   *     int <var>id_service_require</var>
   *   </dt>
   *   <dd>
   *     The required payment type. One of {@link \RsServiceRequireSid} constants.
   *   </dd>
   *   <dt>
   *     bool <var>is_book_repeat_client</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if clients can book classes and appointments on a recurring basis, <tt>false</tt> if otherwise.
   *   </dd>
   *   <dt>
   *     bool <var>is_deposit_percent</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if <var>f_deposit</var> is percents; <tt>false</tt> if <var>f_deposit</var> is an amount of
   *     money.
   *   </dd>
   *   <dt>
   *     bool <var>is_gender_select</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if clients can select a staff member's gender; <tt>false</tt> if otherwise.
   *   </dd>
   *   <dt>
   *     bool <var>is_online_sell</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if clients can buy this appointment; <tt>false</tt> if only staff members can sell it.
   *   </dd>
   *   <dt>
   *     bool <var>is_resource_type</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if the service requires assets; <tt>false</tt> if otherwise.
   *   </dd>
   *   <dt>
   *     bool <var>is_single_buy</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if the appointment can be booked without a Purchase Option; <tt>false</tt> if it's necessary to
   *     buy a Purchase Option.
   *   </dd>
   *   <dt>
   *     bool <var>is_staff_confirm</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if the appointment must be confirmed by a staff member after booking; <tt>false</tt> if
   *     otherwise.
   *   </dd>
   *   <dt>
   *     bool <var>is_staff_skip</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if clients can select staff members for the appointment; <tt>false</tt> if otherwise.
   *   </dd>
   *   <dt>
   *     bool <var>is_question</var>
   *   </dt>
   *   <dd>
   *     Whether the service will ask for questions or not.
   *   </dd>
   *   <dt>
   *     bool <var>is_virtual</var>
   *   </dt>
   *   <dd>
   *     <tt>true</tt> if service is virtual; <tt>false</tt> if otherwise.
   *   </dd>
   *   <dt>
   *     string <var>k_service</var>
   *   </dt>
   *   <dd>
   *     The appointment primary key in {@link \RsServiceSql} table.
   *   </dd>
   *   <dt>
   *     string <var>k_service_category</var>
   *   </dt>
   *   <dd>
   *     The service category primary key in {@link \RsServiceCategorySql} table.
   *   </dd>
   *   <dt>
   *     string <var>s_duration</var>
   *   </dt>
   *   <dd>
   *     The appointment duration in a human readable format.
   *   </dd>
   *   <dt>
   *     string <var>s_service</var>
   *   </dt>
   *   <dd>
   *     The appointment title.
   *   </dd>
   *   <dt>
   *     string <var>xml_describe</var>
   *   </dt>
   *   <dd>
   *     The appointment description.
   *   </dd>
   * </dl>
   *
   * @get result
   * @var array
   */
  public $a_service;

  /**
   * <tt>true</tt> - return all active services of a certain location;
   * <tt>false</tt> - return only services which are bound to a book now tab.
   *
   * @get get
   * @var bool
   */
  public $is_backend = false;

  /**
   * <tt>true</tt> - find in all book now tabs;
   * <tt>false</tt> - find only in selected book now tabs.
   *
   * @get get
   * @var bool
   */
  public $is_tab_all = false;

  /**
   * The class tab key to filter services. If empty or <tt>'0'</tt>, found on the standard book now tab.
   *
   * @get get
   * @var string
   */
  public $k_class_tab = '0';

  /**
   * The location to show the available appointments' booking schedule.
   *
   * The primary key in {@link \RsLocationSql} table.
   *
   * @get get,result
   * @post get
   * @var string
   */
  public $k_location = '0';

  /**
   * The key of a service category for which to show information.
   *
   * @get get
   * @var string
   */
  public $k_service_category = '0';

  /**
   * The user for whom to get information.
   *
   * The primary key in {@link \PassportLoginSql} table.
   *
   * @get get
   * @post get
   * @var string
   */
  public $uid = '0';
}

?>