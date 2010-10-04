<?php
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.");
?>
<style type="text/css">
h3 {font-weight:bold;letter-spacing:2px;font-size:1;margin-top:10px;}
pre {border:1px dashed #ccc;background-color:#fcfcfc;padding:15px;}
ul {margin-bottom:15px;}
</style>

<div class="sectionHeader">知っておくと便利</div>
<div class="sectionBody" style="padding:10px 20px;">
<h3>フレンドリーURLを有効にする</h3>
<p>
各ページのURLはindex.php?id=xxxという形式になっていますが、サーバ側にインストールされているmod_rewriteモジュールの機能を利用し、静的構成のサイトのような /dir/page.html という形式でURLを扱うこともできます。</p>
<p>
まず、インストールディレクトリにある「ht.access」を「.htaccess」にリネームします(※サーバによってはOptions +FollowSymlinks記述を有効にしないとサーバのURL書き換え機能が働かないことがあります)。次にMODx側のフレンドリーURL出力を有効にするために<a href="index.php?a=17">グローバル設定</a>を開き、「フレンドリーURLの使用」を「はい」にしてください。すると関連する設定項目が追加表示されます。
</p>
<ul>
<li>フレンドリーURLの接頭辞 → 空白</li>
<li>フレンドリーURLの接尾辞 →「 .html」</li>
<li>フレンドリエイリアス →「はい」</li>
<li>エイリアスパスを使用 →「はい」</li>
<li>重複エイリアスを許可 →「いいえ」</li>
<li>エイリアス自動生成 →「いいえ」</li>
</ul>
<p>
一般的にはこのように設定します。拡張子を自由にコントロールしたい場合は「フレンドリーURLの接尾辞」を空白にしておいて、リソースのエイリアスで拡張子込みのファイル名を指定するとよいでしょう。たとえばCSSファイルやXMLファイルもリソースとして管理したいが、拡張子がhtmlになるのを避けたい場合に有効です。また、MODxのURLコントロール機能を補佐する<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=SEO+Strict+URLs" target="_blank">「SEO Strict URLs」</a>プラグインが知られています。
</p>

<h3>相対パスを利用する</h3>
<p>
同梱のTinyMCEプラグインに関する設定です。MODxのリンクタグは、常にMODx稼働ルートディレクトリ基準の相対URLを出力します。このためフレンドリーURL設定でサイト運用を行なっている場合は、サイト内のページや画像にリンクを張った時にディレクトリずれが発生します。これを防ぐために、TinyMCE側では基準となるパスを補ったうえで投稿内容を更新するようになっています。パスを補う際の判定基準は「パスの先頭がスラッシュまたはhttp:で始まっているかどうか」となっています。このような設定になっていることで、既存のオーサリングツールによるサイト構築スキルをそのまま生かしてテンプレートを作ることができます。
</p>
<p>
より高度な使い方として、<a href="http://www.google.com/search?hl=ja&q=base+html" target="_blank">baseタグ</a>の利用を推奨します。これにより、論理的にクリーンな状態でサイトを運用することができます。この場合はTinyMCEプラグインの「Path Options」設定で「rootrelative」を選択します。具体的なメリットとしては、リンクの内容(srcまたはhrefの値)をスニペットでコントロールしやすくなります。スニペットが出力する値が常に相対パスであればなんとかなりますが、httpから始まるURLを出力したいこともあるでしょう。
</p>
<p>
相対パスをbaseタグでコントロールする場合のデメリットとしては、アンカータグによるサイト内移動の場合に多少の工夫が必要になることが挙げられます。baseタグで補われるのはルートURLのみなので、<a href="http://www.google.com/search?hl=ja&q=modx+%22Base+URL+Same-Page-Link+Fix%22" target="_blank">Base URL Same-Page-Link Fix</a>プラグインなどを用いて、アンカーに関してはアクセスしているページのURLごと補わないと、常にトップページにリンクが張られることになります。また、baseタグを解釈しない一部のクローラーが大量の404ログを残していくこともあるようです。
</p>

<h3>ナビゲーションを設置する</h3>

<p>
標準で同梱されているWayfinderを利用します。テンプレート中に[[Wayfinder]]と記述するだけで、とりあえずその時点で作られているリソースのリンク一覧を動的に出力します。</p>
<pre>
[[Wayfinder?startId=0&hideSubMenus=true]]
</pre>
<p>
一般的にはこのように記述します。Wayfinderには他にも豊富なオプションがあり、親子関係の表現なども自由にできます。ナビゲーションに関してはなんでもできる万能型のスニペットです。サイトマップも作れます。詳細については<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=wayfinder" target="_blank">ドキュメント</a>を確認してください。<br />
※規模が小さく構成変更も少ないサイトなら、スニペットを利用せず静的にナビゲーションを記述するのもよいでしょう。
</p>
<h3>パン屑リストを設置する</h3>
<p>標準で同梱されているBreadcrumbsスニペットを利用します。[[Breadcrumbs]] と記述するだけで適切な出力を得ることができますが、パラメータを追加して細かくカスタマイズすることもできます。詳細については<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=Breadcrumbs" target="_blank">ドキュメント</a>を確認してください。</p>
<h3>新着情報の一覧を設置する</h3>
<p>
標準で同梱されている<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=Ditto" target="_blank">Ditto</a>を利用します。リソースの一覧出力に関してはあらゆることができる、万能型スニペットです。新着情報の一覧だけでなく、ブログの実装も可能です。
</p>
<pre>
&lt;h3&gt;&lt;a href=&quot;[~[+id+]~]&quot;&gt;[+date+] - [+pagetitle+]&lt;/a&gt;&lt;/h3&gt;
&lt;div&gt;[+introtext+]&lt;/div&gt;
</pre>
<p>まず、上記のように記事一件あたりの出力パターンをチャンクで作ります。</p>
<pre>
[[Ditto?tpl=パターン名]]
</pre>
<p>任意のページに上記のように記述すると、サブリソースの一覧を指定パターンで出力します。</p>


<h3>問い合わせフォームを設置する</h3>
<p>
標準で同梱されているeFormスニペットが利用できます。</p>
<pre>
[!eForm?formid=form1&tpl=form&report=mailtpl!]
</pre>
<ul>
<li><b>formid</b> … フォームを識別するためのID。ページ内にフォームをひとつしか設置しない場合でも必ず記述します。</li>
<li><b>tpl</b> … フォームの本体。&lt;form&gt;～&lt;/form&gt;の部分を普通のhtmlで記述します。eFormはinput要素のname属性を読み取って処理します。基本的にはプレイスホルダーなどの専用タグを用いず実装できますが、細かい制御が必要な場合は各種のプレイスホルダーや、inputタグ内にeform属性などを記述します。</li>
<li><b>report</b> … 管理人が受け取るメールのテンプレート。自由にデザインできます。フォーム中のinput要素のname属性値を名前としてプレイスホルダーを記述してください。たとえばname="問い合わせ内容"となっていれば、[+問い合わせ内容+]と記述します。</li>
</ul>
<p>
この3つのパラメータは必須です。また、スニペットの性格上、出力のキャッシュを回避する必要があります。詳細は<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=eform" target="_blank">ドキュメント</a>を確認してください。
</p>
<p>さらに高機能なスニペットとしては<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=cfformmailer" target="_blank">cfFormMailer</a>が知られています。eFormでは実装が難しい確認画面を作ることもできます。
</p>

<h3>投稿画面をカスタマイズする(1)</h3>
<p>
標準で同梱されているManagerManagerプラグインを用いると投稿画面を自由にカスタマイズできます。カスタマイズルールを設定用のチャンク(デフォルトではmm_rules)に記述します。</p>
<pre>
mm_hideFields('longtitle,description,alias,link_attributes,introtext');
mm_hideFields('template,menutitle,menuindex,show_in_menu,hide_menu,parent');
mm_hideFields('published,pub_date,unpub_date');
mm_hideFields('is_folder,is_richtext,log,searchable,cacheable,clear_cache');
mm_hideFields('resource_type,content_type,content_dispo');
</pre>
<p>たとえば上記のように記述すると「リソース名」「内容(本文)」以外のほとんどのフィールドを隠すことができます。フィールド名の変更や他タブへの移動・デフォルト値のセットなど、他にも18種類のコマンドを利用できます。詳細については<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=ManagerManager" target="_blank">ドキュメント</a>を確認してください。</p>
<p>
カスタマイズルールのほとんどはテンプレート別・ロール別の制御が可能ですが、ルールはphp文による制御が可能ですので、独自の条件を設けることができます。
</p>
	<pre>
if($_REQUEST['id'] == '23') mm_hideFields('pub_date,unpub_date');
	</pre>
	<p>
たとえば上記のように記述すると、IDが23のリソースのみに対して公開開始日時と公開終了日時の入力フィールドを隠すことができます。その他、曜日や時間帯ごとのカスタマイズなど、様々なアイデアを用いることができます。
	</p>
<h3>投稿画面をカスタマイズする(2)</h3>
<p>
プラグインを自作します。
</p>
<pre>
$css = $modx-&gt;getChunk('管理画面用スタイルシート');
$modx-&gt;Event-&gt;output($css);
</pre>
<p>
プラグイン新規作成画面を開いて上記のようなコードを書き、システムイベントは「OnDocFormPrerender」にチェックを入れてプラグインを新規保存します。プラグイン名はなんでもかまいません。次に「管理画面用スタイルシート」という名前のチャンクを作り、スタイルシートを任意に記述します。OnDocFormPrerenderは投稿画面に関連付けられたシステムイベントなので、投稿画面のhtmlソースを参考にスタイルを記述します。
</p>
<pre>
?&gt;
&lt;style type=&quot;text/css&quot;&gt;
form#mutate div.tmplvars label {display:inline;}
&lt;/style&gt;
</pre>
<p>
たとえば上記のようなスタイルを書けば、チェックボックス・ラジオボタンタイプのテンプレート変数の選択肢を横並びにできます。選択肢が多い場合に便利です。<br />
※一行目の「 ?&gt; 」はphpの処理を抜けてhtmlをそのまま出力させるための記述です。詳細はphpの入門書などを参照してください。
</p>

<h3>投稿画面をカスタマイズする(3)</h3>
<p>
/assets/plugins/tinymce/style/content.cssを編集することで、TinyMCE(本文のテキストエリア)のスタイルシートをカスタマイズできます。また、グローバル設定の「CSSファイルへのパス」で自作のスタイルシートを指定することもできます。</p>
<p>
サイトの表示に用いるスタイルシートと共用したい場合は、まずコンテンツ領域専用にCSSファイルを作り、これを「CSSファイルへのパス」で指定します。次に、TinyMCEプラグイン設定の「Custom Parameters」に<a href="http://wiki.moxiecode.com/index.php/TinyMCE:Configuration/body_id" target="_blank">body_idパラメータ</a>を追記し、サイトと投稿画面のセレクタを揃えます。
<pre>
body_id:"content",
</pre>
id=contentのdiv要素内で記事を表示している場合は、上記のように指定します。セレクタとしてclassを用いている場合は<a href="http://wiki.moxiecode.com/index.php/TinyMCE:Configuration/body_class" target="_blank">body_classオプション</a>を使用してください。
</p>

<h3>投稿画面をカスタマイズする(4)</h3>
<p>
TinyMCEのツールバーの機能をカスタマイズできます。グローバル設定の「TinyMCEの設定 - カスタムボタン」で機能を任意に選び、「テーマ」で「カスタム」を選択してください。機能を利用する場合はプラグイン(TinyMCE用)の読み込みが必要なものもありますので、動かない場合は確認してください。実装できるボタンについては、TinyMCE開発元の<a href="http://tinymce.moxiecode.com/examples/full.php" target="_blank">サンプル</a>と<a href="http://wiki.moxiecode.com/index.php/TinyMCE:Control_reference" target="_blank">ドキュメント</a>を参考にしてください。なお、MODx同梱のTinyMCEではいくつかのプラグインを同梱してませんので(printやspellcheckerなど)、ボタンが実装できない場合は確認し、足りないものはTinyMCE開発元から入手してください。
</p>

<h3>日付タイプのリソース変数の出力書式を変更する</h3>
<p>
日付タイプのリソース変数は、そのまま[*createdon*]などと記述すると、<a href="http://www.google.com/search?hl=ja&q=UNIX+Timestamp" target="_blank">UNIX Timestamp</a>形式で日時データが出力されるため、実際の日時が分かりません。以下のようなスニペットを書いて出力するとよいでしょう。
</p>
<pre>
&lt;?php
return date('Y年m月d日', $modx-&gt;documentObject['createdon']);
?&gt;
</pre>
<p>
スニペット名を「ページ作成日」とした場合、[[ページ作成日]] と記述します。いっけん面倒ですが、このような小さな機能を手軽に作って利用できるのがMODxの有利な点であり、システムが扱うデータは加工のしやすさを優先したデータ形式となっています。
</p>

<h3>配布されているアドオン(スニペット・プラグイン)をインストールする</h3>
<p>
<a href="http://modxcms.com/extras/repository/10" target="_blank">MODx開発元のアドオン配布コーナー</a>ではさまざまなスニペット・プラグイン・モジュールが配布されています。現在のMODxはこれらのアドオンをシンプルで一律な手順でインストールする仕組みを持っていないため、基本的には配布ページに記述されている手順に沿ってインストールします。プラグインやモジュールに関してはインストーラが提供されていることもあります。連携ファイルを持たない小さなアドオンの場合は、管理画面の<a href="index.php?a=76">「エレメント管理」</a>で新規作成フォームを開き、コードをコピー・ペーストするだけで使えるようになります。</p>
<p>プラグインの場合はさらにシステムイベント設定タブでシステムイベントを設定する必要がありますが、MODx 1.0.3J以降はコードを貼り付けてtextarea以外の領域をクリックするだけで自動的にセットすることができるようになっています。
</p>

<h3>ログイン時に管理画面にアクセスさせない</h3>
<p>
<a href="index.php?a=75">ユーザ管理</a>の対象ユーザのアカウント編集ページの「詳細」タブを開き、「管理画面ログイン開始ページ」としてトップページのリソースIDを指定します。こうすると、対象ユーザがログインした時、自動的にサイトのトップページにリダイレクトされます。QuickManagerを利用すれば、管理画面を使わずフロントエンドだけで基本的なコンテンツ管理ができます。
</p>

<h3>Googleマップを貼り付ける(1)</h3>
<p>投稿画面を開き、「使用エディター」で「なし」を選びます。次に「ページ設定」のタブを開き「リッチテキストで編集」のチェックを外します。このチェックを外しておかないと、次に編集画面を開いた時にRTEがタグを削除してしまうことがあります。これでhtmlタグを自由に記述できるようになったので、Googleマップの「埋め込み地図」のタグを貼り付けます。</p>

<h3>Googleマップを貼り付ける(2)</h3>
<p>
Googleマップを貼り付ける方法はもうひとつあります。MODx投稿画面のTinyMCEツールバーの「HTMLソース編集」ボタンをクリックし、開いたダイアログに貼り付けます。</p>

<h3>YouTubeの動画を貼り付ける</h3>
<p>そのまま貼り付けられます。TinyMCEで開いている場合は「埋め込みメディアの挿入／編集」アイコンをクリックし、YouTubeの動画URLを貼り付けます。タイプは「Flash」を選んでください。HTMLソース編集ダイアログでプレイヤー展開コードをそのまま貼り付けることもできます。</p>

<h3>改行はシフト＋エンターキーで</h3>
<p>TinyMCEやCKEditorでリソース編集画面を開いている場合、エンターキーを押すとp要素で段落整形されるため、意図しない空行が挿入されたように見えることがあります。Validな文書を作るには便利な機能ですが、改行のみですませたいこともあります。シフトを押しながらエンターキーを押すと、改行(&lt;br /&gt;)のみが挿入されます。</p>

<h3>文字コードeuc-jpで運用する</h3>
<p>
管理画面に関しては標準でeuc言語ファイルを同梱しており、エンコード設定とセットで設定を変更することでMODxをeuc-jpで運用できます。設定を変更する前に必ずデータベースのバックアップをとってください。</p>
<p>MySQLのバージョンが4.1以上の場合は、グローバル設定の設定変更と共に、manager/includes/config.inc.phpの$database_connection_charsetの値をujisに書き換えてください。4.0系の場合はデータベースの中身をeuc-jpに変換する必要があります。</p>
<p>
スニペットやプラグインなどアドオンに関しては自前で環境を整える必要があります。すでにjapanese-utf8.inc.phpが用意されているケースが多いと思いますので、これをテキストエディタで開いて「japanese-euc.inc.php」というファイル名で、文字コードeuc-jpとして別名保存してください。これがeuc-jp言語ファイルとして、該当アドオンで利用できます。
</p>
<p>
euc-jp運用はポイントさえ押さえていれば難しくありませんし、MODxのシステム自体はutf-8・euc-jpどちらに優位ということもなく対等に動作します。しかしデフォルト設定の多くがutf-8寄りになっていますので、リスクがあることをしっかりと意識する必要があります。
</p>

<h3>日常の運用で気をつけるべきこと</h3>
<p>
<a href="index.php?a=114">イベントログ</a>に時々目を通し、想定外のエラーが発生してないか確認しましょう。また、データベースのバックアップはできるだけ定期的にとるようにします。ログは蓄積される一方なので、時々削除しましょう。将来的には上限を設定できるようになる予定です。
</p>

<h3>携帯電話向けコンテンツを作る</h3>

<p>
<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=MobileConverter" target="_blank">MobileConverterプラグイン</a>が便利です。携帯電話向けに、エンコードや画像形式の変換などを行ないます。

<h3>投稿画面のtextareaのスタイルシートをカスタマイズする</h3>
<p>
たとえば暗い背景に明るい文字色のサイトを管理するのに、白い背景の投稿画面だとイメージをつかみにくいです。この場合、投稿画面のテキストエリアのスタイルを自由にカスタマイズできます。<a href="index.php?a=17">グローバル設定</a>の「CSSファイルへのパス」で指定されているスタイルシートで、投稿画面を自由にカスタマイズできます。
</p>
<p>TinyMCEプラグイン設定タブ「Custom Parameters」の値に「 body_class : "content", 」を追記すると(contentは任意)、投稿画面中ではCSSセレクタ「body.content」の上にコンテンツを展開しているように見立てることができます。</p>

<h3>テンプレート変数の便利な使い方</h3>
<p>
テンプレート変数は「カスタムフィールド」のようなもので、投稿画面にオリジナルの入力項目を追加することができます。MODxでは十分に実用的な仕様となっており、入力・出力のそれぞれにおいて様々な制御ができるようになっています。</p>
<p>
まず入力においては、通常のテキスト入力以外に、ドロップダウンメニュー・チェックボックス・ラジオボタン・ファイルアップロード(画像も可)など一般的なフォーム要素と、リッチテキストやカレンダー入力などさらに高度なGUIを持つものを選ぶことができます。</p>
<p>
ドロップダウンメニューやチェックボックスなど、複数の選択肢を持つタイプのテンプレート変数は下記のように設置します。</p>
<pre>
<b>入力時のオプション値</b>
チャーリー||ハドソン||ダニエル||タイチ||ユーリー

<b>既定値</b>
ハドソン
</pre>
<p>このように「|| 」で区切ります。</p>

<h3>ウィジェット</h3>
<p>テンプレート変数の出力においては、ウィジェットを利用すると高度な制御が可能です。特に「HTML Generic Tag」や「Image」は実用的で、これらのウィジェットを適用したテンプレート変数は、値が何も入力されなかった場合は何も出力しません。</p>
<pre>
&lt;img src=&quot; &quot; /&gt;
</pre>
<p>
このような、属性が空のままのimg要素を出力してしまうことがありません。
</p>

<h3>ウィジェット処理を自作する(1)</h3>
<p>
標準実装のウィジェット機能は基本的な処理しかできません。しかしこれがMODxの限界ではありません。スニペットを通じてテンプレート変数にアクセスするとよいでしょう。
</p>

<pre>
&lt;?php
return mb_convert_kana($modx-&gt;documentObject['pagetitle'], 'Kas', 'utf-8');
?&gt;
</pre>
<p>
上記のコードを「全角半角変換」というスニペット名で保存すると、リソース名を半角に揃えて出力できます。
</p>

<pre>
&lt;?php
return mb_convert_kana($modx-&gt;documentObject['商品コード'][1], 'Kas', 'utf-8');
?&gt;
</pre>
<p>
テンプレート変数を処理したい場合は上記のように[1]を追加します。
</p>

<pre>
&lt;?php
$imagePath = $modx-&gt;documentObject[$tv][1];
$width = ($width) ? '&amp;w=' . $width : '';
$height = ($height) ? '&amp;h=' . $height : '';
if($imagePath &amp;&amp; file_exists(getenv('DOCUMENT_ROOT'). $imagePath))
{
	$site_url = rtrim($modx-&gt;getConfig('site_url'), '/');
	$imagePath = str_replace($site_url, '', $imagePath);
	$str  = '&lt;img src=&quot;/ajaxlib/phpthumb/phpThumb.php?src=';
	$str .= $imagePath . $width . $height . '&amp;q=90&amp;fltr[]=usm|80|0.5|3&amp;fltr[]=wb';
	$str .= '&quot; /&gt;';
}
return $str;
?&gt;
</pre>
<p>
上記のようなコードを「画像ウィジェット」というスニペット名で保存し、</p>
<pre>
[[画像ウィジェット?tv=テンプレート変数名&width=300&height=225]]
</pre>
<p>
このように呼び出すと、phpThumbライブラリを利用して横幅・縦幅を揃えつつガンマ調整・ホワイトバランス処理まで施す高度な画像処理を行なうウィジェットを実現できます。
</p>

<h3>ウィジェット処理を自作する(2)</h3>
<pre>
&lt;?php
if (empty($modx-&gt;documentObject['longtitle']))
{
    $title = $modx-&gt;documentObject['pagetitle'];
}
else
{
    $title = $modx-&gt;documentObject['longtitle'];
}
return $title;
?&gt;
</pre>
<p>
たとえば上記のようなスニペットを作って「タイトル」などの適当な名前で保存します。
</p>
<pre>
&lt;h1&gt;[[タイトル]]&lt;/h1&gt;
</pre>
<p>
テンプレートなどに上記のように記述すると、投稿画面の「タイトル」に入力がある場合は「タイトル」を、ない場合はリソース名を出力します。
</p>

<h3>リソース保存時に値を変換</h3>
<p>
データベースに値を保存する時点で形式を正しく揃えたい場合は、プラグインを作って保存時に処理を行ないます。
</p>
<pre>
global $pagetitle;
$pagetitle = mb_convert_kana($pagetitle, 'Kas', 'utf-8');
</pre>
<p>
上記のようなプラグインを作って、システムイベント「OnBeforeDocFormSave」にフックします。
</p>

<pre>
global $tmplvars;
foreach ($tmplvars as $field =&gt; $value)
{
	if (is_array($value))
	{
		switch($field)
		{
			case '3':
				$tmplvars[$field][1] = mb_convert_kana($tmplvars[$field][1], 'Kas', 'utf-8');
				break;
		}
	}
}
</pre>
<p>
テンプレート変数を処理したい場合は少し複雑です。上記のよう書いて、同じくシステムイベント「OnBeforeDocFormSave」にフックします。「3」というのはテンプレート変数のIDで、テンプレート変数名では指定できません。
</p>

<h3>Dreamweaverなどで作ったhtmlファイルをそのままテンプレートにする</h3>
<p>
Dreamweaverなどでhtmlを組みテンプレート編集画面に貼り付けるのは、細部の調整が続く場合は面倒に感じます。Dreamweaverの高度なテンプレート管理機能を利用して複数のテンプレートを一括管理している場合も、少しの変更のたびに全てのテンプレートを貼り付け直すのは手間がかかります。この場合、Dreamweaverで作ったhtmlファイルをそのまま読み込んでテンプレートとして解釈する方法を用いると便利です。残念ながらdwtファイルは解釈できませんが(スニペットを作ってパス変換すれば可能)、htmlファイルを読み込む前提で以下に方法を説明します。</p>
<p>
詳細は<a href="http://modxcms.com/forums/index.php/topic,10351.msg88947.html#msg88947" target="_blank">こちらのトピック</a>をご覧ください。テンプレート内にphpコードなどを書いて外部ファイルを直接呼び出すことはできないため、テンプレート変数の機能を経由します(<a href="http://modxcms.com/forums/index.php?topic=15438.0" target="_blank">スニペットを利用する方法</a>もあります)。MODxのテンプレート変数には<a href="http://wiki.modxcms.com/index.php/Bindings" target="_blank">「@Bindings」(アットバインディング)</a>と呼ばれる機能があり、これを利用します。「@Bindings」は、リソース編集画面でテンプレート変数に入力する値(通常は文字列)を、他のソースに差し替えるものです。「他のソース」としてどんなものがあるのかというと、htmlファイルやCSVファイルなどの「外部ファイル」、任意のリソース(旧称ドキュメント)、チャンク、php文のインライン実行結果、データベースからの抽出結果などが利用できるようになっています。つまりテキストを入力する代わりに、これらのソースから値を動的に引っ張ってくることができます。</p>
<p>実験的なスニペットとして<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=dwtinc" target="_blank">dwtinc</a>というものもあります。</p>
<p>
テンプレート製作にDreamweaverを用いる場合は<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=MODx+for+Dreamweaver" target="_blank">MODx for Dreamweaver</a>を利用すると便利です。
</p>

<h3>サイトをバックアップ・リストアしたい</h3>
<p>
<a href="index.php?a=93">バックアップマネージャー</a>を用いてデータベースをバックアップします。この時、データサイズの総計に気をつけてください。数MBものサイズに及ぶ場合はリストアに失敗することがあります。データが肥大する原因としてはログが考えられます。この場合はevent_logテーブルとmanager_logテーブルをバックアップ対象から外すか、いったんログをクリアするとよいでしょう。</p>
<p>サイト全体のページ数が多い時は、それでもサイズが大きいことがあります。この場合は複数のtableごとに分けてバックアップファイルを取得すると安全です。バックアップファイルはテキストファイルなので、テキストエディタで編集してください。
</p>
<p>バックアップしたデータを用いてサイトをリストアするには、phpMyAdminなどを利用してデータをインポートします。場合によっては、テキストエディタなどを使って、複数のデータに分けてリストアすることもできます(命令の単位で分けます)。
</p>

<h3>検索エンジン対策を充実させたい</h3>
<p>
MODxは検索エンジンとの相性がよいCMSですが、システム自体はSEOを特に意識した便利な仕組みを備えているわけではありません。MODxに限らず多くのCMSは、整合性の高いコンテンツ構成を維持しやすいため検索エンジンとの相性に優れています。MODxはCMSとしては「余計な出力を行なわない」という特性がありますので、コンテンツ的に純度の高いサイト作りをしやすいです。このため検索エンジンとの相性のよさも高まります。欲張らず、本当に伝えたいメッセージ作りに努めることが検索エンジン対策につながります。
</p>
<p>
<b>フレンドリーURL設定で運用する</b><br />
最近の検索エンジンは精度が高いため、<a href="http://www.google.com/search?q=seo+%E5%8B%95%E7%9A%84URL" target="_blank">動的URLであるという理由だけでインデックスに不利になることはありませんが</a>、見た目の分かりやすさは「クリックしやすさ」につながります。クリックされやすいURLがネットに浸透することにより、大局的には検索エンジンとの相性も向上します。
</p>
<p>
<b>canonical属性を設定する</b><br />
ページごとにcanonical属性を設定し、検索エンジンに渡すURLを確定します。
</p>
<pre>
&lt;link rel=&quot;canonical&quot; href=&quot;[(site_url)][~[*id*]~]&quot; /&gt;
</pre>
<p>
上記のように記述します。トップページにもパスが付加されますが実用的には問題ありません。
</p>
<p>
<b>title要素の工夫</b><br />
</p>
<pre>
&lt;title&gt;[*pagetitle*]|[(site_url)]&lt;/title&gt;
</pre>
<p>
上記のように、ページ名・サイト名の順に出力するとよいでしょう。欲張らずシンプルにまとめると効果があります。
</p>
<p>
<b>metaタグのdescription属性を積極的に使う</b>
</p>
<pre>
&lt;meta name=&quot;description&quot; content=&quot;[*description*]&quot; /&gt;
</pre>
<p>
上記のように記述します。分かりやすく好感を持てる印象的な説明文を書くことで「クリックされやすさ」を高めることができます。
</p>
<p>
<b>リンク切れをなくす</b><br />
モジュール<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=Error+404+Logger" target="_blank">「Error 404 Logger」</a>を用いるとリンク切れを効率よく管理できます。サイト内リンクを張る場合は、URLを直接張るのではなくリンクタグを記述すると、サイト構成の変更に伴うリンク切れを防ぐことができます。構築初期など構成が頻繁に変わる場合は、リンクタグの使用を推奨します。
</p>
<p>
<b>サイトマッププロトコルへの対応</b><br />
検索エンジンに渡すためのサイトマップを作成し、<a href="http://www.google.com/support/webmasters/bin/answer.py?answer=183669" target="_blank">検索エンジンに送信</a>します。<a href="http://modxcms.com/extras/package/410" target="_blank">sitemapスニペット</a>を利用すると手軽に作成できます。
</p>
<p>
<b>RSSフィードを出力する</b><br />
新着情報やブログを管理する場合は、RSSフィードの設置が効果的です。<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=rss+ditto&lr=lang_ja" target="_blank">Ditto</a>などを用いて実装できます。この場合、設置リソースのコンテントタイプはapplication/rss+xmlを選択するとよいでしょう。
</p>
<p>
<b>サイト内リンクを充実させる</b>
<p>
Wayfinder・Breadcrumbs・Dittoなどを用いて、サイト内リンクを(過剰にならない程度に)適切に張り巡らせます。
</p>
<p>
<b>html構成を最適化する</b>
<a href="http://www.google.com/search?hl=ja&q=html-lint" target="_blank">Another HTML-lint</a>サービスなどを利用し、html構成を最適化します。これ自体が検索エンジン対策として効果があるわけではありませんが、よりインデックスされやすいサイトを作る上で、多くのヒントを得ることができます。MODx本体および同梱のスニペットは、構造的にシンプルかつ最適なタグを出力するようになっており、コアや拡張機能を改造することなく精密なチューニングを行なうことができます。
</p>
<p>
なお、リッチテキストエディタを用いて編集する場合は、標準ではスニペットコール部分がp要素(段落)で囲まれます。表組みやリストなどをスニペットで出力する場合はイレギュラーな構文になりますが、適用するブロックをpではなくdivに変更することで回避できます。もしくは、リッチテキストエディタを利用する必要がない内容の場合は、リッチテキストエディタを使わない設定に変更するのもよいでしょう(リソースごとに設定できます)。
</p>
<p>
<b>サイトパフォーマンスを充実させる</b>
近年の検索エンジンはサイトの出力レスポンスを重視していると言われています。外部のJavaScriptファイルやCSSファイルはできるだけ連結・圧縮し、読み込む順番(CSSが先・JavaScriptが後)にも配慮するとよいでしょう。MODxはキャッシュ機能が標準で効果的に機能するため、こういったレベルの精密なチューニングも役に立ちます。
</p>
<p>
MODxシステム面での注意点としては、たとえばCSS・JavaScriptどちらもMODxのリソースとして管理することができるようになっていますが、一回のアクセスあたりの発行セッションがひとつ増えますので、そのぶんレスポンスが低下することを考慮する必要があります。JavaScript・CSSを動的に制御するためにリソースを使う代わりに、スニペットを利用してhead要素内にインラインで出力するほうがパフォーマンス的には優れています。
</p>
<p>
<b>metaタグのkeywords属性を使う</b>
metaタグのkeywords属性を使いたい場合は、[*キーワード*] などとして専用にテンプレート変数を作りましょう。グローバル設定の「META Keywordsタブを表示」を「はい」に設定することで、専用の管理インターフェイスを利用することもできます。
</p>
<p>
<b>SEO Strict URLsプラグインを使う</b>
SEO Strict URLsプラグインをインストールすると、検索エンジンとの相性がよいとされる各種のURLコントロールを実現できます。ただし多少の負荷が発生しますので、すでにある程度重くなっている場合・今後サイト構成が複雑になり重くなる可能性がある場合は採用を検討する必要があります。
</p>
<h3>会員制サイトを作る</h3>
<p>
まず「ウェブユーザ」アカウントを必要な人数ぶん作ります。次に、同梱のPersonalizeスニペットを用いて「ログインしている時」「ログインしていない時」の状態をそれぞれ制御します。とりあえず [!Personalize!] と記述するだけでも、ログイン状態を表示できます。ページ単位で会員向け領域を制御したい場合はグループ管理機能を使用します。この場合、ユーザグループとリソースグループの両方を作り、それぞれ関連付ける必要があります。アクセス可能ユーザをページ単位で個別に設定することはできないため、ご注意ください。
</p>
<h3>ページの公開・非公開を正しくコントロールする</h3>
<p>
リソースごとの「公開ステータス」と「公開開始日時」「公開終了日時」の関係を正しく理解する必要があります。MODxは公開ステータスにチェックが入ってないと、そのページを公開しません。公開ステータスにチェックを入れるためには、公開開始日時が未来の日時になってないこと・公開終了日時が過去の日時になってないことが必要で、値が空でもかまいません。公開開始日時・公開終了日時の値が条件を満たしてなくても投稿画面上では公開ステータスをオンにすることができますが、リソースを更新保存すると<b>元の状態に戻りますのでご注意ください</b>。公開したつもり・非公開にしたつもりなのに、そのようになっていないという事故が起きる可能性があります。
</p>
<p>
確実・手軽に公開・非公開にしたい場合は、サイトツリー右クリックのコンテキストメニューを使ってください。コンテキストメニューを使うと、公開開始日時・公開終了日時の値をクリアしたうえで強制的に公開・非公開にします。
</p>

<h3>サイト内の文字列を大量に一括置換したい</h3>
<p>
<a href="http://www.google.com/cse?cx=007286147079563201032%3Aigbcdgg0jyo&ie=UTF-8&q=docfinder" target="_blank">Doc Finderモジュール</a>を利用するとよいでしょう。
</p>

<h3>ダッシュボードとヘルプのカスタマイズ</h3>
<p>
/assets/templates/manager/welcome.htmlを独自にカスタマイズできます。これは管理画面にログインした時に最初に表示される<a href="index.php?a=2">ダッシュボード</a>にあたるファイルです。このファイルはコア領域に属するものではないので、サイト運用の目的に応じて自由にカスタマイズできます。また、現在ご覧いただいているこの「ヘルプ」もカスタマイズ自由なエレメント領域に設置されています。つまり、個別の案件に応じたオンラインヘルプの同梱も簡単に実現できます。御社の電話番号・担当者名・サポート期間・その他保守条件などを記述しておくとよいでしょう。</p>

<h3>MODxの技術情報</h3>
<p>
<a href="http://wiki.modxcms.com/index.php/Ja:main" target="_blank">Ja:main - MODx Wiki</a><br />
MODx開発元のドキュメントサイトに日本語のコーナーを設けています。
</p>

</div>
