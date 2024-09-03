<?php

namespace MedicalDesign
{
	/**
	 * モデルの規定クラス
	 *
	 * @author JunSuzuki<jun_suzuki@medical-design.co.jp>
	 */
	class Helper
	{
		/**
		 * コンストラクタ
		 */
		public function __construct()
		{
		}

		public static function y2gengo($year)
		{
			$year = intval($year);
			$str = $gengo = $y ="";

			if ( 1869 <= $year && $year < 1912){
				$gengo = "明治";
				$y     = $year - 1869 + 1;
				if ($year == 1869){
					$str   = "元";
				}
			}
			else if ( 1912 <= $year && $year < 1926){
				$gengo = "大正";
				$y     = $year - 1912 + 1;
				if ($year == 1912){
					$str   = "元";
				}
			}
			else if ( 1926 <= $year && $year < 1989){
				$gengo = "昭和";
				$y     = $year - 1926 + 1;
				if ($year == 1926){
					$str   = "元";
				}
			}
			else if ( 1989 <= $year ){
				$gengo = "平成";
				$y     = $year - 1989 + 1;
				if ($year == 1989){
					$str   = "元";
				}
			}


			if (!$str){
				$str = sprintf('%s%s', $gengo , strval($y));
			}


			return array(
				'gengo' => $gengo,
				'str'   => $str,
				'year'  => $y,
			);
		}

		public static function getTermByOrder($term, $args = array())
		{
			$terms = get_terms($term, $args);

			if (! empty($terms)) {
				$result = array();
				foreach ($terms as $item) {
					$result[$item->term_order] = $item;
				}

				ksort($result);
				return $result;
			}

			return false;
		}

		public static function getUriParam($position)
		{
			$matches = preg_replace('/\?(.*)?$/i', '', $_SERVER['REQUEST_URI']);
			preg_match('/\/(.*)?\/(.*?)\.[a-z0-9]+$/i', $matches, $matches);
			$path = isset($matches[1]) ? explode('/', $matches[1]) : explode('/', $_SERVER['REQUEST_URI']);

			if (! empty($path)) {
				$cnt = 1;
				foreach ($path as $dir) {
					if (empty($dir)) continue;
					if ($cnt == $position) return $dir;
					$cnt++;
				}
			}

			return false;
		}

		/**
		 * 【】で分割して配列にまとめる、【】内はタイトルとする
		 *
		 * @access public
		 * @param string $str
		 * @return array
		 */
		public static function parseStr2Contents($str)
		{
			$result = array();
			$rows = $this->parseLine($str);

			if (! empty($rows)) {
				$title = '';
				$contents = '';

				foreach ($rows as $row) {
					if (preg_match('/^【(.*)?】$/', $row, $matches) && (isset($matches[1]) && ! empty($matches[1]))) {
						if (! empty($contents)) {
							$result[] = array('title' => $title, 'contents' => $contents);
							$title = '';
							$contents = '';
						}

						$title = $matches[1];
					} else {
						if (! empty($contents)) $contents .= "\n";
						$contents .= $row;
					}
				}

				if (! empty($contents)) {
					$result[] = array('title' => $title, 'contents' => $contents);
					$title = '';
					$contents = '';
				}
			}

			return $result;
		}

		/**
		 * 行毎に | で分割して配列にまとめる
		 *
		 * @access public
		 * @param string $str
		 * @return array
		 */
		public static function parseLinesByPipe($str)
		{
			$result = array();
			$rows = $this->parseLine($str);

			if (! empty($rows)) {
				foreach ($rows as $row) {
					$result[] = explode('|', $row);
				}
			}

			return $result;
		}

