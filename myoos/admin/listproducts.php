<?php
/**
   ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: validproducts.php,v 0.01 2002/08/17 15:38:34 Richard Fielder
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   Copyright (c) 2002 Richard Fielder
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ----------------------------------------------------------------------
 */

  define('OOS_VALID_MOD', 'yes');
  require 'includes/main.php';

?>
<html>
<head>
<title>Valid Categories/Products List - Administration [OOS]</title>
<style type="text/css">
<!--
h4 {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; text-align: center}
p {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small}
th {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small}
td {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small}
-->
</style>
<head>
<body>
<table width="550" border="1" cellspacing="1" bordercolor="gray">
<tr>
<td colspan="3">
<h4>Valid Products List</h4>
</td>
</tr>
<?php
   $coupon_get = $dbconn->Execute("SELECT restrict_to_products,restrict_to_categories FROM " . $oostable['coupons'] . "  WHERE coupon_id='".$_GET['cid']."'");
   $get_result = $coupon_get->fields;

    echo "<tr><th>Product ID</th><th>Product Name</th><th>Product Size</th></tr><tr>";
    $pr_ids = preg_split("/[,]/", $get_result['restrict_to_products']);
for ($i = 0; $i < count($pr_ids); $i++) {
    $sql = "SELECT 
                p.products_id, p.products_model, p.products_status, pd.products_name
            FROM 
                " . $oostable['products'] . " p, 
                " . $oostable['products_description'] . " pd 
            WHERE 
                p.products_status >= '1' AND
                pd.products_id = p.products_id AND
                pd.products_languages_id = '" . intval($_SESSION['language_id']) . "'
                pd.products_id = '" . $pr_ids[$i] . "'";
    $result = $dbconn->Execute($sql);
    if ($row = $result->fields) {
        echo "<td>".$row["products_id"]."</td>\n";
        echo "<td>".$row["products_name"]."</td>\n";
        echo "<td>".$row["products_model"]."</td>\n";
        echo "</tr>\n";
    }
}
      echo "</table>\n";
?>
<br>
<table width="550" border="0" cellspacing="1">
<tr>
<td align=middle><input type="button" value="Close Window" onClick="window.close()"></td>
</tr></table>

<?php require 'includes/bottom.php'; ?>
<?php require 'includes/nice_exit.php'; ?>