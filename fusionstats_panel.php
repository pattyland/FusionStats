<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: fusionstats_panel.php
| CVS Version: 1.00
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

if (iGUEST) include INCLUDES."infusions_include.php";
$inf_settings = get_settings("fusionstats_panel");

echo "<!-- FusionStats -->";
echo '<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://'.preg_replace("(^https?://)", "", $inf_settings['url']).'/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", '.$inf_settings['site_id'].']);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="'.$inf_settings['url'].'/piwik.php?idsite='.$inf_settings['site_id'].'" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->';


?>