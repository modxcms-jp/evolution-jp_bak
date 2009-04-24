<?php
if(IN_MANAGER_MODE!='true') die('<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.');

switch ($_REQUEST['a']) {
	case 107:
		if(!$modx->hasPermission('new_module')) {
			$e->setError(3);
			$e->dumpError();
		}
		break;
	case 108:
		if(!$modx->hasPermission('edit_module')) {
			$e->setError(3);
			$e->dumpError();
		}
		break;
	default:
		$e->setError(3);
		$e->dumpError();
}

if (isset($_REQUEST['id']))
        $id = (int)$_REQUEST['id'];
else    $id = 0;

if ($manager_theme)
        $manager_theme .= '/';
else    $manager_theme  = '';

// Get table names (alphabetical)
$tbl_active_users       = $modx->getFullTableName('active_users');
$tbl_membergroup_names  = $modx->getFullTableName('membergroup_names');
$tbl_site_content       = $modx->getFullTableName('site_content');
$tbl_site_htmlsnippets  = $modx->getFullTableName('site_htmlsnippets');
$tbl_site_module_access = $modx->getFullTableName('site_module_access');
$tbl_site_module_depobj = $modx->getFullTableName('site_module_depobj');
$tbl_site_modules       = $modx->getFullTableName('site_modules');
$tbl_site_plugins       = $modx->getFullTableName('site_plugins');
$tbl_site_snippets      = $modx->getFullTableName('site_snippets');
$tbl_site_templates     = $modx->getFullTableName('site_templates');
$tbl_site_tmplvars      = $modx->getFullTableName('site_tmplvars');

// create globally unique identifiers (guid)
function createGUID(){
	srand((double)microtime()*1000000);
	$r = rand() ;
	$u = uniqid(getmypid() . $r . (double)microtime()*1000000,1);
	$m = md5 ($u);
	return $m;
}

function isNumber($var) {
	if (strlen($var) == 0) {
		return false;
	}
	for ($i = 0; $i < strlen($var); $i++) {
		if (substr_count('0123456789', substr($var, $i, 1)) == 0)
			return false;
	}
	return true;
}

// Check to see the editor isn't locked
$sql = 'SELECT internalKey, username FROM '.$tbl_active_users.' WHERE action=108 AND id=\''.$id.'\'';
$rs = mysql_query($sql);
$limit = mysql_num_rows($rs);
if ($limit > 1) {
	for ($i = 0; $i < $limit; $i++) {
		$lock = mysql_fetch_assoc($rs);
		if ($lock['internalKey'] != $modx->getLoginUserID()) {
			$msg = sprintf($_lang['lock_msg'], $lock['username'], 'module');
			$e->setError(5, $msg);
			$e->dumpError();
		}
	}
}
// end check for lock

// make sure the id's a number
if (!isNumber($id)) { // Should this use is_numeric() instead? -sirlancelot (2008-02-27)
	echo 'Passed ID is NaN!';
	exit;
}

if (isset($_GET['id'])) {
	$sql = 'SELECT * FROM '.$tbl_site_modules.' WHERE id=\''.$id.'\'';
	$rs = mysql_query($sql);
	$limit = mysql_num_rows($rs);
	if ($limit > 1) {
		echo '<p>Multiple modules sharing same unique id. Not good.<p>';
		exit;
	}
	if ($limit < 1) {
		echo '<p>No record found for id: '.$id.'.</p>';
		exit;
	}
	$content = mysql_fetch_assoc($rs);
	$_SESSION['itemname'] = $content['name'];
	if ($content['locked'] == 1 && $_SESSION['mgrRole'] != 1) {
		$e->setError(3);
		$e->dumpError();
	}
} else {
	$_SESSION['itemname'] = 'New Module';
	$content['wrap'] = '1';
}

