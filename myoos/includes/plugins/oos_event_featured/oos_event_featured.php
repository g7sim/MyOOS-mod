<?php
/**
   ----------------------------------------------------------------------
   $Id: oos_event_featured.php,v 1.1 2007/06/08 15:02:12 r23 Exp $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ----------------------------------------------------------------------
 */

  /**
   * ensure this file is being included by a parent file
   */
  defined('OOS_VALID_MOD') or die('Direct Access to this location is not allowed.');


class oos_event_featured
{
    public $name;
    public $description;
    public $uninstallable;
    public $depends;
    public $preceeds;
    public $author;
    public $version;
    public $requirements;


    /**
     *  class constructor
     */
    public function __construct()
    {
        $this->name          = PLUGIN_EVENT_FEATURED_NAME;
        $this->description   = PLUGIN_EVENT_FEATURED_DESC;
        $this->uninstallable = true;
        $this->author        = 'MyOOS Development Team';
        $this->version       = '2.0';
        $this->requirements  = array(
                             'oos'         => '1.7.0',
                             'smarty'      => '2.6.9',
                             'adodb'       => '4.62',
                             'php'         => '5.9.0'
        );
    }

    public static function create_plugin_instance()
    {
        include_once MYOOS_INCLUDE_PATH . '/includes/functions/function_featured.php';
        oos_expire_featured();

        return true;
    }

    public function install()
    {
        $dbconn =& oosDBGetConn();
        $oostable =& oosDBGetTables();

        $blocktable = $oostable['block'];
        $dbconn->Execute(
            "UPDATE $blocktable
                        SET block_status = 1
                        WHERE block_file = 'specials'"
        );

        $today = date("Y-m-d H:i:s");

        $configurationtable = $oostable['configuration'];
        $dbconn->Execute("INSERT INTO $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('MAX_DISPLAY_FEATURED_PRODUCTS', '6', 6, 1, NULL, " . $dbconn->DBTimeStamp($today) . ", NULL, NULL)");

        return true;
    }

    public function remove()
    {
        $dbconn =& oosDBGetConn();
        $oostable =& oosDBGetTables();

        $configurationtable = $oostable['configuration'];
        $dbconn->Execute("DELETE FROM $configurationtable WHERE configuration_key in ('" . implode("', '", $this->config_item()) . "')");

        return true;
    }

    public function config_item()
    {
        return array('MAX_DISPLAY_FEATURED_PRODUCTS');
    }
}
