// <?php 
/**
 * Doc Manager
 * 
 * テンプレート・権限・公開／非公開などのドキュメント設定を一括変更
 * 
 * @category	module
 * @version 	1.1
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal	@properties	 
 * @internal	@guid 	
 * @internal	@shareparams 1
 * @internal	@dependencies requires files located at /assets/modules/docmanager/
 * @internal	@modx_category Manager and Admin
 * @internal    @installset base, sample
 */

include_once(MODX_BASE_PATH.'assets/modules/docmanager/classes/docmanager.class.php');
include_once(MODX_BASE_PATH.'assets/modules/docmanager/classes/dm_frontend.class.php');
include_once(MODX_BASE_PATH.'assets/modules/docmanager/classes/dm_backend.class.php');

$dm = new DocManager($modx);
$dmf = new DocManagerFrontend($dm, $modx);
$dmb = new DocManagerBackend($dm, $modx);

$dm->ph = $dm->getLang();
$dm->ph['theme'] = $dm->getTheme();
$dm->ph['ajax.endpoint'] = MODX_SITE_URL.'assets/modules/docmanager/tv.ajax.php';
$dm->ph['datepicker.offset'] = $modx->config['datepicker_offset'];
$dm->ph['datetime.format'] = $modx->config['datetime_format'];

if (isset($_POST['tabAction'])) {
    $dmb->handlePostback();
} else {
    $dmf->getViews();
    echo $dm->parseTemplate('main.tpl', $dm->ph);
}