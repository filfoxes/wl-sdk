<?php

namespace WellnessLiving\Wl\Insurance\Catalog;

use WellnessLiving\WlModelAbstract;

/**
 * An endpoint that retrieves a list of programs' information.
 */
class ProgramListModel extends WlModelAbstract
{
  /**
   * A List of active programs.
   * Every element has next keys:
   *
   * <dl>
   *   <dt>string <var>k_wellness_program</var></dt>
   *   <dd>The insurance key.</dd>
   *   <dt>string <var>m_price</var></dt>
   *   <dd>The Purchase Option price.</dd>
   *   <dt>string <var>text_insurance_organization</var></dt>
   *   <dd>The insurance organization name.</dd>
   *   <dt>string <var>text_partner</var></dt>
   *   <dd>The insurance partner name.</dd>
   *   <dt>string <var>text_program</var></dt>
   *   <dd>The insurance name.</dd>
   *   <dt>string <var>url_insurance_detail</var></dt>
   *   <dd>The insurance organization URL.</dd>
   * </dl>
   *
   * @get result
   * @var array[]
   */
  public $a_wellness_program;

  /**
   * The ID of the business.
   *
   * @get get
   * @var string
   */
  public $k_business = null;

  /**
   * The ID of the promotion.
   *
   * @get get
   * @var string
   */
  public $k_promotion = null;
}

?>