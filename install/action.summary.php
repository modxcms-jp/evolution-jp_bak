<?php
$installMode = intval($_POST['installmode']);
echo "<p class=\"title\">" . $_lang['preinstall_validation'] . "</p>";
echo "<p>" . $_lang['summary_setup_check'] . "</p>";
$errors = 0;
// check PHP version
echo "<p>" . $_lang['checking_php_version'];
$php_ver_comp = version_compare(phpversion(), "4.2.0");
$php_ver_comp2 = version_compare(phpversion(), "4.3.8");
// -1 if left is less, 0 if equal, +1 if left is higher
if ($php_ver_comp < 0) {
    echo "<span class=\"notok\">" . $_lang['failed'] . "</span>".$_lang['you_running_php'] . phpversion() . $_lang["modx_requires_php"]."</p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
    if ($php_ver_comp2 < 0) {
        echo "<fieldset>" . $_lang['php_security_notice'] . "</fieldset>";
    }
}
// check php register globals off
echo "<p>" . $_lang['checking_registerglobals'];
$register_globals = (int) ini_get('register_globals');
if ($register_globals == '1'){
    echo "<span class=\"notok\">" . $_lang['failed'].  "</span></p><p><strong>".$_lang['checking_registerglobals_note']."</strong></p>";
    // $errors += 1; // comment out for now so we still allow installs if folks are simply stubborn
} else {
    echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
}
// check sessions
echo "<p>" . $_lang['checking_sessions'];
if ($_SESSION['session_test'] != 1) {
    echo "<span class=\"notok\">" . $_lang['failed'].  "</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
}
// check directories
// cache exists?
echo "<p>" . $_lang['checking_if_cache_exist'];
if (!file_exists("../assets/cache")) {
    echo "<span class=\"notok\">" . $_lang['failed'] . "</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
}
// cache writable?
echo "<p>" . $_lang['checking_if_cache_writable'];
if (!is_writable("../assets/cache")) {
    echo "<span class=\"notok\">" . $_lang['failed'] . "</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
}
// cache files writable?
echo "<p>" . $_lang['checking_if_cache_file_writable'];
if (!is_writable("../assets/cache/siteCache.idx.php")) {
    echo "<span class=\"notok\">" . $_lang['failed'] . "</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">".$_lang['ok']."</span></p>";
}
echo "<p>".$_lang['checking_if_cache_file2_writable'];
if (!is_writable("../assets/cache/sitePublishing.idx.php")) {
    echo "<span class=\"notok\">".$_lang['failed']."</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">".$_lang['ok']."</span></p>";
}
// cache exists?
echo "<p>" . $_lang['checking_if_cache_rss_exist'];
if (!file_exists("../assets/cache/rss")) {
    echo "<span class=\"notok\">" . $_lang['failed'] . "</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
}
// cache writable?
echo "<p>" . $_lang['checking_if_cache_rss_writable'];
if (!is_writable("../assets/cache/rss")) {
    echo "<span class=\"notok\">" . $_lang['failed'] . "</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
}
// images exists?
echo "<p>".$_lang['checking_if_images_exist'];
if (!file_exists("../assets/images")) {
    echo "<span class=\"notok\">".$_lang['failed']."</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">".$_lang['ok']."</span></p>";
}
// images writable?
echo "<p>".$_lang['checking_if_images_writable'];
if (!is_writable("../assets/images")) {
    echo "<span class=\"notok\">".$_lang['failed']."</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">".$_lang['ok']."</span></p>";
}
// export exists?
echo "<p>".$_lang['checking_if_export_exists'];
if (!file_exists("../assets/export")) {
    echo "<span class=\"notok\">".$_lang['failed']."</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">".$_lang['ok']."</span></p>";
}
// export writable?
echo "<p>".$_lang['checking_if_export_writable'];
if (!is_writable("../assets/export")) {
    echo "<span class=\"notok\">".$_lang['failed']."</span></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">".$_lang['ok']."</span></p>";
}
// config.inc.php writable?
echo "<p>".$_lang['checking_if_config_exist_and_writable'];
if (!file_exists("../manager/includes/config.inc.php")) {
    // make an attempt to create the file
    @ $hnd = fopen("../manager/includes/config.inc.php", 'w');
    @ fwrite($hnd, "<?php //MODx configuration file ?>");
    @ fclose($hnd);
}
$isWriteable = is_writable("../manager/includes/config.inc.php");
if (!$isWriteable) {
    echo "<span class=\"notok\">".$_lang['failed']."</span></p><p><strong>".$_lang['config_permissions_note']."</strong></p>";
    $errors += 1;
} else {
    echo "<span class=\"ok\">".$_lang['ok']."</span></p>";
}
// connect to the database
if ($installMode == 1) {
    include "../manager/includes/config.inc.php";
} else {
    // get db info from post
    $database_server = $_POST['databasehost'];
    $database_user = $_POST['databaseloginname'];
    $database_password = $_POST['databaseloginpassword'];
    $database_collation = $_POST['database_collation'];
    $database_charset = substr($database_collation, 0, strpos($database_collation, '_') - 1);
    $database_connection_charset = $_POST['database_connection_charset'];
    $database_connection_method = $_POST['database_connection_method'];
    $dbase = $_POST['database_name'];
    $table_prefix = $_POST['tableprefix'];
}
echo "<p>".$_lang['creating_database_connection'];
if (!@ $conn = mysql_connect($database_server, $database_user, $database_password)) {
    $errors += 1;
    echo "<span class=\"notok\">".$_lang['database_connection_failed']."</span><p />".$_lang['database_connection_failed_note']."</p>";
} else {
    echo "<span class=\"ok\">".$_lang['ok']."</span></p>";
}
// make sure we can use the database
if ($installMode > 0 && !@ mysql_query("USE {$dbase}")) {
    $errors += 1;
    echo "<span class=\"notok\">".$_lang['database_use_failed']."</span><p />".$_lang["database_use_failed_note"]."</p>";
}

