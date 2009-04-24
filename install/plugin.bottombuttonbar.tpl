/* BottomButtonBar v1.0 (by Mitch)
 *
 * I just got tired of scrolling up after editing a document/snippet/etc... 
 * to save it. The GoUp plugin improved it a bit, but I was not completely 
 * satisfied. So I wrote this plugin that will add the complete buttonbar 
 * at the bottom of the edit screen. Also there is a GoUp link in the bottombar.
 *
 * To use the plugin you have to enable the following events:
 *
 *   OnChunkFormRender
 *   OnDocFormRender
 *   OnModFormRender
 *   OnPluginFormRender
 *   OnSnipFormRender
 *   OnTVFormRender
 *   OnTempFormRender
 *   OnUserFormRender
 *   OnWUsrFormRender
 *
 * Hope you like it as much as I do.
 * 
 */

// I know the code looks messy, but that is mainly because of the copy/pasting.

global $_lang;

//Get Manager Theme - added by garryn
$manager_theme = $modx->config['manager_theme'] ? $modx->config['manager_theme'] : '';

// Get a reference to the event
$e = & $modx->Event;

// For every form basicially the code is just copied from the appropriate
// mutate_XXXXXX.dynamic.action.php file. Then the CSS id's are updated so they
// are unique. I just added __ after it.

