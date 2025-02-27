<?php
namespace WellnessLiving\Wl\Login\Permission;

use WellnessLiving\WlModelAbstract;

/**
 * Make purchased promotion auto-renewable.
 *
 * The POST method make auto-renewable or not auto-renewable based on <tt>>is_renew</tt> parameter.
 */
class PermissionModel extends WlModelAbstract
{
    /**
     * <tt>true</tt> - make purchased promotion auto-renewable; <tt>false</tt> - otherwise.
     *
     * @post post
     * @var bool
     */
    public $is_renew = false;

    /**
     * Key of purchased promotion.
     *
     * @post get
     * @var string
     */
    public $k_login_promotion = '0';
}

?>