?>
<script type="text/javascript">
function loadDependencies() {
	if (documentDirty) {
		if (!confirm("<?php echo $_lang['confirm_load_depends']?>")) {
			return;
		}
	}
	documentDirty = false;
	window.location.href="index.php?id=<?php echo $_REQUEST['id']?>&a=113";
};
function duplicaterecord() {
	if(confirm("<?php echo $_lang['confirm_duplicate_record']?>")==true) {
		documentDirty=false;
		document.location.href="index.php?id=<?php echo $_REQUEST['id']?>&a=111";
	}
}

function deletedocument() {
	if(confirm("<?php echo $_lang['confirm_delete_module']?>")==true) {
		documentDirty=false;
		document.location.href="index.php?id=" + document.mutate.id.value + "&a=110";
	}
}

function setTextWrap(ctrl,b) {
	if(!ctrl) return;
	ctrl.wrap = (b)? "soft":"off";
}

// Current Params
var currentParams = {};

function showParameters(ctrl) {
	var c,p,df,cp;
	var ar,desc,value,key,dt;

	currentParams = {}; // reset;

	if (ctrl) {
		f = ctrl.form;
	} else {
		f= document.forms['mutate'];
		if(!f) return;
	}

	// setup parameters
	tr = (document.getElementById) ? document.getElementById('displayparamrow'):document.all['displayparamrow'];
	dp = (f.properties.value) ? f.properties.value.split("&"):"";
	if(!dp) tr.style.display='none';
	else {
		t='<table width="300" style="margin-bottom:3px;margin-left:14px;background-color:#EEEEEE" cellpadding="2" cellspacing="1"><thead><tr><td width="50%"><?php echo $_lang['parameter']?></td><td width="50%"><?php echo $_lang['value']?></td></tr></thead>';
		for(p = 0; p < dp.length; p++) {
			dp[p]=(dp[p]+'').replace(/^\s|\s$/,""); // trim
			ar = dp[p].split("=");
			key = ar[0];     // param
			ar = (ar[1]+'').split(";");
			desc = ar[0];   // description
			dt = ar[1];     // data type
			value = decode((ar[2])? ar[2]:'');

			// store values for later retrieval
			if (key && dt=='list') currentParams[key] = [desc,dt,value,ar[3]];
			else if (key) currentParams[key] = [desc,dt,value];

			if (dt) {
				switch(dt) {
					case 'int':
						c = '<input type="text" name="prop_'+key+'" value="'+value+'" size="30" onchange="setParameter(\''+key+'\',\''+dt+'\',this)" />';
						break;
					case 'menu':
						value = ar[3];
						c = '<select name="prop_'+key+'" style="width:168px" onchange="setParameter(\''+key+'\',\''+dt+'\',this)">';
						ls = (ar[2]+'').split(",");
						if(currentParams[key]==ar[2]) currentParams[key] = ls[0]; // use first list item as default
						for(i=0;i<ls.length;i++) {
							c += '<option value="'+ls[i]+'"'+((ls[i]==value)? ' selected="selected"':'')+'>'+ls[i]+'</option>';
						}
						c += '</select>';
						break;
					case 'list':
						value = ar[3];
						ls = (ar[2]+'').split(",");
						if(currentParams[key]==ar[2]) currentParams[key] = ls[0]; // use first list item as default
						c = '<select name="prop_'+key+'" size="'+ls.length+'" style="width:168px" onchange="setParameter(\''+key+'\',\''+dt+'\',this)">';
						for(i=0;i<ls.length;i++) {
							c += '<option value="'+ls[i]+'"'+((ls[i]==value)? ' selected="selected"':'')+'>'+ls[i]+'</option>';
						}
						c += '</select>';
						break;
					case 'list-multi':
						value = (ar[3]+'').replace(/^\s|\s$/,"");
						arrValue = value.split(",")
							ls = (ar[2]+'').split(",");
						if(currentParams[key]==ar[2]) currentParams[key] = ls[0]; // use first list item as default
						c = '<select name="prop_'+key+'" size="'+ls.length+'" multiple="multiple" style="width:168px" onchange="setParameter(\''+key+'\',\''+dt+'\',this)">';
						for(i=0;i<ls.length;i++) {
							if(arrValue.length) {
								for(j=0;j<arrValue.length;j++) {
									if(ls[i]==arrValue[j]) {
										c += '<option value="'+ls[i]+'" selected="selected">'+ls[i]+'</option>';
									} else {
										c += '<option value="'+ls[i]+'">'+ls[i]+'</option>';
									}
								}
							} else {
								c += '<option value="'+ls[i]+'">'+ls[i]+'</option>';
							}
						}
						c += '</select>';
						break;
					case 'textarea':
						c = '<textarea name="prop_'+key+'" cols="50" rows="4" onchange="setParameter(\''+key+'\',\''+dt+'\',this)">'+value+'</textarea>';
						break;
					default:  // string
						c = '<input type="text" name="prop_'+key+'" value="'+value+'" size="30" onchange="setParameter(\''+key+'\',\''+dt+'\',this)" />';
						break;

				}
				t +='<tr><td bgcolor="#FFFFFF" width="50%">'+desc+'</td><td bgcolor="#FFFFFF" width="50%">'+c+'</td></tr>';
			};
		}
		t+='</table>';
		td = (document.getElementById) ? document.getElementById('displayparams'):document.all['displayparams'];
		td.innerHTML = t;
		tr.style.display='';
	}
	implodeParameters();
}

