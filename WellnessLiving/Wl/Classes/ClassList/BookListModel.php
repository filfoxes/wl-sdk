<?php

namespace WellnessLiving\Wl\Classes\ClassList;

use WellnessLiving\WlModelAbstract;

/**
 * The endpoint to get all the classes for a location.
 */
class BookListModel extends WlModelAbstract
{
  /**
   * A class list. Every element has the following structure:
   * <dl>
   *   <dt>array <var>a_class_tab</var></dt>
   *   <dd>The list of tab keys for the class.</dd>
   *
   *   <dt>bool <var>is_active</var></dt>
   *   <dd><tt>true</tt> if the class is active; <tt>false</tt> otherwise.</dd>
   *
   *   <dt>bool <var>is_event</var></dt>
   *   <dd><tt>true</tt> for events; <tt>false</tt> for classes.</dd>
   *
   *   <dt>sting <var>k_class</var></dt>
   *   <dd>The class key. The primary key in {@link \RsClassSql} table.</dd>
   *
   *   <dt>sting <var>k_enrollment_block</var></dt>
   *   <dd>The enrollment block key. The primary key in {@link \RsEnrollmentBlockSql} table.</dd>
   *
   *   <dt>sting <var>text_description</var></dt>
   *   <dd>The description of the class.</dd></dl>
   *
   *   <dt>sting <var>text_title</var></dt>
   *   <dd>The name of the class.</dd>
   * </dl>
   *
   * <tt>null</tt> if not yet loaded.
   *
   * @get result
   * @var array[]|null
   */
  public $a_class = null;

  /**
   * The location key.
   *
   * @get get
   * @var string
   */
  public $k_location = '0';
}

?>