switch ($e->name) {

//-------------------------------------------------------------------
   case "OnDocFormRender":

// From mutate_content.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5" /><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<tr>
			<td id="Button1__"><a href="#" onclick="documentDirty=false; document.mutate.save.click();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']; ?></a></td>
			<td id="Button2__"><a href="#" onclick="deletedocument();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']; ?></span></a></td>
				<?php if($_REQUEST['a']=='4' || $_REQUEST['a']==72) { ?><script>document.getElementById("Button2__").className='disabled';</script><?php } ?>
			<td id="Button5__"><a href="<?php echo $id==0 ? "index.php?a=2" : "index.php?a=3&id=$id"; ?>"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle" /> <?php echo $_lang['cancel']; ?></a></td>
		</tr>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;


//-------------------------------------------------------------------
   case "OnSnipFormRender":

// From mutate_snippet.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5" /><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<td id="Button1__"><a href="#" onclick="documentDirty=false; document.mutate.save.click(); saveWait('mutate');"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']; ?></a></td>
<?php if($_GET['a']=='22') { ?>
		<td id="Button2__"><a href="#" onclick="duplicaterecord();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/copy.gif" align="absmiddle" /> <?php echo $_lang["duplicate"]; ?></a></td>
		<td id="Button3__"><a href="#" onclick="deletedocument();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']; ?></a></td>
<?php } ?>
		<td id="Button4__"><a href="index.php?a=76"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle" /> <?php echo $_lang['cancel']; ?></a></td>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;

//-------------------------------------------------------------------
   case "OnChunkFormRender":

// From mutate_htmlsnippet.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5" /><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<td id="Button1__"><a href="#" onclick="documentDirty=false; document.mutate.save.click(); saveWait('mutate');"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']; ?></a></td>
<?php if($_REQUEST['a']=='78') { ?>
		<td id="Button2__"><a href="#" onclick="duplicaterecord();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/copy.gif" align="absmiddle" /> <?php echo $_lang["duplicate"]; ?></a></td>
		<td id="Button3__"><a href="#" onclick="deletedocument();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']; ?></a></td>
<?php } ?>
		<td id="Button4__"><a href="index.php?a=76"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle" /> <?php echo $_lang['cancel']; ?></a></td>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;

//-------------------------------------------------------------------
   case "OnModFormRender":

// From mutate_module.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5"><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<tr>
		<td id="Button1__"><a href="#" onclick="documentDirty=false; document.mutate.save.click(); saveWait('mutate');"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle"> <?php echo $_lang['save']; ?></a></td>
<?php if($_GET['a']=='108') { ?>
		<td id="Button2__"><a href="#" onclick="duplicaterecord();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/copy.gif" align="absmiddle"> <?php echo $_lang["duplicate"]; ?></a></td>
		<td id="Button3__"><a href="#" onclick="deletedocument();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle"> <?php echo $_lang['delete']; ?></a></td>
<?php } ?>
		<td id="Button4__"><a href="#" onclick="documentDirty=false;document.location.href='index.php?a=106';"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle"> <?php echo $_lang['cancel']; ?></a></td>
		</tr>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;

//-------------------------------------------------------------------
   case "OnPluginFormRender":

// From mutate_plugin.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5" /><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<td id="Button1__"><a href="#" onclick="documentDirty=false; document.mutate.save.click(); saveWait('mutate');"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']; ?></a></td>
<?php if($_GET['a']=='102') { ?>
		<td id="Button2__"><a href="#" onclick="duplicaterecord();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/copy.gif" align="absmiddle" /> <?php echo $_lang["duplicate"]; ?></a></td>
		<td id="Button3__"><a href="#" onclick="deletedocument();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']; ?></a></td>
<?php } ?>
		<td id="Button4__"><a href="index.php?a=76"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle"> <?php echo $_lang['cancel']; ?></a></td>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;

//-------------------------------------------------------------------
   case "OnTVFormRender":

// From mutate_tmplvars.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5" /><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<td id="Button1__"><a href="#" onclick="documentDirty=false; document.mutate.save.click(); saveWait('mutate');"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']; ?></a></td>
<?php if($_GET['a']=='301') { ?>
		<td id="Button2__"><a href="#" onclick="duplicaterecord();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/copy.gif" align="absmiddle" /> <?php echo $_lang["duplicate"]; ?></a></td>
		<td id="Button3__"><a href="#" onclick="deletedocument();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']; ?></a></td>
<?php } ?>
		<td id="Button4__"><a href="index.php?a=76"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle" /> <?php echo $_lang['cancel']; ?></a></td>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;

//-------------------------------------------------------------------
   case "OnTempFormRender":

// From mutate_templates.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5" /><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<td id="Button1__"><a href="#" onclick="documentDirty=false; document.mutate.save.click(); saveWait('mutate');"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']; ?></a></td>
<?php if($_REQUEST['a']=='16') { ?>
		<td id="Button2__"><a href="#" onclick="duplicaterecord();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/copy.gif" align="absmiddle" /> <?php echo $_lang["duplicate"]; ?></a></td>
		<td id="Button3__"><a href="#" onclick="deletedocument();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']; ?></a></td>
<?php } ?>
		<td id="Button4__"><a href="index.php?a=76"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle" /> <?php echo $_lang['cancel']; ?></a></td>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;

//-------------------------------------------------------------------
   case "OnWUsrFormRender":

// From mutate_web_user.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5" /><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<tr>
			<td id="Button1__"><a href="#" onclick="documentDirty=false; document.userform.save.click();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']; ?></a></td>
			<td id="Button2__"><a href="#" onclick="deleteuser();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']; ?></a></td>
				<?php if($_GET['a']!='88') { ?>
					<script>document.getElementById("Button2__").className='disabled';</script>
				<?php } ?>
			<td id="Button3__"><a href="index.php?a=99"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle" /> <?php echo $_lang['cancel']; ?></a></td>
		</tr>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;

//-------------------------------------------------------------------
   case "OnUserFormRender":

// From mutate_user.dynamic.action.php
ob_start();
?>
<div class="subTitle" style="width:100%">
	<span class="right"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/_tx_.gif" width="1" height="5" /><br />"<a href='javascript:scroll(0,0);'><?php echo $_lang['scroll_up']; ?></a>"</span>

	<table cellpadding="0" cellspacing="0" class="actionButtons">
		<tr>
			<td id="Button1__"><a href="#" onclick="documentDirty=false; document.userform.save.click();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']; ?></a></td>
			<td id="Button2__"><a href="#" onclick="deleteuser();"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']; ?></a></td>
				<?php if($_GET['a']!='12') { ?>	
					<script>document.getElementById("Button2__").className='disabled';</script>
				<?php } ?>
			<td id="Button3__"><a href="index.php?a=75"><img src="media/style/<?php echo $manager_theme ? "$manager_theme/":""; ?>images/icons/cancel.gif" align="absmiddle" /> <?php echo $_lang['cancel']; ?></a></td>
		</tr>
	</table>
</div>
<?php
$output = ob_get_clean();
    break;

}

// Add the new bar to the output
$e->output($output);
