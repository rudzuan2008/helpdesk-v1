<?php
if(!defined('KTKADMININC') || !$thisuser->isadmin()) die(_('Access Denied'));

$info['phrase']=($errors && $_POST['phrase'])?Format::htmlchars($_POST['phrase']):$cfg->getAPIPassphrase();
$select='SELECT * ';
$from='FROM '.API_KEY_TABLE;
$where='';
$sortOptions=array('date'=>'created','ip'=>'ipaddr');
$orderWays=array('DESC'=>'DESC','ASC'=>'ASC');
//Sorting options...
if($_REQUEST['sort']) {
    $order_column =$sortOptions[$_REQUEST['sort']];
}

if($_REQUEST['order']) {
    $order=$orderWays[$_REQUEST['order']];
}
$order_column=$order_column?$order_column:'ipaddr';
$order=$order?$order:'ASC';
$order_by=" ORDER BY $order_column $order ";

$total=db_count('SELECT count(*) '.$from.' '.$where);
$pagelimit=1000;//No limit.
$page=($_GET['p'] && is_numeric($_GET['p']))?$_GET['p']:1;
$pageNav=new PageNate($total,$page,$pagelimit);
$pageNav->setURL('admin.php',$qstr.'&sort='.urlencode($_REQUEST['sort']).'&order='.urlencode($_REQUEST['order']));
$query="$select $from $where $order_by";
//echo $query;
$result = db_query($query);
$showing=db_num_rows($result)?$pageNav->showing():'';
$negorder=$order=='DESC'?'ASC':'DESC'; //Negate the sorting..
$deletable=0;
?>
<div class="msg"><?= _('API Keys')?></div>
<hr>
<div><b><?=$showing?></b></div>
<form action="admin.php?t=api" method="POST" name="api" onSubmit="return checkbox_checker(document.forms['api'],1,0);">
  <input type=hidden name='t' value='api'>
  <input type=hidden name='do' value='mass_process'>
  <table border="0" cellspacing=0 cellpadding=2 class="dtable" align="center" width="100%">
    <tr>
      <th width="7px">&nbsp;</th>
      <th><?= _('API Key') ?></th>
      <th width="10" nowrap><?= _('Active') ?></th>
      <th width="100" nowrap>&nbsp; <?= _('IP Address') ?></th>
      <th width="150" nowrap>&nbsp; <a href="admin.php?t=api&sort=date&order=<?=$negorder?><?=$qstr?>" title="<?= _('Sort By Date of Creation') ?> <?=$negorder?>"><?= _('Created') ?></a></th>
    </tr>
    <?php
    $class = 'row1';
    $total=0;
    $active=$inactive=0;
    $sids=($errors && is_array($_POST['ids']))?$_POST['ids']:null;
    if($result && db_num_rows($result)):
        $dtpl=$cfg->getDefaultTemplateId();
        while ($row = db_fetch_array($result)) {
            $sel=false;
            $disabled='';
            if($row['isactive'])
                $active++;
            else
                $inactive++;
                
            if($sids && in_array($row['id'],$sids)){
                $class="$class highlight";
                $sel=true;
            }
            ?>
        <tr class="<?=$class?>" id="<?=$row['id']?>">
            <td width=7px>
              <input type="checkbox" name="ids[]" value="<?=$row['id']?>" <?=$sel?'checked':''?>
                    onClick="highLight(this.value,this.checked);">
            </td>
            <td>&nbsp;<?=$row['apikey']?></td>
            <td><?=$row['isactive']?'<b>Yes</b>':'No'?></td>
            <td>&nbsp;<?=$row['ipaddr']?></td>
            <td>&nbsp;<?=Format::db_datetime($row['created'])?></td>
        </tr>
        <?php
        $class = ($class =='row2') ?'row1':'row2';
        } //end of while.
    else: //nothin' found!! ?> 
       <tr class="<?=$class?>"><td colspan=5><b><?php _('Query returned 0 results') ?></b>&nbsp;&nbsp;<a href="admin.php?t=templates"><?php _('Index list') ?></a></td></tr>
    <?php
    endif; ?>
  </table><br />
  <div class="centered">
    <?php
    if(db_num_rows($result)>0): //Show options..
       if($inactive) {?>
            <input class="button" type="submit" name="enable" value="<?= _('Enable') ?>"
                   onClick='return confirm("<?= _('Are you sure you want to ENABLE selected keys?') ?>");'>
        <?php
        }
        if($active){?>
        &nbsp;&nbsp;
        <input class="button" type="submit" name="disable" value="<?= _('Disable') ?>"
               onClick='return confirm("<?= _('Are you sure you want to DISABLE selected keys?') ?>");'>
        <?php } ?>
        &nbsp;&nbsp;
        <input class="button" type="submit" name="delete" value="<?= _('Delete') ?>"
                 onClick='return confirm("<?= _('Are you sure you want to DELETE selected keys?') ?>");'>
    <?php
    endif;
    ?>
  </div>
</form>
<br />
<div class="msg"><?= _('Add New IP') ?></div>
<hr>
<div>
  <?= _('Add a new IP address.') ?>&nbsp;&nbsp;<font class="error"><?=$errors['ip']?></font>
  <form action="admin.php?t=api" method="POST" >
    <input type=hidden name='t' value='api'>
    <input type=hidden name='do' value='add'>
    <?= _('New IP') ?>:
    <input name="ip" size=30 value="<?=($errors['ip'])?Format::htmlchars($_REQUEST['ip']):''?>" />
    <font class="error">*&nbsp;</font>&nbsp;&nbsp;
     &nbsp;&nbsp; <input class="button" type="submit" name="add" value="<?= _('Add') ?>">
  </form>
</div>
<br />
<div class="msg"><?= _('API Passphrase') ?></div>
<hr>
<div>
   <?= _('Passphrase must be at least 3 words. Required to generate the api keys.') ?><br/>
  <form action="admin.php?t=api" method="POST" >
    <input type=hidden name='t' value='api'>
    <input type=hidden name='do' value='update_phrase'>
    <?= _('Phrase:') ?>
    <input name="phrase" size=50 value="<?=Format::htmlchars($info['phrase'])?>" />
    <font class="error">*&nbsp;<?=$errors['phrase']?></font>&nbsp;&nbsp;
    &nbsp;&nbsp; <input class="button" type="submit" name="update" value="<?= _('Submit') ?>">
  </form>
  <br /><br />
  <div><i><?= _('Please note that changing the passprase does NOT invalidate existing keys. To regerate a key you need to delete and readd it.') ?></i></div>
</div>