// check the database collation if not specified in the configuration
if (!isset ($database_connection_charset) || empty ($database_connection_charset)) {
    if (!$rs = @ mysql_query("show session variables like 'collation_database'")) {
        $rs = @ mysql_query("show session variables like 'collation_server'");
    }
    if ($rs && $collation = mysql_fetch_row($rs)) {
        $database_collation = $collation[1];
    }
    if (empty ($database_collation)) {
        $database_collation = 'utf8_unicode_ci';
    }
    $database_charset = substr($database_collation, 0, strpos($database_collation, '_') - 1);
    $database_connection_charset = $database_charset;
}

// determine the database connection method if not specified in the configuration
if (!isset($database_connection_method) || empty($database_connection_method)) {
    $database_connection_method = 'SET CHARACTER SET';
}

// check table prefix
if ($conn && $installMode == 0) {
    echo "<p>" . $_lang['checking_table_prefix'] . $table_prefix . "`: ";
    if ($rs= @ mysql_query("SELECT COUNT(*) FROM $dbase.`" . $table_prefix . "site_content`")) {
        echo "<span class=\"notok\">" . $_lang['failed'] . "</span></b>" . $_lang['table_prefix_already_inuse'] . "</p>";
        $errors += 1;
        echo "<p>" . $_lang['table_prefix_already_inuse_note'] . "</p>";
    } else {
        echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
    }
} elseif ($conn && $installMode == 2) {
    echo "<p>" . $_lang['checking_table_prefix'] . $table_prefix . "`: ";
    if (!$rs = @ mysql_query("SELECT COUNT(*) FROM $dbase.`" . $table_prefix . "site_content`")) {
        echo "<span class=\"notok\">" . $_lang['failed'] . "</span></b>" . $_lang['table_prefix_not_exist'] . "</p>";
        $errors += 1;
        echo "<p>" . $_lang['table_prefix_not_exist_note'] . "</p>";
  } else {
        echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
  }
}

// check mysql version
if ($conn) {
    echo "<p>" . $_lang['checking_mysql_version'];
    if ( version_compare(mysql_get_server_info(), '5.0.51', '=') ) {
        echo "<span class=\"notok\">"  . $_lang['warning'] . "</span></b>&nbsp;&nbsp;<strong>". $_lang['mysql_5051'] . "</strong></p>";
        echo "<p><span class=\"notok\">" . $_lang['mysql_5051_warning'] . "</span></p>";
    } else {
        echo "<span class=\"ok\">" . $_lang['ok'] . "</span>&nbsp;&nbsp;<strong>" . $_lang['mysql_version_is'] . mysql_get_server_info() . "</strong></p>";
    }
}

// check for strict mode
if ($conn) {
    echo "<p>". $_lang['checking_mysql_strict_mode'];
    $mysqlmode = @ mysql_query("SELECT @@global.sql_mode");
    if (mysql_num_rows($mysqlmode) > 0){
        $modes = mysql_fetch_array($mysqlmode, MYSQL_NUM);
        //$modes = array("STRICT_TRANS_TABLES"); // for testing
        // print_r($modes);
        foreach ($modes as $mode) {
            if (strtoupper($mode) == "STRICT_TRANS_TABLES") {
                echo "<span class=\"notok\">" . $_lang['warning'] . "</span></b> <strong>&nbsp;&nbsp;" . $_lang['strict_mode'] . "</strong></p>";
                echo "<p><span class=\"notok\">" . $_lang['strict_mode_error'] . "</span></p>";
            } else {
                echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
            }
        }  
    } else {
        echo "<span class=\"ok\">" . $_lang['ok'] . "</span></p>";
    }
}
// Version and strict mode check end

