<?php
/*********************************************************************
    index.php
    
    Support System landing page. Please customize it to fit your needs.
    
    Copyright (c)  2012-2014 Katak Support
    http://www.katak-support.com/
    
    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    Derived from osTicket v1.6 by Peter Rotich.
    See LICENSE.TXT for details.

    $Id: $
**********************************************************************/
require('user.inc.php');

require(USERINC_DIR . 'header.inc.php');
$entity = 'MyEDC of Johor';
?>

  <div id='landingpage'>
    <div id='title'><?= sprintf(_('Welcome to Helpdesk System %s'), $entity) ?></div>
    <div id="subtitle">  
<!--       <?= _('In order to better support you, we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress online. For your reference we provide complete history of all your support requests.') ?> -->
<!--       <?= _('A valid email address is required to access the support system.') ?> -->
		<?= _('EDC provides a one-stop center through a combination of various government agencies in connection with the promotion and development of entrepreneurs for advice, consultation issues, assistance, training and program implementation support to provide fast service, efficient and accurate.') ?>
<!-- 	<?= _('EDC menyediakan satu pusat sehenti menerusi gabungan pelbagai agensi-agensi kerajaan yang berkaitan dengan penggalakan dan pembangunan usahawan agar khidmat masihat, rundingan permasalahan, bantuan, perlaksanaan program latihan dan sebagainya dengan cepat, efisien dan tepat.') ?> -->
		<table width="100%" cellspacing="5px" border=0>
			<tr><td width="35%"><?= _('<b>Training / Courses</b>') ?> </td><td width="35%"><?= _('<b>Marketing</b>') ?> </td><td width="30%"><?= _('<b>New Business Areas</b>') ?> </td></tr>
			<tr><td><?= _('*Coordinate and training courses organized by state<br>*Entrepreneurial Culture') ?> </td><td rowspan="5" valign="top"><?= _('*Johor Entrepreneurs Movement<br>*Entrepreneurs Star Rating<br>*Johor Bumiputera Entreprenenuer Award<br>*Johor Entrepreneur Directory<br>*Flyers Stand - Billboard Reviews<br>*Establishment PUJB Retail SB<br>*Business Matching') ?> </td><td><?= _('*Online Business<br>*Cosmetic and retail industry<br>*Argopreneur<br>*Children early education') ?> </td></tr>
			<tr><td><?= _('<b>Groom Big</b>') ?> </td><td><?= _('<b>Support Industry</b>') ?> </td></tr>
			<tr><td><?= _('*Upgrading the product to a wider market') ?> </td><td rowspan="3" valign="top"><?= _('*Oil & Gas Industry<br>*Hub Industry Chocolate<br>*Creative Industry<br>*Medical Industry') ?> </td></tr>
			<tr><td><?= _('<b>One-Stop Center for Reference</b>') ?> </td></tr>
			<tr><td><?= _('*Reference to entrepreneurs, information on related agencies, the offered initiative schemes') ?> </td></tr>
		</table>
    </div>
  </div>

<?php require(USERINC_DIR . 'footer.inc.php'); ?>