function setParameter(key,dt,ctrl) {
	var v;
	if(!ctrl) return null;
	switch (dt) {
		case 'int':
			ctrl.value = parseInt(ctrl.value);
			if(isNaN(ctrl.value)) ctrl.value = 0;
			v = ctrl.value;
			break;
		case 'menu':
			v = ctrl.options[ctrl.selectedIndex].value;
			currentParams[key][3] = v;
			implodeParameters();
			return;
			break;
		case 'list':
			v = ctrl.options[ctrl.selectedIndex].value;
			currentParams[key][3] = v;
			implodeParameters();
			return;
			break;
		case 'list-multi':
			var arrValues = new Array;
			for(var i=0; i < ctrl.options.length; i++) {
				if(ctrl.options[i].selected) {
					arrValues.push(ctrl.options[i].value);
				}
			}
			currentParams[key][3] = arrValues.toString();
			implodeParameters();
			return;
			break;
		default:
			v = ctrl.value+'';
			break;
	}
	currentParams[key][2] = v;
	implodeParameters();
}

// implode parameters
function implodeParameters() {
	var v, p, s='';
	for(p in currentParams) {
		if(currentParams[p]) {
			v = currentParams[p].join(";");
			if(s && v) s+=' ';
			if(v) s += '&'+p+'='+ v;
		}
	}
	document.forms['mutate'].properties.value = s;
}

function encode(s) {
	s=s+'';
	s = s.replace(/\=/g,'%3D'); // =
	s = s.replace(/\&/g,'%26'); // &
	return s;
}

function decode(s) {
	s=s+'';
	s = s.replace(/\%3D/g,'='); // =
	s = s.replace(/\%26/g,'&'); // &
	return s;
}

// Resource browser
function OpenServerBrowser(url, width, height ) {
	var iLeft = (screen.width  - width) / 2 ;
	var iTop  = (screen.height - height) / 2 ;

	var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
	sOptions += ",width=" + width ;
	sOptions += ",height=" + height ;
	sOptions += ",left=" + iLeft ;
	sOptions += ",top=" + iTop ;

	var oWindow = window.open( url, "FCKBrowseWindow", sOptions ) ;
}

function BrowseServer() {
	var w = screen.width * 0.7;
	var h = screen.height * 0.7;
	OpenServerBrowser("<?php echo $base_url?>manager/media/browser/mcpuk/browser.html?Type=images&Connector=<?php echo $base_url?>manager/media/browser/mcpuk/connectors/php/connector.php&ServerPath=<?php echo $base_url?>", w, h);
}

function SetUrl(url, width, height, alt) {
	document.mutate.icon.value = url;
}
</script>
<script type="text/javascript" src="media/script/tabpane.js"></script>
<link rel="stylesheet" type="text/css" href="media/style/<?php echo $manager_theme?>style.css?<?php echo $theme_refresher?>" />

