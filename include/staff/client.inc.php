<?php
if(!defined('KTKADMININC') || !$thisuser->isadmin()) die(_('Access Denied'));

$rep=null;
$newuser=true;
if($client && $_REQUEST['a']!='new'){
    $rep=$client->getInfo();
    $title=sprintf(_('Update: %s'), $rep['client_email']);
    $action='update';
    $pwdinfo=_('To reset the password enter a new one below (min. 6 chars.)');
    $newuser=false;
}else {
    $title=_('New Client');
    $pwdinfo=_('Password required (min. 6 chars.)');
    $action='create';
    $rep['client_isactive']=isset($rep['client_isactive'])?$rep['client_isactive']:1;
}
$rep=($errors && $_POST)?Format::input($_POST):Format::htmlchars($rep);

//get the goodies.
?>
<div class="msg"><?=$title?></div>
<form action="admin.php" method="post">
  <input type="hidden" name="do" value="<?=$action?>">
  <input type="hidden" name="a" value="<?=Format::htmlchars($_REQUEST['a'])?>">
  <input type="hidden" name="t" value="client">
  <input type="hidden" name="client_id" value="<?=$rep['client_id']?>">
  <input type="hidden" name="old_client_email" value="<?=$rep['client_email']?>">
  <table width="100%" border="0" cellspacing=0 cellpadding=2 class="tform">
      <tr class="header"><td colspan=2><?= _('Akaun Syarikat') ?></td></tr>
      <tr class="subheader"><td colspan=2><?= _('Maklumat Syarikat') ?></td></tr>
      <tr>
          <th><?= _('Emel (Login):') ?></th>
          <td><input type="text" name="client_email" value="<?=$rep['client_email']?>">
              &nbsp;<font class="error">*&nbsp;<?=$errors['email']?></font></td>
      </tr>
      <tr>
          <th><?= _('Nama Penuh:') ?></th>
          <td>
              <input type="text" name="client_firstname" size=30 value="<?=$rep['client_firstname']?>">&nbsp;
              &nbsp;&nbsp;&nbsp;<input type="text" name="client_lastname" size=30 value="<?=$rep['client_lastname']?>">
              &nbsp;<font class="error">&nbsp;<?=$errors['name']?></font></td>
      </tr>
      <tr>
          <th><?= _('Syarikat:') ?></th>
          <td>
              <input type="text" name="client_organization" size=66 value="<?=$rep['client_organization']?>" >
                  &nbsp;<font class="error">&nbsp;<?=$errors['organization']?></font></td>
      </tr>
      <tr>
      	<th><?= _('Produk:') ?></th>
      	<td>
              <input type="text" name="client_product" size=66 value="<?=$rep['client_product']?>" >
                  &nbsp;<font class="error">&nbsp;<?=$errors['product']?></font></td>
      </tr>
      <tr>
          <th><?= _('Telefon Pejabat:') ?></th>
          <td>
              <input type="text" name="client_phone" size=30 value="<?=$rep['client_phone']?>" >
                  &nbsp;<font class="error">&nbsp;<?=$errors['phone']?></font></td>
      </tr>
      <tr>
          <th><?= _('Telefon Tangan:') ?></th>
          <td>
              <input type="text" name="client_mobile" size=30 value="<?=$rep['client_mobile']?>" >
                  &nbsp;<font class="error">&nbsp;<?=$errors['mobile']?></font></td>
      </tr>
      <tr>
          <th><?= _('Kata Laluan:') ?></th>
          <td><i><?=$pwdinfo?></i><br/>
              <input type="password" name="npassword" AUTOCOMPLETE=OFF >
                  &nbsp;<font class="error">*&nbsp;<?=$errors['npassword']?></font></td>
      </tr>
      <tr>
          <th><?= _('Kata Laluan (Semakan):') ?></th>
          <td class="mainTableAlt"><input type="password" name="vpassword" AUTOCOMPLETE=OFF >
              &nbsp;<font class="error">*&nbsp;<?=$errors['vpassword']?></font></td>
      </tr>
      <tr class="subheader"><td colspan=2><?= _('Account Permission, Status &amp; Settings') ?></td></tr>
      <tr><th><b><?= _('Status Akaun') ?></b></th>
          <td>
              <input type="radio" name="client_isactive"  value="1" <?=$rep['client_isactive']?'checked':''?> /><b><?= _('Aktif') ?></b>
              <input type="radio" name="client_isactive"  value="0" <?=!$rep['client_isactive']?'checked':''?> /><b><?= _('Tutup') ?></b>
          </td>
      </tr>
  </table>
  <div class="centered">
      <input class="button" type="submit" name="submit" value="<?= _('Hantar') ?>">
      <input class="button" type="reset" name="reset" value="<?= _('Padam') ?>">
      <input class="button" type="button" name="cancel" value="<?= _('Batal') ?>" onClick='window.location.href="admin.php?t=client"'>
  </div>
</form>