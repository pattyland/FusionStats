<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: infusion.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }

if (file_exists(INFUSIONS."fusionstats_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."fusionstats_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."fusionstats_panel/locale/English.php";
}

$inf_title = $locale['fs_title'];
$inf_description = $locale['fs_desc'];
$inf_version = "0.1";
$inf_developer = "pattyland";
$inf_email = "mail@pattyland.de";
$inf_weburl = "http://pattyland.de";

$inf_folder = "fusionstats_panel";

$thumbnail = ADMIN."images/fusionStats.png";
if (!file_exists($thumbnail)) {
	$check = copy(INFUSIONS.$inf_folder."/img/fusionStats.png", $thumbnail);
}

$inf_insertdbrow[1] = DB_PANELS." SET panel_name='".$locale['fs_title']."', panel_filename='".$inf_folder."', panel_side=4, panel_order='100', panel_type='file', panel_access='0', panel_display='1', panel_status='1' ";
$inf_insertdbrow[2] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('url', '', '".$inf_folder."')";
$inf_insertdbrow[3] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('site_id', '', '".$inf_folder."')";
$inf_insertdbrow[4] = DB_SETTINGS_INF." (settings_name, settings_value, settings_inf) VALUES('admin_tracking', 0, '".$inf_folder."')";

$inf_deldbrow[1] = DB_PANELS." WHERE panel_filename='".$inf_folder."'";
$inf_deldbrow[2] = DB_SETTINGS_INF." WHERE settings_inf='".$inf_folder."'";

$inf_adminpanel[1] = array(
	"title" => $locale['fs_admin1'],
	"image" => "fusionStats.png",
	"panel" => $inf_folder."_admin.php",
	"rights" => "fs"
);

?>