<form name="mutate" method="post" action="index.php?a=109">
<?php
    // invoke OnModFormPrerender event
    $evtOut = $modx->invokeEvent('OnModFormPrerender', array('id' => $id));
    if(is_array($evtOut)) echo implode('',$evtOut);
?>
<input type="hidden" name="id" value="<?php echo $content['id']?>">
<input type="hidden" name="mode" value="<?php echo $_GET['a']?>">

<div class="subTitle">
	<span class="right"><?php echo $_lang['module_title']?></span>

	<table cellpadding="0" cellspacing="0" class="actionButtons"><tr>
		<td id="Button1"><a href="#" onclick="documentDirty=false; document.mutate.save.click(); saveWait('mutate');"><img src="media/style/<?php echo $manager_theme?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['save']?></a></td>
<?php if($_GET['a']=='108') { ?>
		<td id="Button2"><a href="#" onclick="duplicaterecord();"><img src="media/style/<?php echo $manager_theme?>images/icons/copy.gif" align="absmiddle" /> <?php echo $_lang['duplicate']?></a></td>
		<td id="Button3"><a href="#" onclick="deletedocument();"><img src="media/style/<?php echo $manager_theme?>images/icons/delete.gif" align="absmiddle" /> <?php echo $_lang['delete']?></a></td>
<?php echo "\n"; } ?>
		<td id="Button4"><a href="#" onclick="documentDirty=false;document.location.href='index.php?a=106';"><img src="media/style/<?php echo $manager_theme?>images/icons/cancel.gif" align="absmiddle" /> <?php echo $_lang['cancel']?></a></td>
	</tr></table>
	<div class="stay">
		<table border="0" cellspacing="1" cellpadding="1"><tr>
		<td><span class="comment">&nbsp;<?php echo $_lang['after_saving']?>:</span></td>
		<td><input name="stay" id="stay_radio_1" type="radio" class="radio" value="1"<?php echo $_GET['stay']=='1' ? " checked='checked'":''?> /></td><td><label for="stay_radio_1" class="comment"><?php echo $_lang['stay_new']?></label></td>
		<td><input name="stay" id="stay_radio_2" type="radio" class="radio" value="2"<?php echo $_GET['stay']=='2' ? " checked='checked'":''?> /></td><td><label for="stay_radio_2" class="comment"><?php echo $_lang['stay']?></label></td>
		<td><input name="stay" id="stay_radio_3" type="radio" class="radio" value=""<?php echo $_GET['stay']=='' ? " checked='checked'":''?> /></td><td><label for="stay_radio_3" class="comment"><?php echo $_lang['close']?></label></td>
	</tr></table>
	</div>
</div>

<div class="sectionHeader"><?php echo $_lang['module_title']?></div>
<div class="sectionBody"><p><img src="media/style/<?php echo $manager_theme?>images/icons/modules.gif" alt="." width="32" height="32" align="left" hspace="10" /><?php echo $_lang['module_msg']?></p>

<div class="tab-pane" id="modulePane">
	<script type="text/javascript">
	tpModule = new WebFXTabPane( document.getElementById( "modulePane"),false);
	</script>

	<!-- General -->
	<div class="tab-page" id="tabModule">
	<h2 class="tab"><?php echo $_lang['settings_general']?></h2>
	<script type="text/javascript">tpModule.addTabPage( document.getElementById( "tabModule" ) );</script>

	<table border="0" cellspacing="0" cellpadding="1">
		<tr><td align="left"><?php echo $_lang['module_name']?>:</td>
			<td align="left"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span><input name="name" type="text" maxlength="100" value="<?php echo htmlspecialchars($content['name'])?>" class="inputBox" style="width:150px;" onChange="documentDirty=true;"><span style="font-family:'Courier New', Courier, mono">&nbsp;</span><span class="warning" id="savingMessage">&nbsp;</span></td></tr>
		<tr><td align="left"><?php echo $_lang['module_desc']?>:&nbsp;&nbsp;</td>
			<td align="left"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span><input name="description" type="text" maxlength="255" value="<?php echo $content['description']?>" class="inputBox" style="width:300px;" onChange="documentDirty=true;"></td></tr>
		<tr><td align="left"><?php echo $_lang['icon']?> <span class="comment">(32x32)</span>:&nbsp;&nbsp;</td>
			<td align="left"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span><input onChange="documentDirty=true;" type="text" maxlength="255" style="width: 250px;" name="icon" value="<?php echo $content['icon']?>" /> <input type="button" value="<?php echo $_lang['insert']?>" onclick="BrowseServer();" style="width:45px;" /></td></tr>
		<tr><td align="left"><?php echo $_lang['existing_category']?>:&nbsp;&nbsp;</td>
			<td align="left"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span>
			<select name="categoryid" style="width:300px;" onChange="documentDirty=true;">
				<option>&nbsp;</option>
