<?php
/**
 * MODx language File
 *
 * @author MODx Japanese Community
 * @package MODx
 * @version 1.0
 * 
 * Filename:       /install/lang/japanese-utf8/japanese-utf8.inc.php
 * Language:       Japanese
 * Encoding:       utf-8
 */
$_lang["agree_to_terms"] = 'ライセンスが規定する諸条件を確認しインストールを実行してください';
$_lang["alert_database_test_connection"] = 'データベースを生成するか、もしくはデータベースのテストを行う必要があります';
$_lang["alert_database_test_connection_failed"] = 'The test of your database selection has failed!';
$_lang["alert_enter_adminconfirm"] = '管理者パスワードと確認パスワードが一致しません。';
$_lang["alert_enter_adminlogin"] = 'システム管理者のユーザー名を入力してください';
$_lang["alert_enter_adminpassword"] = 'システム管理者のパスワードを入力してください';
$_lang["alert_enter_database_name"] = 'データベース名の入力をしてください';
$_lang["alert_enter_host"] = 'DBのホスト名を入力してください';
$_lang["alert_enter_login"] = 'DBのログイン名を入力してください';
$_lang["alert_server_test_connection"] = 'サーバー接続をテストしてください';
$_lang["alert_server_test_connection_failed"] = 'サーバー接続テストが失敗しました';
$_lang["alert_table_prefixes"] = 'データベーステーブルのプリフィクスは文字から始めなければいけません。';
$_lang["all"] = '全て選択';
$_lang["and_try_again"] = 'これらのエラーを修正し、右下の「再チェック」ボタンをクリックしてください。';
$_lang["and_try_again_plural"] = 'これらのエラーを修正し、右下の「再チェック」ボタンをクリックしてください。'; //Plural form
$_lang["begin"] = '開始';
$_lang["btnback_value"] = '戻る';
$_lang["btnclose_value"] = 'インストール終了';
$_lang["btnnext_value"] = '進む';
$_lang["cant_write_config_file"] = 'MODxは設定ファイルを記述できませんでした。以下をコピーして設定ファイルに反映してください ';
$_lang["cant_write_config_file_note"] = '実行後は、あなたのサイト名/manager/　にアクセスすることで管理画面にログインできます。';
$_lang["checkbox_select_options"] = '拡張機能の選択:';
$_lang["checking_if_cache_exist"] = '<span class="mono">/assets/cache</span>ディレクトリの存在チェック(なければ転送に失敗しています): ';
$_lang["checking_if_cache_file_writable"] = 'ファイル<span class="mono">/assets/cache/siteCache.idx.php</span>の書き込み属性(606などに設定): ';
$_lang["checking_if_cache_file2_writable"] = 'ファイル<span class="mono">/assets/cache/sitePublishing.idx.php</span>の書き込み属性(606などに設定): ';
$_lang["checking_if_cache_writable"] = '<span class="mono">/assets/cache</span>ディレクトリの書き込み属性(707などに設定): ';
$_lang["checking_if_config_exist_and_writable"] = 'ファイル<span class="mono">/manager/includes/config.inc.php</span>の存在と書き込み属性: ';
$_lang["checking_if_export_exists"] = '<span class="mono">/assets/export</span>ディレクトリの存在(なければ転送に失敗しています): ';
$_lang["checking_if_export_writable"] = '<span class="mono">/assets/export</span>ディレクトリの書き込み属性(707などに設定): ';
$_lang["checking_if_images_exist"] = '<span class="mono">/assets/images</span>,<span class="mono">/assets/files</span>,<span class="mono">/assets/flash</span>,<span class="mono">/assets/media</span>ディレクトリの存在(なければ転送に失敗しています): ';
$_lang["checking_if_images_writable"] = '<span class="mono">/assets/images</span>,<span class="mono">/assets/files</span>,<span class="mono">/assets/flash</span>,<span class="mono">/assets/media</span>ディレクトリの書き込み属性(707などに設定): ';
$_lang["checking_mysql_strict_mode"] = 'Checking MySQL for strict mode: ';
$_lang["checking_mysql_version"] = 'MySQLのバージョン: ';
$_lang["checking_php_version"] = 'PHPのバージョンチェック: ';
$_lang["checking_registerglobals"] = 'Register_Globalsの設定: ';
$_lang["checking_registerglobals_note"] = 'Register_Globalsがオンになっていると、サイトはXSS攻撃の対象としてさらされます。非常に危険ですので、特に必要がなければオフにしてください。.htaccessに「php_flag register_globals off」と記述を加えることでオフに設定できます。'; //Look at changing this to provide a solution.
$_lang["checking_sessions"] = 'セッション情報が正常に構成されるかどうか: ';
$_lang["checking_table_prefix"] = 'Tableプリフィックスの設定 `';
$_lang["chunks"] = 'チャンク';
$_lang["config_permissions_note"] = '<span class="mono">config.inc.php</span>という名前の空ファイルを作って<span class="mono">/manager/includes/</span>ディレクトリに転送するか、すでに転送済みのconfig.inc.php.blankをリネームするなどし、パーミッションを606などに設定してください。';
$_lang["connection_screen_collation"] = '照合順序(文字セット指定含む):';
$_lang["connection_screen_connection_method"] = '接続時の文字セットの扱い:';
$_lang["connection_screen_database_connection_information"] = 'データベース設定';
$_lang["connection_screen_database_connection_note"] = 'データベース名を入力してください。データベース作成権限がある場合は、指定に従ってデータベースが作成されます。<br />文字セットの扱いは「SET CHARACTER SET」、接続照合順序は「utf8_general_ci」をおすすめします。<br />※なおMySQL4.1未満ではこれらのエンコード設定を無視して日本語を扱います。';
$_lang["connection_screen_database_host"] = 'データベースホスト名:';
$_lang["connection_screen_database_info"] = 'データベース設定';
$_lang["connection_screen_database_login"] = 'データベース接続ログイン名:';
$_lang["connection_screen_database_name"] = 'データベース名:';
$_lang["connection_screen_database_pass"] = 'データベース接続パスワード:';
$_lang["connection_screen_database_test_connection"] = 'ここをクリックして指定条件による既存データベースとのマッチングを確認できます。権限がある場合は、ここで条件を指定しデータベースを新規に作成できます';
$_lang["connection_screen_default_admin_email"] = 'email:';
$_lang["connection_screen_default_admin_login"] = 'ログイン名(半角英数字):';
$_lang["connection_screen_default_admin_note"] = 'デフォルトの管理アカウントを作成します。メールアドレスはパスワード再発行の際に必要となるので、タイプミスがないよう気をつけてください。';
$_lang["connection_screen_default_admin_password"] = 'パスワード:';
$_lang["connection_screen_default_admin_password_confirm"] = 'パスワード(確認入力):';
$_lang["connection_screen_default_admin_user"] = 'デフォルトの管理アカウント作成';
$_lang["connection_screen_defaults"] = '管理アカウントの初期設定';
$_lang["connection_screen_server_connection_information"] = 'データベースホストへの接続';
$_lang["connection_screen_server_connection_note"] = 'データベースサーバのホスト名・ログイン名・パスワードを入力し、「ここをクリック」をクリックし接続テストをしてください。<br />※MODx本体はMySQL4.0.2以上をサポートしますが、MySQL4.1未満ではAjaxSearchなど一部の同梱アドオンの機能が制限されます。ご注意ください。';
$_lang["connection_screen_server_test_connection"] = 'ここをクリックすると正常に接続できるかどうかを確認できます';
$_lang["connection_screen_table_prefix"] = 'Tableプリフィクス:';
$_lang["creating_database_connection"] = 'データベース接続: ';
$_lang["database_alerts"] = 'データベースの警告';
$_lang["database_connection_failed"] = 'データベース接続に異常があります';
$_lang["database_connection_failed_note"] = 'データベースのログイン設定を確認し、再びチェックを試してください。';
$_lang["database_use_failed"] = 'データベースを選択できません';
$_lang["database_use_failed_note"] = 'データベースのユーザー権限を再確認してください。';
$_lang["default_language"] = '管理画面で使用する言語';
$_lang["default_language_description"] = '管理画面で使用する言語を選択してください。';
$_lang["during_execution_of_sql"] = ' during the execution of SQL statement ';
$_lang["encoding"] = 'utf-8';	//charset encoding for html header
$_lang["error"] = 'エラー';
$_lang["errors"] = 'エラー'; //Plural form
$_lang["failed"] = '確認してください';
$_lang["help"] = 'Help!';
$_lang["help_link"] = 'http://modxcms.com/forums/index.php/board,109.0.html';
$_lang["help_title"] = 'インストールで困ったらココをチェック(MODxフォーラム)';
$_lang["iagree_box"] = '<b><a href="../assets/docs/license.txt" target="_blank">このライセンス(GPL2)</a>で規定される諸条件に同意します。</b></p><p><a href="http://www.opensource.jp/gpl/gpl.ja.html" target="_blank">GPL2ライセンスの日本語訳はこちらにあります。</a>この翻訳には法的効力はないため、<b>厳密な法的検証が必要な場合</b>は必ず英語の原文をご確認ください。';
$_lang["install"] = 'インストール';
$_lang["install_overwrite"] = 'インストール - ';
$_lang["install_results"] = 'インストールを完了しました。おつかれさまでした！';
$_lang["install_update"] = '';
$_lang["installation_error_occured"] = 'インストール中に以下のエラーが発生しました';
$_lang["installation_install_new_copy"] = '新規インストールします';
$_lang["installation_install_new_note"] = 'すでにMODxをインストールしている場合はデータを上書きします。<br />※Tableプリフィクスが異なる場合を除く';
$_lang["installation_mode"] = 'インストールの選択';
$_lang["installation_new_installation"] = '新規インストール';
$_lang["installation_note"] = '<strong>はじめに:</strong>管理画面に無事にログインできたら、リソース(旧称・ドキュメント)および各種設定を日本語を含めて編集・保存し、文字化けが起きないかどうかを必ず確認してください。';
$_lang["installation_successful"] = 'インストールは無事に成功しました。';
$_lang["installation_upgrade_advanced"] = 'カスタムアップデート<br /><small>(データベース設定を変更できます)</small>';
$_lang["installation_upgrade_advanced_note"] = 'データベース設定の変更を伴うアップデートが必要な場合はこちらを選んでください。<br />';
$_lang["installation_upgrade_existing"] = '通常アップデート';
$_lang["installation_upgrade_existing_note"] = 'コアファイル・リソースファイルの両方とデータベースをアップデートします。';
$_lang["installed"] = 'インストールしました';
$_lang["installing_demo_site"] = 'サンプルサイトのインストール: ';
$_lang["language_code"] = 'ja';	// for html element e.g. <html xml:lang="ja" lang="ja">
$_lang["loading"] = '処理中...';
$_lang["modules"] = 'モジュール';
$_lang["modx_footer1"] = '&copy; 2005-2009 the <a href="http://www.modxcms.com/" target="_blank" style="color: green; text-decoration:underline">MODx</a> Content Mangement Framework (CMF) project. All rights reserved. MODx is licensed under the GNU GPL.';
$_lang["modx_footer2"] = 'MODx is free software.  We encourage you to be creative and make use of MODx in any way you see fit. Just make sure that if you do make changes and decide to redistribute your modified MODx, that you keep the source code free!';
$_lang["modx_install"] = 'MODx &raquo; インストール';
$_lang["modx_requires_php"] = ', and MODx requires PHP 4.2.0 or later';
$_lang["mysql_5051"] = ' MySQL server version is 5.0.51!';
$_lang["mysql_5051_warning"] = 'MySQL 5.0.51には不具合が確認されています。アップデートをおすすめします。';
$_lang["mysql_version_is"] = ' Version ';
$_lang["none"] = '全ての選択を解除';
$_lang["not_found"] = 'not found';
$_lang["ok"] = '問題なし';
$_lang["optional_items"] = 'インストールオプションの選択';
$_lang["optional_items_note"] = 'オプションを選択してください:<br /><br />初めてMODxを試す人は、全てチェックを入れましょう。<br />※日本チームより：「サンプルサイト」については、内容が古いうえに十分に検証されていません。参考程度にお試しください。';
$_lang["php_security_notice"] = '<legend>セキュリティ警告</legend><p>このサーバ上で稼働しているPHPには重大な問題があります。MODxの稼働自体には問題はありませんが、このバージョンのPHPには報告されている脆弱性がいくつか存在し、MODxに限らず様々なPHPアプリを通じて多数の攻撃にさらされてきました。バージョン4.3.8より古いPHPは深刻な脆弱性を抱えています。この機会にPHPのアップデートをおすすめします。</p>';
$_lang["please_correct_error"] = 'があります。';
$_lang["please_correct_errors"] = 'があります。'; //Plural form
$_lang["plugins"] = 'プラグイン';
$_lang["preinstall_validation"] = 'インストール前の状態確認';
$_lang["remove_install_folder_auto"] = 'インストールディレクトリを自動的に削除する<br />※この操作はサーバ設定によっては実行されないことがあります。<br />削除できなかった場合は、管理画面ログイン時に太文字で警告が表示されますので、手作業で削除してください。';
$_lang["remove_install_folder_manual"] = '管理画面にログインする前に、&quot;<b>install</b>&quot; フォルダを忘れずに削除してください。';
$_lang["retry"] = '再チェック';
$_lang["running_database_updates"] = '実行中のデータベースのアップデート: ';
$_lang["sample_web_site"] = 'サンプルサイト';
$_lang["sample_web_site_note"] = '<span style="font-style:normal;">新規インストールの場合は関係ありませんが、すでにMODxでサイトを構成している場合は<strong style="color:#CC0000;">上書き</strong>されます。ご注意ください。</span>';
$_lang["session_problem"] = 'サーバー接続に問題が発生しました。問題修正のために、サーバー管理者へ相談してください。';
$_lang["session_problem_try_again"] = '再試行しますか?'; 
$_lang["setup_cannot_continue"] = '上記理由のため、セットアップは現在継続できません。';
$_lang["setup_couldnt_install"] = 'MODx setup couldn\'t install/alter some tables inside the selected database.';
$_lang["setup_database"] = 'セットアップ結果<br />';
$_lang["setup_database_create_connection"] = 'データベース接続: ';
$_lang["setup_database_create_connection_failed"] = 'データベース接続に失敗しました!';
$_lang["setup_database_create_connection_failed_note"] = 'データベースのログイン情報を確認して再試行してください。';
$_lang["setup_database_creating_tables"] = '必要なテーブルの作成: ';
$_lang["setup_database_creation"] = 'Creating database `';
$_lang["setup_database_creation_failed"] = 'データベース生成に失敗しました';
$_lang["setup_database_creation_failed_note"] = ' - データベース生成ができませんでした';
$_lang["setup_database_creation_failed_note2"] = 'セットアップ時にデータベースの生成ができず、同名のデータベースも見つかりませんでした。ホスティング会社がデータベース生成スクリプトを許可していないようです。ホスティング会社の手順に従い、データベースを生成後セットアップを再開してください。';
$_lang["setup_database_selection"] = 'データベース選択 `';
$_lang["setup_database_selection_failed"] = 'データベース選択が失敗しました';
$_lang["setup_database_selection_failed_note"] = 'データベースが存在しません。データベース生成を試行します。';
$_lang["snippets"] = 'スニペット';
$_lang["some_tables_not_updated"] = 'いくつかのテーブルはアップデートされませんでした。修正などに起因しているようです。';
$_lang["status_checking_database"] = '...    データベースとのマッチング: ';
$_lang["status_connecting"] = ' DBホストとの接続テストの結果: ';
$_lang["status_failed"] = '接続できません';
$_lang["status_failed_could_not_create_database"] = 'データベースを作成できません';
$_lang["status_failed_database_collation_does_not_match"] = '問題があります - データベース側の照合順序のデフォルト値が「%s」になっています。phpMyAdminが利用できる場合は、該当データベースの「操作」タブで照合順序のデフォルト値を変更できます。';
$_lang["status_failed_table_prefix_already_in_use"] = '接続できません - このTableプリフィクスはすでに使われています。異なるTableプリフィクスを指定するか、phpMyAdminなどを利用し関連Tableを削除してください。';
$_lang["status_passed"] = '問題ありません';
$_lang["status_passed_database_created"] = 'データベースを作成できます';
$_lang["status_passed_server"] = '接続できます';
$_lang["strict_mode"] = ' MySQLがstrictモードになっています。';
$_lang["strict_mode_error"] = 'ストリクトモードが無効である必要があります。my.cnfを編集することで、MySQLのモードを変更することができます。あるいは、サーバー管理者へお尋ねください。';
$_lang["summary_setup_check"] = '<strong>インストール実行前の最終チェックです。</strong>';
$_lang["table_prefix_already_inuse"] = ' - このテーブルプリフィクスはすでに使われています。';
$_lang["table_prefix_already_inuse_note"] = '異なるテーブルプリフィクスを指定するか、phpMyAdminなどを利用し関連テーブルを削除し、再びインストールを試してみてください。';
$_lang["table_prefix_not_exist"] = ' - データベーステーブルのプリフィクスがTable prefix does not exist in this database!';
$_lang["table_prefix_not_exist_note"] = 'Setup couldn\'t install into the selected database, as it does not contain existing tables with the prefix you specified to be upgraded. Please choose an existing table prefix, and run Setup again.';
$_lang["templates"] = 'テンプレート';
$_lang["to_log_into_content_manager"] = 'おつかれさまでした。「インストール終了」ボタンをクリックすると、<a href="../manager/">管理画面のログインページ</a>(manager/index.php)にアクセスします。';
$_lang["toggle"] = '選択状態を反転';
$_lang["unable_install_chunk"] = 'Unable to install chunk.  File';
$_lang["unable_install_module"] = 'Unable to install module.  File';
$_lang["unable_install_plugin"] = 'Unable to install plugin.  File';
$_lang["unable_install_snippet"] = 'Unable to install snippet.  File';
$_lang["unable_install_template"] = 'Unable to install template.  File';
$_lang["upgrade_note"] = '<strong>注意:</strong>管理画面に無事にログインできたら、リソース(旧称・ドキュメント)および各種設定を日本語を含めて編集・保存し、文字化けが起きないかどうかを必ず確認してください。また管理画面内の「イベントログ」を開き、エラーの有無をご確認ください。';
$_lang["upgraded"] = 'アップデートしました';
$_lang["visit_forum"] = '';
$_lang["warning"] = '注意 ';
$_lang["welcome_message_start"] = '';
$_lang["welcome_message_text"] = '心踊る、未知の領域へようこそ。ガイドに従ってインストールを進めましょう。MODxのインストールは簡単。インストーラの説明に従って、次へ次へと進めてください。<br /><br />このインストーラの手順に従うことにより、他のCMSとのデータベースの共有設定(Tableプリフィクス)や、サンプルコンテンツ及び、推奨される拡張機能のインストールを個別に選択できます。何も選択せずシンプルにコアのみをインストールすることもできます。また、すでに運用中のMODxをアップデートしたり、データベースの設定を変更することもできます。';
$_lang["welcome_message_welcome"] = 'MODxのインストールを開始します。';
$_lang["writing_config_file"] = 'config.inc.phpへの書き込み(設定情報): ';
$_lang["you_running_php"] = ' - You are running on PHP ';
?>