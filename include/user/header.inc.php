<?php
$title=($cfg && is_object($cfg))?$cfg->getTitle():_('EDC Support - Ticket System');
header("Content-Type: text/html; charset=UTF-8\r\n");
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title><?=Format::htmlchars($title)?></title>
  
  <link rel="stylesheet" href="./styles/user.css" media="screen, print">
  <link rel="stylesheet" href="./styles/print.css" media="print">
  <link rel="stylesheet" href="./styles/colors.css" media="screen, print">
  
  <script src="./js/multifile.js" type="text/javascript"></script>
</head>
<body>
<div id="container">
  <div id="left-top-block">
  	   <div style="padding-right: 10px; padding-top: 20px; float:right;font-size: 10pt; padding:4px 4px 8px 4px;text-align:center;">
  	   
  	  <?php   
      if ($_SESSION["LANGUAGE"]=="en") {
			echo '<a href="?lang=ms_MY"><span>Bahasa Malaysia</span></a>';
	  } else {
			echo '<a href="?lang=en"><span>English</span></a>';
	  }
	  
		//echo getenv("LANGUAGE");  
	  ?>
	  &nbsp;|&nbsp;<a id="logo" href="mhelpdesk/index.html"><?=_('Mobile Version')?></a>
	  &nbsp;|&nbsp;<a id="logo" href="download.php"><?=_('Download')?></a>
	  </div>
	  <?php                    
      if($thisuser && is_object($thisuser) && $thisuser->isValid()) {?>
        <span id="info"><?= _('Login') ?>: <b><i><?=$thisuser->getUserName()?></i></b>&nbsp;|&nbsp;</span>
      <?php } ?>
	  	
  	  <div style="padding-left: 10px; padding-top: 30px;">
      <a id="logo" href="index.php" title="<?=_('EDC Support Center')?>"><img src="./images/logo-edc.png" alt="<?=_('EDC Support Center')?>"></a>
      </div>
      
     
  </div>
  <div id="right-top-block">
       <?php                    
       if($thisuser && is_object($thisuser) && $thisuser->isValid()) {?>
         <a class="log_out" href="logout.php"><span><?=_('Logout')?></span></a>
         <a class="faq" href="faq.php"><span><?=_('FAQ')?></span></a>
         <a class="query_client" href="client.php"><span><?=_('Search')?></span></a>
         
         <a class="new_ticket" href="open.php"><span><?=_('Ticket')?></span></a>
         <a class="my_tickets" href="tickets.php"><span><?=_('Status')?></span></a> 
         
       <?php } elseif(!$cfg->getUserLogRequired()) { ?>
       	 <a class="faq" href="faq.php"><span><?=_('FAQ')?></span></a>
       	 <a class="query_client" href="client.php"><span><?=_('Search')?></span></a>
         <a class="ticket_status" href="tickets.php"><span><?=_('Status')?></span></a>
         
         <a class="new_ticket" href="open.php"><span><?=_('Ticket')?></span></a>
         
       <?php } else { ?>
         <a class="user_login" href="tickets.php"><span><?=_('Log-in')?></span></a>
       <?php } ?>
       <a class="home" href="index.php"><span><?=_('Home')?></span></a>
  </div>
  
  	 
  <div id="content">