<?php
				include_once "categories.inc.php";
				$ds = getCategories();
				if ($ds) {
					foreach($ds as $n => $v) {
						echo "\t\t\t".'<option value="'.$v['id'].'"'.($content['category'] == $v['id'] ? ' selected="selected"' : '').'>'.htmlspecialchars($v['category'])."</option>\n";
					}
				}
?>			</select></td></tr>
		<tr><td align="left" valign="top" style="padding-top:5px;"><?php echo $_lang['new_category']?>:</td>
			<td align="left" valign="top" style="padding-top:5px;"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span><input name="newcategory" type="text" maxlength="45" value="" class="inputBox" style="width:300px;" onChange="documentDirty=true;"></td></tr>
		<tr><td align="left"><input name="enable_resource" title="<?php echo $_lang['enable_resource']?>" type="checkbox"<?php echo $content['enable_resource']==1 ? ' checked="checked"' : ''?> class="inputBox" onclick="documentDirty=true;" /> <span style="cursor:pointer" onclick="document.mutate.enable_resource.click();" title="<?php echo $_lang['enable_resource']?>"><?php echo $_lang['resource']?></span>:</td>
			<td align="left"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span><input name="sourcefile" type="text" maxlength="255" value="<?php echo $content['sourcefile']?>" class="inputBox" style="width:300px;" onChange="documentDirty=true;" /></td></tr>
		<tr><td align="left" valign="top" colspan="2"><input name="disabled" type="checkbox" <?php echo $content['disabled'] == 1 ? 'checked="checked"' : ''?> value="on" class="inputBox" />
			<span style="cursor:pointer" onclick="document.mutate.disabled.click();"><?php echo  $content['disabled'] == 1 ? '<span class="warning">'.$_lang['module_disabled'].'</span>' : $_lang['module_disabled']?></span></td></tr>
		<tr><td align="left" valign="top" colspan="2"><input name="locked" type="checkbox"<?php echo $content['locked'] == 1 ? ' checked="checked"' : ''?> class="inputBox" />
			<span style="cursor:pointer" onclick="document.mutate.locked.click();"><?php echo $_lang['lock_module']?></span> <span class="comment"><?php echo $_lang['lock_module_msg']?></span></td></tr>
	</table>

	<!-- PHP text editor start -->
	<div style="width:100%; position:relative">
		<div style="padding:1px; width:100%; height:16px; background-color:#eeeeee; border-top:1px solid #e0e0e0; margin-top:5px">
			<span style="float:left; color:#707070; font-weight:bold; padding:3px">&nbsp;<?php echo $_lang['module_code']?></span>
			<span style="float:right; color:#707070"><?php echo $_lang['wrap_lines']?><input name="wrap" type="checkbox"<?php echo $content['wrap']== 1 ? ' checked="checked"' : ''?> class="inputBox" onclick="setTextWrap(document.mutate.post,this.checked)" /></span>
		</div>
		<textarea dir="ltr" name="post" style="width:100%; height:370px;" wrap="<?php echo $content['wrap']== 1 ? 'soft' : 'off'?>" onchange="documentDirty=true;"><?php echo htmlspecialchars($content['modulecode'])?></textarea>
	</div>
	<!-- PHP text editor end -->
	</div>

	<!-- Configuration -->
	<div class="tab-page" id="tabConfig">
		<h2 class="tab"><?php echo $_lang['settings_config']?></h2>
		<script type="text/javascript">tpModule.addTabPage( document.getElementById( "tabConfig" ) );</script>

		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="left" valign="top"><?php echo $_lang['guid']?>:</td>
				<td align="left" valign="top"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span><input name="guid" type="text" maxlength="32" value="<?php echo $_REQUEST['a'] == 107 ? createGUID() : $content['guid']?>" class="inputBox" style="width:300px;" onChange="documentDirty=true;" /><br /><br /></td></tr>
			<tr><td align="left" valign="top"><input name="enable_sharedparams" type="checkbox"<?php echo $content['enable_sharedparams']==1 ? ' checked="checked"' : ''?> class="inputBox" onclick="documentDirty=true;" /> <span style="cursor:pointer" onclick="document.mutate.enable_sharedparams.click();"><?php echo $_lang['enable_sharedparams']?>:</span></td>
				<td align="left" valign="top"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span><span style="width:300px;" ><span class="comment"><?php echo $_lang['enable_sharedparams_msg']?></span></span><br /><br /></td></tr>
			<tr><td align="left" valign="top"><?php echo $_lang['module_config']?>:</td>
				<td align="left" valign="top"><span style="font-family:'Courier New', Courier, mono">&nbsp;&nbsp;</span><input name="properties" type="text" maxlength="65535" value="<?php echo $content['properties']?>" class="inputBox" style="width:280px;" onChange="showParameters(this);documentDirty=true;" /><input type="button" value=".." style="width:16px; margin-left:2px;" title="<?php echo $_lang['update_params']?>" /></td></tr>
			<tr id="displayparamrow"><td valign="top" align="left">&nbsp;</td>
				<td align="left" id="displayparams">&nbsp;</td></tr>
		</table>
	</div>

