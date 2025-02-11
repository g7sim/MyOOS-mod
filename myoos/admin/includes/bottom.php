<?php
/**
   ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ----------------------------------------------------------------------
 */

/**
 * ensure this file is being included by a parent file
 */
defined('OOS_VALID_MOD') or die('Direct Access to this location is not allowed.');

if (isset($bForm) && ($bForm == true)) {
    ?>
<!-- PARSLEY-->
<script src="js/plugins/parsley/parsley.min.js"></script>
<script src="js/plugins/parsley/i18n/<?php echo $_SESSION['iso_639_1']; ?>.js"></script>
<script >
    window.Parsley.setLocale('<?php echo $_SESSION['iso_639_1']; ?>');
</script>
    <?php
}
?>
<!-- JS GLOBAL Compulsory -->      
<script src="js/jquery/jquery.min.js"></script>
<script src="js/plugins/popper/dist/umd/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/screenfull/dist/screenfull.min.js"></script>
<script src="js/plugins/jquery-storage-api/jquery.storageapi.min.js"></script>
<script src="js/plugins/moment/min/moment-with-locales.min.js"></script>
<script src="js/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="js/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="js/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="js/plugins/mustache/mustache.min.js"></script>
<script src="js/general.js"></script>

<!-- HTML5 shim and Respond.js IE support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="js/plugin/respond.js"></script>
    <script src="js/plugin/html5shiv.js"></script>
<![endif]-->

</body>
</html>