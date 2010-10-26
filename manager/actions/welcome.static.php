<?php if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.");

unset($_SESSION['itemname']); // clear this, because it's only set for logging purposes

if($modx->hasPermission('settings') && (!isset($settings_version) || $settings_version!=$modx_version)) {
    // seems to be a new install - send the user to the configuration page
    echo '<script type="text/javascript">document.location.href="index.php?a=17";</script>';
    exit;
}

// set placeholders
$modx->setPlaceholder('theme',$manager_theme ? $manager_theme : '');
$modx->setPlaceholder('home', $_lang["home"]);
$modx->setPlaceholder('logo_slogan',$_lang["logo_slogan"]);
$modx->setPlaceholder('site_name',$site_name);
$modx->setPlaceholder('welcome_title',$_lang['welcome_title']);

// setup message info
if($modx->hasPermission('messages')) {
	if (!isset($_SESSION['nrtotalmessages']) || !isset($_SESSION['nrnewmessages'])) {
		include_once MODX_MANAGER_PATH.'includes/messageCount.inc.php';
		$_SESSION['nrtotalmessages'] = $nrtotalmessages;
		$_SESSION['nrnewmessages'] = $nrnewmessages;
	}

    $msg = '<a href="index.php?a=10"><img src="'.$_style['icons_mail_large'].'" /></a>
    <span style="color:#909090;font-size:15px;font-weight:bold">&nbsp;'.$_lang["inbox"].($_SESSION['nrnewmessages']>0 ? " (<span style='color:red'>".$_SESSION['nrnewmessages']."</span>)":"").'</span><br />';
    if($_SESSION['nrnewmessages']>0)
    {
        $msg .= '<span class="comment">'
             . sprintf($_lang["welcome_messages"], $_SESSION['nrtotalmessages'], "<span style='color:red;'>".$_SESSION['nrnewmessages']."</span>").'</span>';
    }
    else
    {
        $msg .= '<span class="comment">' . $_lang["messages_no_messages"] . '</span>';
    }
    $modx->setPlaceholder('MessageInfo',$msg);
}

// setup icons
if($modx->hasPermission('new_user')||$modx->hasPermission('edit_user')) { 
    $icon = '<a class="hometblink" href="index.php?a=75"><img src="'.$_style['icons_security_large'].'" width="32" height="32" alt="'.$_lang['user_management_title'].'" /><br />'.$_lang['security'].'</a>';     
    $modx->setPlaceholder('SecurityIcon',$icon);
}
if($modx->hasPermission('new_web_user')||$modx->hasPermission('edit_web_user')) { 
    $icon = '<a class="hometblink" href="index.php?a=99"><img src="'.$_style['icons_webusers_large'].'" width="32" height="32" alt="'.$_lang['web_user_management_title'].'" /><br />'.$_lang['web_users'].'</a>';
    $modx->setPlaceholder('WebUserIcon',$icon);
}
if($modx->hasPermission('new_module') || $modx->hasPermission('edit_module')) {
    $icon = '<a class="hometblink" href="index.php?a=106"><img src="'.$_style['icons_modules_large'].'" width="32" height="32" alt="'.$_lang['manage_modules'].'" /><br />'.$_lang['modules'].'</a>';
    $modx->setPlaceholder('ModulesIcon',$icon);
}
if($modx->hasPermission('new_template') || $modx->hasPermission('edit_template') || $modx->hasPermission('new_snippet') || $modx->hasPermission('edit_snippet') || $modx->hasPermission('new_plugin') || $modx->hasPermission('edit_plugin') || $modx->hasPermission('manage_metatags')) {
    $icon = '<a class="hometblink" href="index.php?a=76"><img src="'.$_style['icons_resources_large'].'" width="32" height="32" alt="'.$_lang['element_management'].'" /><br />'.$_lang['elements'].'</a>';
    $modx->setPlaceholder('ResourcesIcon',$icon);
}
if($modx->hasPermission('bk_manager')) {
    $icon = '<a class="hometblink" href="index.php?a=93"><img src="'.$_style['icons_backup_large'].'" width="32" height="32" alt="'.$_lang['bk_manager'].'" /><br />'.$_lang['backup'].'</a>';
    $modx->setPlaceholder('BackupIcon',$icon);
}
if($modx->hasPermission('help')) {
    $icon = '<a class="hometblink" href="index.php?a=9"><img src="'.$_style['icons_help_large'].'" width="32" height="32" alt="'.$_lang['bk_manager'].'" /><br />'.$_lang["help"].'</a>';
    $modx->setPlaceholder('HelpIcon',$icon);
}