<?php if ($_REQUEST['a'] == 108) { ?>
	<!-- Dependencies -->
	<div class="tab-page" id="tabDepend">
	<h2 class="tab"><?php echo $_lang['settings_dependencies']?></h2>
	<script type="text/javascript">tpModule.addTabPage( document.getElementById( "tabDepend" ) );</script>

	<table width="95%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="left" valign="top"><p><?php echo $_lang['module_viewdepend_msg']?><br /><br />
		<a class="searchtoolbarbtn" href="#" style="float:left" onclick="loadDependencies();return false;"><img src="media/style/<?php echo $manager_theme?>images/icons/save.gif" align="absmiddle" /> <?php echo $_lang['manage_depends']?></a><br /><br /></p></td></tr>
	<tr><td valign="top" align="left">
<?php
	$sql = 'SELECT smd.id, COALESCE(ss.name,st.templatename,sv.name,sc.name,sp.name,sd.pagetitle) AS `name`, '.
	       'CASE smd.type'.
	       ' WHEN 10 THEN \'Chunk\''.
	       ' WHEN 20 THEN \'Document\''.
	       ' WHEN 30 THEN \'Plugin\''.
	       ' WHEN 40 THEN \'Snippet\''.
	       ' WHEN 50 THEN \'Template\''.
	       ' WHEN 60 THEN \'TV\''.
	       'END AS `type` '.
	       'FROM '.$tbl_site_module_depobj.' AS smd '.
	       'LEFT JOIN '.$tbl_site_htmlsnippets.' AS sc ON sc.id = smd.resource AND smd.type = 10 '.
	       'LEFT JOIN '.$tbl_site_content.' AS sd ON sd.id = smd.resource AND smd.type = 20 '.
	       'LEFT JOIN '.$tbl_site_plugins.' AS sp ON sp.id = smd.resource AND smd.type = 30 '.
	       'LEFT JOIN '.$tbl_site_snippets.' AS ss ON ss.id = smd.resource AND smd.type = 40 '.
	       'LEFT JOIN '.$tbl_site_templates.' AS st ON st.id = smd.resource AND smd.type = 50 '.
	       'LEFT JOIN '.$tbl_site_tmplvars.' AS sv ON sv.id = smd.resource AND smd.type = 60 '.
	       'WHERE smd.module=\''.$id.'\' ORDER BY smd.type,name';
$ds = $modx->dbQuery($sql);
if (!$ds) {
	echo "An error occured while loading module dependencies.";
} else {
	include_once $base_path."manager/includes/controls/datagrid.class.php";
	$grd = new DataGrid('', $ds, 0); // set page size to 0 t show all items
	$grd->noRecordMsg = $_lang['no_records_found'];
	$grd->cssClass = 'grid';
	$grd->columnHeaderClass = 'gridHeader';
	$grd->itemClass = 'gridItem';
	$grd->altItemClass = 'gridAltItem';
	$grd->columns = $_lang['resource_name']." ,".$_lang['type'];
	$grd->fields = "name,type";
	echo $grd->render();
} ?>
		</td></tr>
	</table>
	</div>
<?php } ?>
</div>
</div>

