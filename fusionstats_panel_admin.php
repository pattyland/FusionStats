<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: fusionstats_panel_admin.php
| Author: pattyland
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
require_once THEMES."templates/admin_header.php";

include INCLUDES."infusions_include.php";

if (!checkrights("fs") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect(BASEDIR . "index.php"); }

if (file_exists(INFUSIONS."fusionstats_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."fusionstats_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."fusionstats_panel/locale/English.php";
}

if (isset($_POST["fs_url"]) && trim($_POST["fs_url"]) != "") {
	set_setting("url", rtrim(trim($_POST['fs_url']), "/"), "fusionstats_panel");
}

if (isset($_POST["fs_site_id"]) && is_numeric($_POST["fs_site_id"]) != "") {
	set_setting("site_id", $_POST['fs_site_id'], "fusionstats_panel");
}

if (isset($_POST["fs_admin_tracking"]) && trim($_POST["fs_admin_tracking"]) == "1") {
	set_setting("admin_tracking", 1, "fusionstats_panel");
} else {
	set_setting("admin_tracking", 0, "fusionstats_panel");
}


$inf_settings = get_settings("fusionstats_panel");
$piwikjs_url = $inf_settings['url']."/piwik.js";

$message = "";
if (dbrows(dbquery("SELECT * FROM ".DB_PANELS." where panel_filename='fusionstats_panel' AND panel_status = 1")) < 1) $message .= $locale['fs_panelerror']."<br>";
if (!check_piwik_url($piwikjs_url)) $message .= "<a href='".$piwikjs_url."' target='_blank'>".$inf_settings['url']."</a>".$locale['fs_piwik_url_error']."<br>";
if (isset($message) && trim($message) != "") {	echo "<div class='admin-message'>".$message."</div>\n"; }


opentable($locale['fs_title']);
?>
<!--<div><img src="img/fusionStats_gr.png" style="float: right; height: 250px; width: auto;"></div>-->
<form role="form" method="post">
  <div class="form-group">
    <label for="ps_url">Piwik URL</label>
    <input type="url" class="form-control" id="ps_url" placeholder="http://piwik.example.org" size="50" maxlength="200" value="<?php echo $inf_settings['url']; ?>" name="fs_url">
  </div>
  <div class="form-group">
    <label for="ps_site_id">Piwik Site ID</label>
    <input type="number" class="form-control" id="ps_url" placeholder="1" min="1" max="1000" value="<?php echo $inf_settings['site_id']; ?>" name="fs_site_id">
  </div>
  <!--<div class="checkbox">
    <label>
      <input type="checkbox" <?php echo ($inf_settings['admin_tracking'] == 1 ? "checked" : ""); ?> value="1" name="fs_admin_tracking"> Track admins too
    </label>
  </div>-->
  <input type="submit" class="btn btn-default">
</form>
<hr>
<p><a href="http://piwik.org" target="_blank">Piwik Homepage</a> - Infusion on GitHub</p>

<?php
closetable();

require_once THEMES."templates/footer.php";


function check_piwik_url($url) {

	if ($url == "/piwik.js") return true;

	$piwikcheck = file_get_contents($url);

	if (!$piwikcheck) return false;

	if (strpos($piwikcheck,'Piwik - Web Analytics') !== false) {
    	return true;
	} else {
		return false;
	}
}
?>