		/**
		 * | | で囲んだ文字列をthとして2列のテーブルに変換する
		 *
		 * @access public
		 * @param obj $post WPの投稿オブジェクト
		 * @return array
		 */
		public static function str2NumList($str)
		{
			$result = '';

			if (empty($str)) {
				$result = $str;
			} else {
				$rows = $this->parseLine($str);
				$tmp = '';

				if (! empty($rows)) {
					foreach ($rows as $row) {
						if (preg_match("/^\+/", $row)) {
							$tmp .= '<li>' . preg_replace("/^\+/", '', $row) . '</li>';
						} else {
							if (! empty($tmp)) {
								$result .= '<ol class="ol1">';
								$result .= $tmp . '</ol>' . "\n";
								$result .= $row;
								$tmp = '';
							} else {
								$result .= $row . "\n";
							}
						}
					}

					if (! empty($tmp)) {
						$result .= '<ol class="ol1">';
						$result .= $tmp . '</ol>' . "\n";
					}
				}
			}

			return $result;
		}

		public static function str2Bold($str)
		{
			if (preg_match("/\{(.*?)\}/is", $str, $matches)) {
				if (isset($matches[0]) && ! empty($matches[0])) {
					return str_replace($matches[0], '<strong>' . $matches[1] . '</strong>', $str);
				}
			}

			return $str;
		}

		public static function str2Link($str)
		{
			if (preg_match("/\/{2}(.*?)\((.*?)\)\/{2}/is", $str, $matches)) {
				if (isset($matches[0]) && ! empty($matches[0])) {
					return str_replace($matches[0], '<a href="' . $matches[2] . '" class="button button-small">' . $matches[1] . '</a>', $str);
				}
			}

			return $str;
		}

		public static function parseLine($str)
		{
			$str = str_replace(array("\r\n", "\r", "\n"), "\n", trim($str));
			$lines = explode("\n", $str);
			return $lines;
		}

		public static function truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false)
		{
			if ($length == 0) return '';

			if (mb_strlen($string, 'UTF-8') > $length) {
				$length -= min($length, mb_strlen($etc, 'UTF-8'));
				if (!$break_words && !$middle) {
					$string = preg_replace('/\s+?(\S+)?$/u', '', mb_substr($string, 0, $length + 1, 'UTF-8'));
				}
				if (!$middle) {
					return mb_substr($string, 0, $length, 'UTF-8') . $etc;
				}

				return mb_substr($string, 0, $length / 2, 'UTF-8') . $etc . mb_substr($string, - $length / 2, $length, 'UTF-8');
			}

			return $string;
		}


		// URL の ?year= で年を取得
		public static function getYearFromUrl()
		{
			$year = '';
			if(
					isset($_REQUEST['year'])
				&&	$_REQUEST['year']
				&&  is_numeric($_REQUEST['year'])
				&&  mb_strlen($_REQUEST['year']) === 4
			) {
				return $_REQUEST['year'];
			} else {
				return null;
			}
		}

		// URL の ?month= で年を取得
		public static function getMonthFromUrl()
		{
			$month = '';
			if(
					isset($_REQUEST['month'])
				&&	$_REQUEST['month']
				&&  is_numeric($_REQUEST['month'])
				&&  mb_strlen($_REQUEST['month']) <= 2
				&&  $_REQUEST['month'] >= 1
				&&  $_REQUEST['month'] <= 12
			) {
				return $_REQUEST['month'];
			} else {
				return null;
			}
		}

		// URL の ?$key= で数字を取得 (50ケタ)
		public static function getNumFromUrl($key)
		{
			$num = '';
			if(
					isset($_REQUEST[$key])
				&&	$_REQUEST[$key]
				&&  is_numeric($_REQUEST[$key])
				&&  mb_strlen($_REQUEST[$key]) <= 50
			) {
				return $_REQUEST[$key];
			} else {
				return null;
			}
		}

		// URL の ?$key= で文字を取得 (50ケタ + htmlentities)
		public static function getStrFromUrl($key)
		{
			$str = '';
			if(
					isset($_REQUEST[$key])
				&&	$_REQUEST[$key]
				&&  mb_strlen($_REQUEST[$key]) <= 50
			) {
				return strval(htmlentities($_REQUEST[$key], ENT_QUOTES, 'UTF-8'));
			} else {
				return null;
			}
		}

