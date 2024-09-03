<?php

namespace MedicalDesign
{
	require_once dirname(__FILE__) . '/Helper.php';

	/**
	 * モデルの規定クラス
	 *
	 * @author hiroyuki_watanabe<hiroyuki_watanabe@medical-design.co.jp>
	 */
	class Pager
	{
		/**
		 * コンストラクタ
		 */
		public function __construct($rows = 10, $current = NAN)
		{
			$this->_setRows($rows);
			if (is_nan($current) === true) {
				$page = Helper::getNumFromUrl('pager');
				$page = $page ? $page : 1;
				$this->_setPageCurrent($page);
			} else if (is_numeric($current)) {
				$this->_setPageCurrent((int) $current);
			}
		}

		// 検索結果の総件数
		public $resultCnt = 0;

		// 1ページあたりの表示件数
		public $rows = 10;

		// ページネーションのページ表示件数
		public $pages = 5;

		// ページネーションの開始ページ番号
		public $pageStart = 1;

		// ページネーションの最終ページ番号
		public $pageEnd = 1;

		// ページネーションの開始ページ数、終了ページ数を作成
		public $pageMax = 0;

		public $pageCurrent = 0;

		// int 次へ の page
		public $pageNext = 0;

		// int 前へ の page
		public $pagePrev = 0;

		// 次へを表示すべきかどうか
		public $isExistNext = false;

		// 前へを表示すべきかどうか
		public $isExistPrev = false;

		// 検索結果があるかどうか?
		public $isResultEmpty = true;

		// int 1〜10 件表示しています、の始まりの数字
		public $itemStart = 0;

		// int 1〜10 件表示しています、の終わりの数字
		public $itemEnd = 0;

		public $isShowPreStart = false;

		public $isShowPreEnd = false;


		protected function _setRows($rows)
		{
			$this->rows = (int) $rows;
		}

		protected function _setPageCurrent($cnt)
		{
			$this->pageCurrent = (int) $cnt;
		}

		protected function _setResultCnt($cnt)
		{
			$this->resultCnt = (int) $cnt;
			$this->_setIsResultEmpty(! (bool) $cnt);
		}

		protected function _setIsResultEmpty($value)
		{
			$this->isResultEmpty = (bool) $value;
		}

		protected function _setPager()
		{
			// ページネーションの開始ページ数、終了ページ数を作成
			$this->pageMax = (int) ceil($this->resultCnt / $this->rows);

			if ($this->pageCurrent === 1) {
				$this->pageStart = 1;
				if ($this->pageStart + $this->pages - 1  >= $this->pageMax) {
					$this->pageEnd = (int) $this->pageMax;
				} else {
					$this->pageEnd = (int) $this->pages;
				}
			} else if ($this->pageCurrent === $this->pageMax) {
				$this->pageEnd = $this->pageMax;
				if ($this->pageEnd - $this->pages >= 1) {
					$this->pageStart = (int) $this->pageEnd - $this->pages + 1;
				} else {
					$this->pageStart = 1;
				}
			} else {
				$this->pageStart = ($this->pageCurrent - floor($this->pages / 2) > 0) ? (int) ($this->pageCurrent - floor($this->pages / 2)) : (int) 1;

				if ($this->pageStart + $this->pages - 1  <= $this->pageMax) {
					$this->pageEnd = (int) $this->pageStart + $this->pages - 1;
				} else {
					$this->pageEnd = (int) $this->pageMax;
				}

				if ($this->pageEnd - $this->pages >= 1) {
					$this->pageStart = (int) $this->pageEnd - $this->pages + 1;
				} else {
					$this->pageStart = 1;
				}
			}


			if ((int) $this->pageStart !== 1) {
				$this->isShowPreStart = true;
			}

			if ((int) $this->pageEnd !== $this->pageMax) {
				$this->isShowPreEnd = true;
			}


			$this->isExistNext = ($this->pageCurrent < $this->pageMax) ? true : false;
			$this->pageNext = $this->isExistNext ? $this->pageCurrent + 1 : 0;

			$this->isExistPrev = ($this->pageCurrent > 1) ? true : false;
			$this->pagePrev = $this->isExistPrev ? $this->pageCurrent - 1 : 0;

			$this->itemStart = (($this->pageCurrent-1) * $this->rows) + 1;
			// $this->itemEnd  = ($this->isResultEmpty) ? 0 :
			// 	($this->isExistNext) ? $this->itemStart + $this->rows - 1 : $this->resultCnt;
		}

		public function getList($list)
		{
			if (! empty($list)) {
				$this->_setResultCnt(count($list));

				$start = isset($this->pageCurrent) ? ($this->pageCurrent - 1) * $this->rows : 0;
				$end   = $start + $this->rows - 1;

				$ret = array();
				$num = 0;

				foreach ($list as $value) {
					if ($num >= $start && $num <= $end) {
						$ret[] = $value;
					} elseif ($end < $num) {
						$end -= 1;
						break;
					}
					$num++;
				}
				$this->_setPager();
				return $ret;
			} else {
				return false;
			}
		}
	}
}