// andrazk 20070416 - add install flag and disable manager login
// assets/cache writable?
if (is_writable("../assets/cache")) {
    if (file_exists('../assets/cache/installProc.inc.php')) {
        @chmod('../assets/cache/installProc.inc.php', 0755);
        unlink('../assets/cache/installProc.inc.php');
    }

    // make an attempt to create the file
    @ $hnd = fopen("../assets/cache/installProc.inc.php", 'w');
    @ fwrite($hnd, '<?php $installStartTime = '.time().'; ?>');
    @ fclose($hnd);
}


if ($errors > 0) {
?>
      <p>
      <?php
      echo $_lang['setup_cannot_continue'];
      echo $errors > 1 ? $errors." " : "";
      if ($errors > 1) echo $_lang['errors'];
      else echo $_lang['error'];
      if ($errors > 1) echo $_lang['please_correct_errors'];
      else echo $_lang['please_correct_error'];
      if ($errors > 1) echo $_lang['and_try_again_plural'];
      else echo $_lang['and_try_again'];
      echo $_lang['visit_forum'];
      ?>
      </p>
      <?php
}

echo "<p>&nbsp;</p>";

$nextAction= $errors > 0 ? 'summary' : 'install';
$nextButton= $errors > 0 ? $_lang['retry'] : $_lang['install'];

?>
<form name="install" action="index.php?action=<?php echo $nextAction ?>" method="post">
  <div>
    <input type="hidden" value="<?php echo $install_language?>" name="language" />
    <input type="hidden" value="1" name="chkagree" <?php echo isset($_POST['chkagree']) ? 'checked="checked" ':""; ?>/>
    <input type="hidden" value="<?php echo $installMode ?>" name="installmode" />
    <input type="hidden" value="<?php echo trim($_POST['database_name'], '`'); ?>" name="database_name" />
    <input type="hidden" value="<?php echo $_POST['tableprefix'] ?>" name="tableprefix" />
    <input type="hidden" value="<?php echo $_POST['database_collation'] ?>" name="database_collation" />
    <input type="hidden" value="<?php echo $_POST['database_connection_charset'] ?>" name="database_connection_charset" />
    <input type="hidden" value="<?php echo $_POST['database_connection_method'] ?>" name="database_connection_method" />
    <input type="hidden" value="<?php echo $_POST['databasehost'] ?>" name="databasehost" />
    <input type="hidden" value="<?php echo $_POST['databaseloginname'] ?>" name="databaseloginname" />
    <input type="hidden" value="<?php echo $_POST['databaseloginpassword'] ?>" name="databaseloginpassword" />
    <input type="hidden" value="<?php echo $_POST['cmsadmin'] ?>" name="cmsadmin" />
    <input type="hidden" value="<?php echo $_POST['cmsadminemail'] ?>" name="cmsadminemail" />
    <input type="hidden" value="<?php echo $_POST['cmspassword'] ?>" name="cmspassword" />
    
    <input type="hidden" value="1" name="options_selected" />
    
    <input type="hidden" value="<?php echo $_POST['installdata'] ?>" name="installdata" />
<?php
$templates = isset ($_POST['template']) ? $_POST['template'] : array ();
foreach ($templates as $i => $template) echo "<input type=\"hidden\" name=\"template[]\" value=\"$template\" />\n";
$chunks = isset ($_POST['chunk']) ? $_POST['chunk'] : array ();
foreach ($chunks as $i => $chunk) echo "<input type=\"hidden\" name=\"chunk[]\" value=\"$chunk\" />\n";
$snippets = isset ($_POST['snippet']) ? $_POST['snippet'] : array ();
foreach ($snippets as $i => $snippet) echo "<input type=\"hidden\" name=\"snippet[]\" value=\"$snippet\" />\n";
$plugins = isset ($_POST['plugin']) ? $_POST['plugin'] : array ();
foreach ($plugins as $i => $plugin) echo "<input type=\"hidden\" name=\"plugin[]\" value=\"$plugin\" />\n";
$modules = isset ($_POST['module']) ? $_POST['module'] : array ();
foreach ($modules as $i => $module) echo "<input type=\"hidden\" name=\"module[]\" value=\"$module\" />\n";
?>
  </div>
  <div id="navbar">
    <input type="submit" value="<?php echo $nextButton ?>" name="cmdnext" style="float:right;width:100px;" />
    <span style="float:right">&nbsp;</span>
    <input type="submit" value="<?php echo $_lang['btnback_value']?>" name="cmdback" style="float:right;width:100px;" onclick="this.form.action='index.php?action=options&language=<?php $install_language?>';this.form.submit();return false;" />
  </div>
</form>
