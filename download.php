<?php
/*********************************************************************
    client.php

    query client handle.

    Copyright (c)  2012-2014 Katak Support
    http://www.katak-support.com/
    
    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    Derived from osTicket v1.6 by Peter Rotich.
    See LICENSE.TXT for details.

    $Id: $
**********************************************************************/
require('user.inc.php');

require(USERINC_DIR.'header.inc.php');
?>
<div><?= _('Please open the following link from your mobile device to activate installation on Android or IOS device.')?><br /></div>
<br>
<!-- <a href="https://play.google.com/store/apps/details?id=com.domain.edchelpdesk"><img src="images/get_it_on_play.png" style="cursor:pointer;"/></a> -->
<a href="https://play.google.com/store/apps/details?id=com.domain.edchelpdesk"><img src="images/get_it_on_play.png" style="cursor:pointer;"/></a> 

<!-- <a href="http://itunes.apple.com/app/id995754472"><img src="images/get_it_on_App_Store.png" style="cursor:pointer;"/></a> -->
<a href="#"><img src="images/get_it_on_App_Store.png" style="cursor:pointer;"/></a>
<br /><br />

** Download version for <span style="color:green;"><a href="https://play.google.com/store/apps/details?id=com.domain.edchelpdesk">Android is AVAILABLE NOW</a></span>. IOS is not available yet, will be available SOON. Sorry...
<?php
require(USERINC_DIR.'footer.inc.php');
?>