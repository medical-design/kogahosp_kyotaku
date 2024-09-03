<?php
/**
 * meta keywords / descroption 設定ファイル
 *
 * URL毎にキーワード、デスクリプション を設定する事が出来ます
 * 例）
 *   '/path/to/' => array(
 *       'description' => 'ページの説明です',
 *       'keywords' => 'キーワード,単語',
 *       'descriptionCommon' => false,  // この行を追加すると、個別設定の共通デスクリプションを無効にする(このファイルの設定内容だけを設定)
 *       'keywordsCommon' => false,  // この行を追加すると、個別設定の共通キーワードを無効にする(このファイルの設定内容だけを設定)
 *   ),
 *
 *   この場合は /path/to/ または /path/to/hoge.php などURLの先頭からマッチする場合に
 *   指定したキーワード、デスクリプションが meta タグに設定されます
 *
 *   キーワードだけを設定したい場合は 'description' => '', として値を空にするか
 *   または行ごと削除してください
 *
 *   指定したパスの最後が / で終わっている場合は / がある場合、なしの場合、
 *   /index.php の場合、 /index.html 場合のいずれかにマッチします
 *
 *   設定が無い場合は config.php で設定したデフォルト値が設定されます
 */

return $meta = array(
	// ホーム
	'/' => array(
		// 'keywords' => '',
		// 'description' => '',
		// 'keywordsCommon' => false,
		// 'descriptionCommon' => false,
	),
);
