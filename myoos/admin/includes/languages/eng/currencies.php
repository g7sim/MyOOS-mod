<?php
/**
   ----------------------------------------------------------------------
   $Id: currencies.php,v 1.3 2007/06/13 16:38:21 r23 Exp $

   MyOOS [Shopsystem]
   https://www.oos-shop.de


   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: currencies.php,v 1.10 2002/01/12 17:20:32 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ----------------------------------------------------------------------
 */


define('HEADING_TITLE', 'Currencies');

define('TABLE_HEADING_CURRENCY_NAME', 'Currency');
define('TABLE_HEADING_CURRENCY_CODES', 'Code');
define('TABLE_HEADING_CURRENCY_VALUE', 'Value');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_INFO_CURRENCY_TITLE', 'Title:');
define('TEXT_INFO_CURRENCY_CODE', 'Code:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol Left:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol Right:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Decimal Point:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Thousands Point:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Decimal Places:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Last Updated:');
define('TEXT_INFO_CURRENCY_VALUE', 'Value:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Example Output:');
define('TEXT_INFO_INSERT_INTRO', 'Please enter the new currency with its related data');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this currency?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'New Currency');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Edit Currency');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Delete Currency');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (requires a manual update of currency values)');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Error: The default currency can not be removed. Please set another currency as default, and try again.');