<?php
if ($use_udperms == 1) {
	// fetch user access permissions for the module
	$groupsarray = array();
	$sql = 'SELECT * FROM '.$tbl_site_module_access.' WHERE module=\''.$id.'\'';
	$rs = mysql_query($sql);
	$limit = mysql_num_rows($rs);
	for ($i = 0; $i < $limit; $i++) {
		$currentgroup = mysql_fetch_assoc($rs);
		$groupsarray[$i] = $currentgroup['usergroup'];
	}

	if($modx->hasPermission('access_permissions')) { ?>
<!-- User Group Access Permissions -->
<div class="sectionHeader"><?php echo $_lang['group_access_permissions']?></div>
<div class="sectionBody">
	<script type="text/javascript">
	function makePublic(b) {
		var notPublic=false;
		var f=document.forms['mutate'];
		var chkpub = f['chkallgroups'];
		var chks = f['usrgroups[]'];
		if (!chks && chkpub) {
			chkpub.checked=true;
			return false;
		} else if (!b && chkpub) {
			if(!chks.length) notPublic=chks.checked;
			else for(i=0;i<chks.length;i++) if(chks[i].checked) notPublic=true;
			chkpub.checked=!notPublic;
		} else {
			if(!chks.length) chks.checked = (b) ? false : chks.checked;
			else for(i=0;i<chks.length;i++) if (b) chks[i].checked=false;
			chkpub.checked=true;
		}
	}
	</script>
	<p><?php echo $_lang['module_group_access_msg']?></p>
<?php
	}
	$chk = '';
	$sql = "SELECT name, id FROM ".$tbl_membergroup_names;
	$rs = mysql_query($sql);
	$limit = mysql_num_rows($rs);
	for ($i = 0; $i < $limit; $i++) {
		$row = mysql_fetch_assoc($rs);
		$checked = in_array($row['id'], $groupsarray);
		if($modx->hasPermission('access_permissions')) {
			if ($checked) $notPublic = true;
			$chks .= '<input type="checkbox" name="usrgroups[]" value="'.$row['id'].'"'.($checked ? ' checked="checked"' : '').' onclick="makePublic(false)" />'.$row['name']."<br />\n";
		} else {
			if ($checked) $chks = '<input type="hidden" name="usrgroups[]"  value="'.$row['id'].'" />' . "\n" . $chks;
		}
	}
	if($modx->hasPermission('access_permissions')) {
		$chks = '<input type="checkbox" name="chkallgroups"'.(!$notPublic ? ' checked="checked"' : '').' onclick="makePublic(true)" /><span class="warning">'.$_lang['all_usr_groups'].'</span><br />' . "\n" . $chks;
	}
	echo $chks;
?>
</div>
<?php } ?>

<input type="submit" name="save" style="display:none;">
<?php
// invoke OnModFormRender event
$evtOut = $modx->invokeEvent('OnModFormRender', array('id' => $id));
if(is_array($evtOut)) echo implode('',$evtOut);
?>
</form>
<script type="text/javascript">setTimeout('showParameters();',10);</script>
