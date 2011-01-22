/**
 * mm_demo_rules
 * 
 * サンプルサイト用のManagerManagerルール <strong style="color:#CC0000;">【注意】</strong>このルールが有効になっている場合は投稿画面がMODx標準の状態と異なっているためご注意ください。インストール後ManagerManager プラグインを無効にして見比べてみることをおすすめします。内容はphp文として評価されるので、工夫次第で高度な投稿画面カスタマイズが可能です。
 * 
 * @category	chunk
 * @version 	1.0.1
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal 	@modx_category Demo Content
 */

// PHP *is* allowed

mm_default('pub_date', 'return date("Y/m/d H:i:s");','','',true); // pub_dateの既定値をセットします
mm_widget_tags('documentTags',' '); // MODx Evolution 及びVer0.9系以前に実装されていたMETAタグ機能の代わりに用いるとよいでしょう
mm_widget_showimagetvs(); // Imageタイプのテンプレート変数の画像をプレビューします


// 以下、全てコメントアウトしています。サンプルとして参考にしてみてください。

// mm_renameField('introtext','ページの要約'); //「introtext」の項目名を変更する
// mm_changeFieldHelp('alias', 'このページのエイリアス名を入力。URLとして用いるため半角英数で。'); // エイリアスのチップヘルプをカスタマイズ
// mm_widget_colors('color', '#666666'); // マウス操作で色を選択しカラーコードを入力するウィジェット

// Administratorロール以外(!1でID=1以外という意味)のメンバーに対する指定
// mm_hideFields('link_attributes', '!1');
// mm_hideFields('loginName ', '!1');
// mm_renameField('alias','URL alias','!1');


// 「$news_role」と「$news_tpl」それぞれにロールID・テンプレートIDを設定します。

// $news_role = '3';
// mm_hideFields('pagetitle,menutitle,link_attributes,template,menuindex,description,show_in_menu,which_editor,is_folder,is_richtext,log,searchable,cacheable,clear_cache', $news_role); // 大半の入力項目を隠して投稿画面をシンプルにします
// mm_renameTab('settings', '公開設定', $news_role); // settingsタブのタブ名を変更します
// mm_synch_fields('pagetitle,menutitle,longtitle', $news_role); // 3つの入力項目の値を揃えます
// mm_renameField('longtitle','Headline', $news_role, '', 'This will be displayed at the top of each page');

// 新着情報テンプレート用(サンプルコンテンツには含まれない架空のテンプレートです)
// $news_tpl = '8';
// mm_createTab('Categories','HrCats', '', $news_tpl, '', '600'); // 投稿画面にHrCatsというタブを追加
// mm_moveFieldsToTab('updateImage1', 'general', '', $news_tpl); // テンプレート変数「updateImage1」をgeneralタブに移動
// mm_hideFields('menuindex,show_in_menu', '', $news_tpl); // menuindexとshow_in_menuを隠す
// mm_changeFieldHelp('longtitle', 'The story\'s headline', '', $news_tpl); // チップヘルプをカスタマイズ
// mm_changeFieldHelp('introtext', 'A short summary of the story', '', $news_tpl);
// mm_changeFieldHelp('parent', 'To move this story to a different folder: Click this icon to activate, then choose a new folder in the tree on the left.', '', $news_tpl);





/* ==========================================================
以下、簡易リファレンスです。

$field            - フィールド名をひとつだけ指定できる
$fields           - カンマで区切ってフィールド名を複数指定可
$roles            - このルールを有効とするロールをIDで指定(複数指定可)
$templates または $tplIds  - このルールを有効とするテンプレートをIDで指定(複数指定可)



# フィールド名を変更する
mm_renameField($field, $newlabel, $roles, $templates, $newhelp)
例：mm_renameField('longtitle', '長い長い長い長い長いタイトル', '', '3');


# フィールドを表示しない
mm_hideFields($fields, $roles, $templates)
例：mm_hideFields('alias', '1', '3');


# フィールド右側のチップヘルプの内容を書き換える
mm_changeFieldHelp($field, $helptext, $roles, $templates)
例：mm_changeFieldHelp('alias', 'エイリアンではない', '1');


# 任意のテンプレートをテンプレート選択肢から隠す
mm_hideTemplates($tplIds, $roles, $templates)
例：mm_hideTemplates('0,4', '1');


# リソースを新規作成時、親リソースに値が入力されていればそれを既定値とする
mm_inherit($fields, $roles, $templates)
例：mm_inherit('pagetitle,longtitle');


# リソース新規作成時に既定値をセット (※dateタイプ・0/1タイプのフィールドのみ対応)
mm_default($field, $value, $roles, $templates, $eval)
例：mm_default('pub_date')
このルールは通常、フィールド名のみを記述します(mm_default('pub_date')で今日の日付)
$eval をtrueにセットすると $value をphp文として解釈します(例：return date("Y/m/d H:i:s");)
たとえば return date("Y/m/d H:i:s", now()+(60*60*24*365*100))などの値を与えて
100年後の日付をセットすることができます


# 複数のフィールドの値を同期
mm_synch_fields($fields, $roles, $templates)
例：mm_synch_fields('pagetitle,menutitle,longtitle');


# 任意のフィールドを入力必須にする
mm_requireFields($fields, $roles, $templates)
例：mm_requireFields('description,alias', $roles, $templates);


# 任意のタブの名前を変更する
mm_renameTab($tab, $newlabel, $roles, $templates)
例：mm_renameTab('settings', 'ページの設定', '2');


# 任意のタブを非表示にする
mm_hideTabs($tabs, $roles, $templates)
例：mm_hideTabs('settings');


# 投稿画面にタブを新規に追加する
mm_createTab($name, $id, $roles, $templates, $intro, $width)
例：mm_createTab('Categories', 'neko');
$intro で簡易の説明文を表示できます。$width はcontent(本文)をこのタブに
表示する時にその横幅を 100%・450px として指定できます
$id はManageManagerの内部処理の都合で必要です。必ず指定してください
(後述のmm_moveFieldsToTabルールを利用する時にも必要になります)


# 任意のフィールドまたはテンプレート変数を任意のタブに移動します
mm_moveFieldsToTab($fields, $newtab_id, $roles, $templates)
例：mm_moveFieldsToTab('pub_date,pagetitle', 'neko'); // pub_dateとpagetitleを新規に作ったタブ「neko」に移動
metatags・which_editorなど一部のフィールドは対応していません


# 任意の「セクション」の名前を変更する
mm_renameSection($section, $newlabel, $roles, $templates)
例：mm_renameSection('docsettings', 'ページ情報', '2');
docsettings・content・tvs・access・historyの5つがあります


# 任意のフィールドに「タグウィジェット」を適用します
mm_widget_tags($fields, $delimiter, $source, $display_count, $roles, $templates)
例：mm_widget_tags('tags');
タグ選択のGUIに置き換わります。MODxのMETAタグ機能の代わりに用います


# 入力タイプが「image」のテンプレート変数のプレビュー画像を表示
mm_widget_showimagetvs($fields, $w, $h, $thumbnailerUrl, $roles, $templates)
例：mm_widget_showimagetvs();
例2：mm_widget_showimagetvs('tv11', '300', '200', '/assets/snippets/phpthumb/phpThumb.php', '', '2');
標準で同梱されているShowImageTVsプラグインの代わりに用います


# 任意のフィールドにカラーコード選択ウィジェットを適用
mm_widget_colors($fields, $default, $roles, $templates)
例：mm_widget_colors('tv6', '#000000', '1', '2');


# 投稿画面へのアクセスを制限する
mm_widget_accessdenied($ids, $message, $roles)

*/
