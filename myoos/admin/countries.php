<?php
/** ---------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: countries.php,v 1.25 2002/03/17 17:34:47 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce

   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('OOS_VALID_MOD', 'yes');
require 'includes/main.php';

$nPage = (!isset($_GET['page']) || !is_numeric($_GET['page'])) ? 1 : intval($_GET['page']);
$action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (!empty($action)) {
      switch ($action) {
      case 'insert':
        $dbconn->Execute("INSERT INTO " . $oostable['countries'] . " (countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES ('" . oos_db_input($countries_name) . "', '" . oos_db_input($countries_iso_code_2) . "', '" . oos_db_input($countries_iso_code_3) . "', '" . oos_db_input($address_format_id) . "')");
        oos_redirect_admin(oos_href_link_admin($aContents['countries']));
        break;

      case 'save':
        $countries_id = oos_db_prepare_input($_GET['cID']);

        $dbconn->Execute("UPDATE " . $oostable['countries'] . " SET countries_name = '" . oos_db_input($countries_name) . "', countries_iso_code_2 = '" . oos_db_input($countries_iso_code_2) . "', countries_iso_code_3 = '" . oos_db_input($countries_iso_code_3) . "', address_format_id = '" . oos_db_input($address_format_id) . "' WHERE countries_id = '" . oos_db_input($countries_id) . "'");
        oos_redirect_admin(oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&cID=' . $countries_id));
        break;

      case 'deleteconfirm':
        $countries_id = oos_db_prepare_input($_GET['cID']);

        $dbconn->Execute("DELETE FROM " . $oostable['countries'] . " WHERE countries_id = '" . oos_db_input($countries_id) . "'");
        oos_redirect_admin(oos_href_link_admin($aContents['countries'], 'page=' . $nPage));
        break;
    }
  }
  require 'includes/header.php';
?>
<div class="wrapper">
	<!-- Header //-->
	<header class="topnavbar-wrapper">
		<!-- Top Navbar //-->
		<?php require 'includes/menue.php'; ?>
	</header>
	<!-- END Header //-->
	<aside class="aside">
		<!-- Sidebar //-->
		<div class="aside-inner">
			<?php require 'includes/blocks.php'; ?>
		</div>
		<!-- END Sidebar (left) //-->
	</aside>
	
	<!-- Main section //-->
	<section>
		<!-- Page content //-->
		<div class="content-wrapper">

			<!-- Breadcrumbs //-->
			<div class="content-heading">
				<div class="col-lg-12">
					<h2><?php echo HEADING_TITLE; ?></h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<?php echo '<a href="' . oos_href_link_admin($aContents['default']) . '">' . HEADER_TITLE_TOP . '</a>'; ?>
						</li>
						<li class="breadcrumb-item">
							<?php echo '<a href="' . oos_href_link_admin($aContents['countries'], 'selected_box=taxes') . '">' . BOX_HEADING_LOCATION_AND_TAXES . '</a>'; ?>
						</li>
						<li class="breadcrumb-item active">
							<strong><?php echo HEADING_TITLE; ?></strong>
						</li>
					</ol>
				</div>
			</div>
			<!-- END Breadcrumbs //-->
			
			<div class="wrapper wrapper-content">
				<div class="row">
					<div class="col-lg-12">				
<!-- body_text //-->
	<div class="table-responsive">
		<table class="table w-100">
          <tr>
            <td valign="top">
				<table class="table table-striped table-hover w-100">
					<thead class="thead-dark">
						<tr>
							<th><?php echo TABLE_HEADING_COUNTRY_NAME; ?></th>
							<th class="text-center" colspan="2"><?php echo TABLE_HEADING_COUNTRY_CODES; ?></th>
							<th class="text-right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</th>
						</tr>	
					</thead>
<?php
  $countries_result_raw = "SELECT countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id 
                          FROM " . $oostable['countries'] . " 
                          ORDER BY countries_name";
  $countries_split = new splitPageResults($nPage, MAX_DISPLAY_SEARCH_RESULTS, $countries_result_raw, $countries_result_numrows);
  $countries_result = $dbconn->Execute($countries_result_raw);
  while ($countries = $countries_result->fields) {
      if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $countries['countries_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
          $cInfo = new objectInfo($countries);
      }

      if (isset($cInfo) && is_object($cInfo) && ($countries['countries_id'] == $cInfo->countries_id)) {
          echo '                  <tr onclick="document.location.href=\'' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&cID=' . $cInfo->countries_id . '&action=edit') . '\'">' . "\n";
      } else {
          echo '                  <tr onclick="document.location.href=\'' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&cID=' . $countries['countries_id']) . '\'">' . "\n";
      } ?>
                <td><?php echo $countries['countries_name']; ?></td>
                <td align="center" width="40"><?php echo $countries['countries_iso_code_2']; ?></td>
                <td align="center" width="40"><?php echo $countries['countries_iso_code_3']; ?></td>
                <td class="text-right"><?php if (isset($cInfo) && is_object($cInfo) && ($countries['countries_id'] == $cInfo->countries_id)) {
          echo '<button class="btn btn-info" type="button"><i class="fa fa-eye-slash" title="' . IMAGE_ICON_INFO . '" aria-hidden="true"></i></i></button>';
      } else {
          echo '<a href="' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&cID=' . $countries['countries_id']) . '"><button class="btn btn-default" type="button"><i class="fa fa-eye-slash"></i></button></a>';
      } ?>&nbsp;</td>
              </tr>
<?php
    // Move that ADOdb pointer!
    $countries_result->MoveNext();
  }

?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $countries_split->display_count($countries_result_numrows, MAX_DISPLAY_SEARCH_RESULTS, $nPage, TEXT_DISPLAY_NUMBER_OF_COUNTRIES); ?></td>
                    <td class="smallText" align="right"><?php echo $countries_split->display_links($countries_result_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $nPage); ?></td>
                  </tr>
<?php
  if (empty($action)) {
      ?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&action=new') . '">' . oos_button(IMAGE_NEW_COUNTRY) . '</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = [];
  $contents = [];

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_COUNTRY . '</b>');

      $contents = array('form' => oos_draw_form('id', 'countries', $aContents['countries'], 'page=' . $nPage . '&action=insert', 'post', false));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . oos_draw_input_field('countries_name'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . '<br>' . oos_draw_input_field('countries_iso_code_2'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . '<br>' . oos_draw_input_field('countries_iso_code_3'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . '<br>' . oos_draw_input_field('address_format_id'));
      $contents[] = array('align' => 'center', 'text' => '<br>' . oos_submit_button(BUTTON_INSERT) . '&nbsp;<a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_COUNTRY . '</b>');

      $contents = array('form' => oos_draw_form('id', 'countries', $aContents['countries'], 'page=' . $nPage . '&cID=' . $cInfo->countries_id . '&action=save', 'post', false));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . oos_draw_input_field('countries_name', $cInfo->countries_name));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . '<br>' . oos_draw_input_field('countries_iso_code_2', $cInfo->countries_iso_code_2));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . '<br>' . oos_draw_input_field('countries_iso_code_3', $cInfo->countries_iso_code_3));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . '<br>' . oos_draw_input_field('address_format_id', $cInfo->address_format_id));
      $contents[] = array('align' => 'center', 'text' => '<br>' . oos_submit_button(BUTTON_UPDATE) . '&nbsp;<a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&cID=' . $cInfo->countries_id) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_COUNTRY . '</b>');

      $contents = array('form' => oos_draw_form('id', 'countries', $aContents['countries'], 'page=' . $nPage . '&cID=' . $cInfo->countries_id . '&action=deleteconfirm', 'post', false));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $cInfo->countries_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . oos_submit_button(BUTTON_UPDATE) . '&nbsp;<a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&cID=' . $cInfo->countries_id) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    default:
      if (isset($cInfo) && is_object($cInfo)) {
          $heading[] = array('text' => '<b>' . $cInfo->countries_name . '</b>');

          $contents[] = array('align' => 'center', 'text' => '<a href="' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&cID=' . $cInfo->countries_id . '&action=edit') . '">' . oos_button(BUTTON_EDIT) . '</a> <a href="' . oos_href_link_admin($aContents['countries'], 'page=' . $nPage . '&cID=' . $cInfo->countries_id . '&action=delete') . '">' . oos_button(BUTTON_DELETE) . '</a>');
          $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . $cInfo->countries_name);
          $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . ' ' . $cInfo->countries_iso_code_2);
          $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . ' ' . $cInfo->countries_iso_code_3);
          $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . ' ' . $cInfo->address_format_id);
      }
      break;
  }

    if ((oos_is_not_null($heading)) && (oos_is_not_null($contents))) {
        ?>
	<td class="w-25" valign="top">
		<table class="table table-striped">
<?php
        $box = new box();
        echo $box->infoBox($heading, $contents); ?>
		</table> 
	</td> 
<?php
    }
?>
          </tr>
        </table>
	</div>
<!-- body_text_eof //-->

				</div>
			</div>
        </div>

		</div>
	</section>
	<!-- Page footer //-->
	<footer>
		<span>&copy; <?php echo date('Y'); ?> - <a href="https://www.oos-shop.de" target="_blank" rel="noopener">MyOOS [Shopsystem]</a></span>
	</footer>
</div>


<?php
    require 'includes/bottom.php';
    require 'includes/nice_exit.php';
?>