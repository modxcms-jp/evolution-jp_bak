<?php
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.");
?>
<style type="text/css">
h3 {font-weight:bold;letter-spacing:2px;font-size:1;margin-top:10px;}
pre {border:1px dashed #ccc;background-color:#fcfcfc;padding:15px;}
ul {margin-bottom:15px;}
</style>

<div class="sectionHeader">テンプレート・リソース内で利用できる各種タグ</div>
<div class="sectionBody" style="padding:10px 20px;">
<h3>リソース変数</h3>

<p>リソース編集画面のほとんどの入力項目は、リソース変数という形でテンプレートから呼び出すことができます。つまりリソース変数は入力項目名でもあります。MODxをCMSとして利用するためには、リソース変数の記述は必須です。投稿された内容は、リソース変数の記述を通じてテンプレートデザインと紐付けられます。ここでは主なリソース変数のみ紹介します。</p>

<ul>
<li><strong>[*description*]</strong> リソースの説明文。metaタグのdescription属性として用いるとSEO対策として効果的です。</li>
<li><strong>[*id*]</strong> このリソースのID。</li>
<li><strong>[*introtext *]</strong> 要約文。意図が似ているdescriptionに比べ、入力フィールドに余裕があるためやや長文を投稿できます。改行も利用できます。</li>
<li><strong>[*pagetitle*]</strong> リソース名。ここで付けた名前が管理画面左側のサイトツリーで表示されるため、やや短めの名前がいいでしょう。</li>
<li><strong>[*longtitle *]</strong> リソースの別名。識別のためサイトツリーで用いられるpagetitleと比べると制限は緩めです。title要素や見出しタグとして用いるとSEO対策として効果的です。</li>
<li><strong>[*menutitle*]</strong> リソースの別名。利用できる文字数の制限があるナビゲーションなどに表示されることを想定しています。</li>
<li><strong>[*alias*]</strong> リソースの別名。通常、フレンドリーURL運用の際のパスの一部として用いられます。半角英数で指定します。</li>
<li><strong>[*content*]</strong> リソースの内容。本文。</li>
</ul>

<p>このうち特に重要なリソース変数は <strong>[*pagetitle*]</strong> と <strong>[*content*]</strong> のみです。通常のプレーンなサイトであれば、この2つを記述するだけで十分です。SEO対策や高度なナビゲーション表現にこだわる場合など、必要に応じて各種リソース変数を利用するといいでしょう。</p>

<h3>テンプレート変数</h3>
<p>テンプレート変数は、基本的にはリソース変数と同じ目的と働きを持ちます。MODxはリソース変数という形で既定の入力項目を持っていますが、サイトの目的に応じて入力項目を自由に追加することができます。これがテンプレート変数と呼ばれるものです。リソース直接ではなくテンプレートを介した紐づけであるためご注意ください。つまりテンプレートを変更するとリソースの性格も変わります。</p>

<p>テンプレート変数名には日本語を利用できるため、<strong>[*学校名*] [*担任の名前*] [*この薬の特長*] [*生年月日*] [*仕入れ価格*] [*男性か女性か*]</strong> などといった分かりやすい記述が可能です。</p>

<h3>セッティング変数</h3>

<p>※従来、セッティングタグ・設定タグなどと呼ばれていましたが、もともと明確な呼称はありません。ここでは参照元を明確にするため<b>セッティング変数</b>と呼ぶことにします。</p>
<p>セッティング変数は、管理画面のグローバル設定の値を呼び出すことができるタグです。リソース変数とテンプレート変数がリソースに関連付けられたデータを呼び出すものであるのに対して、セッティング変数では「サイト名」「サイト管理者のメールアドレス」など、サイト全体の設定に関する値をテンプレート中またはリソース中に呼び出すことができます。</p>

<p>グローバル設定内のほとんどの項目の値を呼び出すことができますが、ここでは主なもののみ紹介します。<p>
<ul>
<li><strong>[(emailsender)]</strong> このサイトの管理者のメールアドレス</li>
<li><strong>[(modx_charset)]</strong> このサイトで利用されているエンコード。利用エンコードを特定できない配布テンプレートを作る場合など、head要素内のcharset属性で用いるといいでしょう。</li>
<li><strong>[(site_name)]</strong> サイト名。多数のテンプレートを用いるサイトを運用している場合など、グローバル設定の変更ひとつで全てのサイト名出力を一括コントロールできるため便利です。</li>
<li><strong>[(site_url)]</strong> このサイトのURL。</li>
<li><strong>[(rb_base_dir)]</strong> ファイルブラウザのベースディレクトリパス。imgタグなどに利用するといいでしょう。サイトのディレクトリ構成を変更する可能性がある場合、このタグを組み合わせて記述しておくと便利です。</li>
<li><strong>[(rb_base_url)]</strong> ファイルブラウザのベースURL。imgタグなどに利用するといいでしょう。サイトのディレクトリ構成を変更する可能性がある場合、このタグを組み合わせて記述しておくと便利です。</li>
<li><strong>[(site_unavailable_message)]</strong> サイトを閉鎖設定にしている時に出力するメッセージ。サイト新規作成時などに利用すると便利です。閉鎖設定時に出力するリソースをあらかじめ用意し、そこに記述する必要があります。</li>
</ul>

<h3>チャンクコール</h3>
<p>
<strong>{{チャンク名}}</strong>
</p>
<p>
チャンクを呼び出して出力します。チャンク名は日本語が使えるため、<strong>{{ナビゲーションバー}} {{特売バナー}} {{問い合わせフォーム}}</strong> などと記述できます。
</p>

<h3>スニペットコール</h3>
<p>
<strong>[[スニペット名]]</strong> または <strong>[!スニペット名!]</strong>(キャッシュ制御なし)
</p>
<p>
スニペットを呼び出します。スニペット名は日本語が使えるため、<strong>[!現在時刻!]</strong> などと記述できます。また、スニペット名の直後を「 ? 」で区切り、スニペットに渡すパラメータを記述できます。</p>

<h3>リソースリンク</h3>
<p>
<strong>[~id~]</strong> 例：[~18~] [~51~]など。idはリソースIDです。
</p>
<p>
任意のリソースのパスを出力するもので、主にaタグなどに利用します。フレンドリーURLの設定を反映します。該当ページの固定パスを直接記述する場合と違い、サイト内の階層構造を組み換えても動的に判断しパスを正しく出力するため安心です。セッティング変数などと組み合わせて
</p>
<pre>
&lt;a href=&quot;[(base_url)][~18~]&quot;&gt;
&lt;a href=&quot;[(site_url)][~55~]&quot;&gt;
&lt;a href=&quot;/[~55~]&quot;&gt;
</pre>
<p>
と記述すると確実です。
</p>

<h3>ベンチマークタグ</h3>
<p>
サイトのパフォーマンスチューニングに利用すると便利です。</p>
<ul>
<li><strong>[^qt^]</strong> データベースに対するクエリーのやりとりに要した時間の合計秒数</li>
<li><strong>[^q^]</strong> クエリー発行回数</li>
<li><strong>[^p^]</strong> ページのパースにかかった秒数(PHP展開部分)</li>
<li><strong>[^t^]</strong> クエリー所要時間とPHP実行時間の合計秒数 ([^qt^] ＋ [^p^])</li>
<li><strong>[^s^]</strong> このページがキャッシュ出力されているかどうか</li>
</ul>

</div>
