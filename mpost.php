<?php
require('user.inc.php');
require_once(INCLUDE_DIR.'class.ticket.php');
$ticket=null;
$errors=array();
//echo "HERE".$_REQUEST['message'];
$msgid=null;
$msg=null;
//Check if any id is given...
if(($id=$_REQUEST['id']?$_REQUEST['id']:$_POST['ticket_id']) && is_numeric($id)) {
    //id given fetch the ticket info and check perm.
    $ticket= new Ticket($id);
	//echo "email" . $ticket->getEmail();
	if(!$ticket or !$ticket->getEmail()) {
        $ticket=null; //clear.
        $errors['err']=_('Access Denied. Possibly invalid ticket ID');
        //echo $errors['err'];
        $success=false;
        $msg = $errors['err'];
    }
}
//if (!isset($_POST['message'])) {
if(!$_POST['message'] || empty($_POST['message'])) {
    $errors['err']= _('Message required');
    //echo $errors['err'];
    $success=false;
    $msg = $errors['err'];
}
//check attachment..if any is set
if(!$errors){
	//echo "Continue";
	if(($msgid=$ticket->postMessage($_POST['message'],'Web'))) {
		//echo "msgid".$msgid;
		$success=true;
		$msg=_('Message Posted Successfully');
	}else{
        $errors['err']=_('Unable to post the message. Try again');
        //echo $errors['err'];
        $success=false;
        $msg = $errors['err'];
    }
}else{
	//echo "STOP";
	$success=false;
	$msg = $errors['err'];
}

$obj = new stdClass;
$obj->msgid = $msgid;
$obj->success = $success;
$obj->message = $msg;
if (isset($_REQUEST['callback'])) {
    	$callback = $_REQUEST['callback'];
    	header('Content-Type: text/javascript');
    	echo $callback . '(' . json_encode($obj) . ')';
}else {
    	echo json_encode($obj);
}


?>