//<?php
/**
 * TransAlias
 *
 * エイリアスとして入力された文字列をURLとして無難に扱える文字に正規化。日本語では、ひらがな・カタカナを半角ローマ字に変換します
 *
 * @category    plugin
 * @version     1.0.1
 * @license     http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @package     modx
 * @subpackage  modx.plugins.transalias
 * @author      Olivier B. Deland, additions by Mike Schell, rfoster
 * @internal    @properties &table_name=Trans table;list;common,russian,utf8,utf8lowercase;utf8lowercase &char_restrict=Restrict alias to;list;lowercase alphanumeric,alphanumeric,legal characters;legal characters &remove_periods=Remove Periods;list;Yes,No;No &word_separator=Word Separator;list;dash,underscore,none;dash &override_tv=Override TV name;string;
 * @internal    @events OnStripAlias
 * @internal    @modx_category Manager and Admin
 * @internal    @installset base, sample
 */

/*
 * Initialize parameters
 */
if (!isset ($alias)) { return ; }
if (!isset ($plugin_dir) ) { $plugin_dir = 'transalias'; }
if (!isset ($plugin_path) ) { $plugin_path = $modx->config['base_path'].'assets/plugins/'.$plugin_dir; }
if (!isset ($table_name)) { $table_name = 'common'; }
if (!isset ($char_restrict)) { $char_restrict = 'lowercase alphanumeric'; }
if (!isset ($remove_periods)) { $remove_periods = 'No'; }
if (!isset ($word_separator)) { $word_separator = 'dash'; }
if (!isset ($override_tv)) { $override_tv = ''; }

if (!class_exists('TransAlias')) {
    require_once $plugin_path.'/transalias.class.php';
}
$trans = new TransAlias($modx);

/*
 * see if TV overrides the table name
 */
if(!empty($override_tv)) {
    $tvval = $trans->getTVValue($override_tv);
    if(!empty($tvval)) {
        $table_name = $tvval;
    }
}

/*
 * Handle events
 */
$e =& $modx->event;
switch ($e->name ) {
    case 'OnStripAlias':
        if ($trans->loadTable($table_name, $remove_periods)) {
            $output = $trans->stripAlias($alias,$char_restrict,$word_separator);
            $e->output($output);
            $e->stopPropagation();
        }
        break ;
    default:
        return ;
}