		public static function getSeparateData($content)
		{
			$result = array();
			if (! empty($content)) {
				$lines = explode("\n", $content);
				if (! empty($lines)) {
					foreach ($lines as $key => $line) {
						$item = explode(',', $line);
						// 右カラム分は書かれない場合もある
						if (isset($item[0]) && ! empty($item[0])) {
							$result[$key][0] = $item[0];
							$result[$key][1] = isset($item[1]) ? $item[1] : '';
						}
					}
				}
			}
			return $result;
		}

		public static function getSeparateTable($data)
		{
			$data_array = self::getSeparateData($data);
			$content = '';
			foreach ($data_array as $key => $value) {
				$content .= '<tr>' . "\n";
				$th_class = preg_match('/^【(.*)】/', $value[0]) ? ' h' : '';
				$content .= '	<th class="' . $th_class . '">' . $value[0] . '</th>' . "\n";
				if (! empty($value[1])) {
					$content .= '	<td>' . $value[1] . '</td>' . "\n";
				} else {
					$content .= '	<td></td>' . "\n";
				}
				$content .= '</tr>' . "\n";
			}
			return $content;
		}

		public static function getSeparateLine($data)
		{
			$data_array = self::getSeparateData($data);
			$content = '';
			foreach ($data_array as $key => $value) {
				$trim = trim($value[0]);
				if (! empty($value[0]) && ! empty($trim)) {
					$content .= '<li>' . $value[0] . '</li>';
				}
			}
			return $content;
		}

		/**
		 * 指定した曜日の日付ラベルを返却する
		 *
		 * @access public
		 * @param  int $week 0 = 日曜
		 * @return string
		 */
		public static function getWeekName($week, $prefix = '', $postfix = '')
		{
			switch($week) {
				case 0:
				case 7:
					$result = '日';
					break;

				case 1:
					$result = '月';
					break;

				case 2:
					$result = '火';
					break;

				case 3:
					$result = '水';
					break;

				case 4:
					$result = '木';
					break;

				case 5:
					$result = '金';
					break;

				case 6:
					$result = '土';
					break;

				default:
					$result = '';
			}

			return $prefix . $result . $postfix;
		}


		public static function getWeekSlug($week)
		{
			switch($week) {
				case 0:
				case 7:
					$result = 'sun';
					break;

				case 1:
					$result = 'mon';
					break;

				case 2:
					$result = 'tue';
					break;

				case 3:
					$result = 'wed';
					break;

				case 4:
					$result = 'thu';
					break;

				case 5:
					$result = 'fri';
					break;

				case 6:
					$result = 'sat';
					break;

				default:
					$result = '';
			}

			return $result;
		}

		public static function getPrefList()
		{
			return array(
				'北海道',
				'青森県',
				'岩手県',
				'宮城県',
				'秋田県',
				'山形県',
				'福島県',
				'茨城県',
				'栃木県',
				'群馬県',
				'埼玉県',
				'千葉県',
				'東京都',
				'神奈川県',
				'新潟県',
				'富山県',
				'石川県',
				'福井県',
				'山梨県',
				'長野県',
				'岐阜県',
				'静岡県',
				'愛知県',
				'三重県',
				'滋賀県',
				'京都府',
				'大阪府',
				'兵庫県',
				'奈良県',
				'和歌山県',
				'鳥取県',
				'島根県',
				'岡山県',
				'広島県',
				'山口県',
				'徳島県',
				'香川県',
				'愛媛県',
				'高知県',
				'福岡県',
				'佐賀県',
				'長崎県',
				'熊本県',
				'大分県',
				'宮崎県',
				'鹿児島県',
				'沖縄県',
			);
		}
	}

}