// setup modules
if($modx->hasPermission('exec_module')) {
	// Each module
	if ($_SESSION['mgrRole'] != 1) {
		// Display only those modules the user can execute
		$rs = $modx->db->query('SELECT DISTINCT sm.id, sm.name, mg.member
				FROM '.$modx->getFullTableName('site_modules').' AS sm
				LEFT JOIN '.$modx->getFullTableName('site_module_access').' AS sma ON sma.module = sm.id
				LEFT JOIN '.$modx->getFullTableName('member_groups').' AS mg ON sma.usergroup = mg.user_group
				WHERE (mg.member IS NULL OR mg.member = '.$modx->getLoginUserID().') AND sm.disabled != 1');
	} else {
		// Admins get the entire list
		$rs = $modx->db->select('*', $modx->getFullTableName('site_modules'), 'disabled != 1');
	}
	while ($content = $modx->db->getRow($rs)) {
		if(empty($content['icon'])) $content['icon'] = $_style['icons_modules'];
		$modulemenu[] = '<span class="wm_button" style="margin-top:10px;margin-bottom:10px;border:0"><a class="hometblink" href="index.php?a=112&amp;id='.$content['id'].'">' . '<img src="'.$content['icon'].'" width="32" height="32" alt="'.$content['name'].'" /><br />' .$content['name'].'</a></span>';
	}
}
$modules = '';
if(count($modulemenu)>0) $modules = join("\n",$modulemenu);
$modx->setPlaceholder('Modules',$modules);

// do some config checks
if (($modx->config['warning_visibility'] == 0 && $_SESSION['mgrRole'] == 1) || $modx->config['warning_visibility'] == 1) {
    include_once "config_check.inc.php";
    $modx->setPlaceholder('settings_config',$_lang['settings_config']);
    $modx->setPlaceholder('configcheck_title',$_lang['configcheck_title']);
    if($config_check_results != $_lang['configcheck_ok']) {    
    $modx->setPlaceholder('config_check_results',$config_check_results);
    $modx->setPlaceholder('config_display','block');
    }
    else {
        $modx->setPlaceholder('config_display','none');
    }
} else {
    $modx->setPlaceholder('config_display','none');
}

// include rss feeds for important forum topics
include_once "rss.inc.php"; 

// modx news
$modx->setPlaceholder('modx_news',$_lang["modx_news_tab"]);
$modx->setPlaceholder('modx_news_title',$_lang["modx_news_title"]);
$modx->setPlaceholder('modx_news_content',$feedData['modx_news_content']);

// security notices
$modx->setPlaceholder('modx_security_notices',$_lang["security_notices_tab"]);
$modx->setPlaceholder('modx_security_notices_title',$_lang["security_notices_title"]);
$modx->setPlaceholder('modx_security_notices_content',$feedData['modx_security_notices_content']);

// recent document info
$html = $_lang["activity_message"].'<br /><br /><ul>';
$sql = "SELECT id, pagetitle, description, editedon, editedby FROM $dbase.`".$table_prefix."site_content` WHERE $dbase.`".$table_prefix."site_content`.deleted=0 AND ($dbase.`".$table_prefix."site_content`.editedby=".$modx->getLoginUserID()." OR $dbase.`".$table_prefix."site_content`.createdby=".$modx->getLoginUserID().") ORDER BY editedon DESC LIMIT 10";
$rs = mysql_query($sql);
$limit = mysql_num_rows($rs);
if($limit<1) {
    $html .= '<li>'.$_lang['no_activity_message'].'</li>';
} else {
    for ($i = 0; $i < $limit; $i++) {
        $content = mysql_fetch_assoc($rs);
        if($i==0) {
            $syncid = $content['id'];
        }
        
        $sql = "SELECT username FROM $dbase.`".$table_prefix."manager_users` WHERE id=".$content['editedby'];
        $rs2 = mysql_query($sql);
        $limit2 = mysql_num_rows($rs2);
        if($limit2==0) $user = '-';
        else
        {
            $r = mysql_fetch_assoc($rs2);
            $user = $r['username'];
        }
        
        $html.='<li>'.$content['id'].' - <a href="index.php?a=3&amp;id='.$content['id'].'">'.$content['pagetitle'].'</a>'.($content['description']!='' ? ' - '.$content['description'] : '')
        .' (' . $modx->toDateFormat($content['editedon']). ' / ' . $user . ')</li>';
    }
}
$html.='</ul>';
$modx->setPlaceholder('recent_docs',$_lang['recent_docs']);
$modx->setPlaceholder('activity_title',$_lang['activity_title']);
$modx->setPlaceholder('RecentInfo',$html);

// user info
$modx->setPlaceholder('info',$_lang['info']);
$modx->setPlaceholder('yourinfo_title',$_lang['yourinfo_title']);
$html = '
    <p>'.$_lang["yourinfo_message"].'</p>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150">'.$_lang["yourinfo_username"].'</td>
        <td width="20">&nbsp;</td>
        <td><b>'.$modx->getLoginUserName().'</b></td>
      </tr>
      <tr>
        <td>'.$_lang["yourinfo_role"].'</td>
        <td>&nbsp;</td>
        <td><b>'.$_SESSION['mgrPermissions']['name'].'</b></td>
      </tr>
      <tr>
        <td>'.$_lang["yourinfo_previous_login"].'</td>
        <td>&nbsp;</td>
        <td><b>'.$modx->toDateFormat($_SESSION['mgrLastlogin']+$server_offset_time).'</b></td>
      </tr>
      <tr>
        <td>'.$_lang["yourinfo_total_logins"].'</td>
        <td>&nbsp;</td>
        <td><b>'.($_SESSION['mgrLogincount']+1).'</b></td>
      </tr>
    </table>
';
$modx->setPlaceholder('UserInfo',$html);

// online users
$modx->setPlaceholder('online',$_lang['online']);
$modx->setPlaceholder('onlineusers_title',$_lang['onlineusers_title']);
    $timetocheck = (time()-(60*20));//+$server_offset_time;

    include_once "actionlist.inc.php";

    $sql = "SELECT * FROM $dbase.`".$table_prefix."active_users` WHERE $dbase.`".$table_prefix."active_users`.lasthit>'$timetocheck' ORDER BY username ASC";
    $rs = mysql_query($sql);
    $limit = mysql_num_rows($rs);
    if($limit<2) {
        $html = "<p>".$_lang['no_active_users_found']."</p>";
    } else {
        $html = '<p>' . $_lang["onlineusers_message"].'<b>'.strftime('%H:%M:%S', time()+$server_offset_time).'</b>)</p>';
        $html .= '
                <table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#ccc">
                  <thead>
                    <tr>
                      <td><b>'.$_lang["onlineusers_user"].'</b></td>
                      <td><b>'.$_lang["onlineusers_userid"].'</b></td>
                      <td><b>'.$_lang["onlineusers_ipaddress"].'</b></td>
                      <td><b>'.$_lang["onlineusers_lasthit"].'</b></td>
                      <td><b>'.$_lang["onlineusers_action"].'</b></td>
                    </tr>
                  </thead>
                  <tbody>
        ';
        for ($i = 0; $i < $limit; $i++) {
            $activeusers = mysql_fetch_assoc($rs);
            $currentaction = getAction($activeusers['action'], $activeusers['id']);
            $webicon = ($activeusers['internalKey']<0)? "<img src='media/style/{$manager_theme}/images/tree/globe.gif' alt='Web user' />":"";
            $html.= "<tr bgcolor='#FFFFFF'><td><b>".$activeusers['username']."</b></td><td>$webicon&nbsp;".abs($activeusers['internalKey'])."</td><td>".$activeusers['ip']."</td><td>".strftime('%H:%M:%S', $activeusers['lasthit']+$server_offset_time)."</td><td>$currentaction</td></tr>";
        }
        $html.= '
                </tbody>
                </table>
        ';
    }
$modx->setPlaceholder('OnlineInfo',$html);

// invoke event OnManagerWelcomePrerender
$evtOut = $modx->invokeEvent('OnManagerWelcomePrerender');
if(is_array($evtOut)) {
    $output = implode("",$evtOut);
    $modx->setPlaceholder('OnManagerWelcomePrerender', $output);
}

// invoke event OnManagerWelcomeHome
$evtOut = $modx->invokeEvent('OnManagerWelcomeHome');
if(is_array($evtOut)) {
    $output = implode("",$evtOut);
    $modx->setPlaceholder('OnManagerWelcomeHome', $output);
}

// invoke event OnManagerWelcomeRender
$evtOut = $modx->invokeEvent('OnManagerWelcomeRender');
if(is_array($evtOut)) {
    $output = implode("",$evtOut);
    $modx->setPlaceholder('OnManagerWelcomeRender', $output);
}

// load template file
$tplFile = MODX_BASE_PATH . 'assets/templates/manager/welcome.html';
if(file_exists($tplFile)==false)
{
	$tplFile = MODX_BASE_PATH . 'manager/media/style/' . $modx->config['manager_theme'] . '/manager/welcome.html';
}
$handle = fopen($tplFile, "r");
$tpl = fread($handle, filesize($tplFile));
fclose($handle);

// merge placeholders
$tpl = $modx->mergePlaceholderContent($tpl);
$tpl = preg_replace('~\[\+(.*?)\+\]~', '', $tpl); //cleanup
if ($js= $modx->getRegisteredClientScripts()) {
	$tpl .= $js;
}

echo $tpl;
?>