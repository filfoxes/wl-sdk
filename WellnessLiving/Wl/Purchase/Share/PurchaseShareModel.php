<?php

namespace WellnessLiving\Wl\Purchase\Share;

use WellnessLiving\WlModelAbstract;

/**
 * An endpoint that shares a purchase to a specified social network.
 */
class PurchaseShareModel extends WlModelAbstract
{
  /**
   * The social network. One of the {@link \WellnessLiving\Core\a\ASocialSid} constants.
   *
   * @post post
   * @var int
   */
  public $id_social = 0;

  /**
   * The key of the purchase.
   *
   * @post post
   * @var string
   */
  public $k_purchase = '0';

  /**
   * The URL to the sharing page.
   *
   * @post result
   * @var string
   */
  public $url_share = '';
}

?>