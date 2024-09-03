<?php
/**
 * モデルの規定クラス
 * 
 * @author JunSuzuki<jun_suzuki@medical-design.co.jp>
 */
class Model_Base
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }
    
    protected function y2gengo($year)
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
    
    public function getTermByOrder($term)
    {
        $terms = get_terms($term);
        
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
    
    public function getUriParam($position)
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
     * 【 】で囲んだ文字列をthとして2列のテーブルに変換する
     * 
     * @access private
     * @param obj $post WPの投稿オブジェクト
     * @return array
     */
    public function setAdditonalFields($str, $headStart = '<th>', $headEnd = '</th>', $dataStart = '<td>', $dataEnd = '</td>')
    {
        if (empty($str)) {
            return $str;
        }
        
        $result = array();
        $lastKey = '';
        $lastVal = '';
        $rows = 1;
        $cols = 1;
        
        $rows = explode("\n", $str);
        if (! empty($rows)) {
            foreach ($rows as $row) {
                if (preg_match('/^【(.*)?】(.*)?$/', $row, $matches) && isset($matches[1]) && isset($matches[2])) {
                    if (! isset($result[$matches[1]])) {
                        $result[$matches[1]] = $matches[2];
                    } else {
                        $result[$matches[1]] .= $matches[2];
                    }
                    
                    $lastKey = $matches[1];
                    $lastVal = $matches[2];
                } else {
                    if (isset($result[$lastKey])) {
                        if (! empty($result[$lastKey])) $result[$lastKey] .= "<br>\n";
                        $result[$lastKey] .= $row;
                    } else {
                        if (! empty($lastVal)) $lastVal .= "<br>\n";
                        $lastVal .= $row;
                    }
                }
            }
            
            if (empty($result) && ! empty($lastVal)) {
                $result = '<td>' . $lastVal . '</td>';
                $cols = 2;
            } else {
                $rows = count($result);
                $this->_cols = 2;
                
                if (! empty($result)) {
                    $tmp = '';
                    foreach ($result as $key => $value) {
                        if (! empty($tmp)) $tmp .= '<tr>';
                        $tmp .= '<th colspan="' . $this->_cols . '">' . $key . '</th><td>' . $value . '</td></tr>';
                    }
                    
                    $result = $tmp;
                } else {
                    $result = $str;
                }
            }
            
        } else {
            $result = '<td>' . $str . '</td>';
            $cols = 2;
        }
        
        return array('rows' => $rows, 'cols' => $cols, 'data' => $result);
    }
    
    /**
     * | | で囲んだ文字列をthとして2列のテーブルに変換する
     * 
     * @access private
     * @param obj $post WPの投稿オブジェクト
     * @return array
     */
    public function str2table($str)
    {
        $result = '';
        
        preg_match("/\|(.*)?\|/is", $str, $matches);
        
        if (! isset($matches[1]) || empty($matches[1])) {
            $result = $str;
        } else {
            $parsed = array();
            
            $rows = $this->parseLine($matches[1]);
            if (! empty($rows)) {
                foreach ($rows as $row) {
                    if (! empty($row)) {
                        $cols = explode('|', preg_replace("/\|$/", '', preg_replace("/^\|/", '', trim($row))));
                        if (! empty($cols)) {
                            $parsed[] = $cols;
                        }
                    }
                }
            }
            
            if (! empty($parsed)) {
                krsort($parsed);
                $tmp = array();
                $rowspan = array();
                $rowspanValue = array();
                
                foreach ($parsed as $key => $value) {
                    
                    foreach ($value as $k => $v) {
                        if (! isset($rowspan[$k])) $rowspan[$k] = 0;
                        if ($v == "^") {
                            $rowspan[$k] = empty($rowspan[$k]) ? 2 : ($rowspan[$k] + 1);
                        } else {
                            if (isset($rowspan[$k]) && ! empty($rowspan[$k])) {
                                if ($k <= 0) {
                                    $tmp[$key][$k] = '<th rowspan="' . $rowspan[$k] . '">' . $v . '</th>';
                                    $rowspan[$k] = 0;
                                } else {
                                    $tmp[$key][$k] = '<td rowspan="' . $rowspan[$k] . '">' . $v . '</td>';
                                    $rowspan[$k] = 0;
                                }
                            } else {
                                if ($k <= 0) {
                                    $tmp[$key][$k] = '<th>' . $v . '</th>';
                                } else {
                                    $tmp[$key][$k] = '<td>' . $v . '</td>';
                                }
                            }
                        }
                    }
                }
                
                if (! empty($tmp)) {
                    ksort($tmp);
                    foreach ($tmp as $key => $row) {
                        $result .= "<tr>";
                        foreach ($row as $col) {
                            $result .= $col;
                        }
                        $result .= "</tr>";
                    }
                }
            }
            
            $result = '<table class="table table-column2 table-small3"><tbody>' . $result . '</tbody></table>';
            $result = preg_replace("/\|(.*)?\|/is", $result, $str);
        }
        
        return $result;
    }
    
    /**
     * | | で囲んだ文字列をthとして2列のテーブルに変換する
     * 
     * @access private
     * @param obj $post WPの投稿オブジェクト
     * @return array
     */
    public function str2List($str)
    {
        $result = '';
        
        if (empty($str)) {
            $result = $str;
        } else {
            $rows = $this->parseLine($str);
            $tmp = '';
            
            if (! empty($rows)) {
                foreach ($rows as $row) {
                    if (preg_match("/^\-/", $row)) {
                        $tmp .= '<li>' . preg_replace("/^\-/", '', $row) . '</li>';
                    } else {
                        if (! empty($tmp)) {
                            $result .= '<ul class="ul1">';
                            $result .= $tmp . '</ul>' . "\n";
                            $result .= $row;
                            $tmp = '';
                        } else {
                            $result .= $row . "\n";
                        }
                    }
                }
                
                if (! empty($tmp)) {
                    $result .= '<ul class="ul1">';
                    $result .= $tmp . '</ul>' . "\n";
                }
            }
        }
        
        return $result;
    }
    
    /**
     * 行毎に 【】 で囲んだ文字列をキーとして配列にまとめる
     * 
     * @access private
     * @param obj $post WPの投稿オブジェクト
     * @return array
     */
    public function parseByPipe($str)
    {
        if (empty($str)) {
            $result = $str;
        } else {
            $rows = $this->parseLine($str);
            $result = array();
            $lastKey = '';
            
            foreach ($rows as $line) {
                preg_match("/^【(.*?)】(.*)?/", $line, $parsed);
                if (count($parsed) > 1) {
                    foreach ($parsed as $key => $cell) {
                        if ($key == 1) {
                            $result[$cell] = array();
                            $lastKey = $cell;
                        } elseif ($key > 1) {
                            $result[$lastKey][] = $cell;
                        }
                    }
                } else {
                    if (! empty($lastKey) && isset($result[$lastKey])) {
                        $result[$lastKey][] = $line;
                    } else {
                        $result[$line] = array();
                    }
                }
            }
        }
        
        return $result;
    }
    
    /**
     * | | で囲んだ文字列をthとして2列のテーブルに変換する
     * 
     * @access private
     * @param obj $post WPの投稿オブジェクト
     * @return array
     */
    public function str2NumList($str)
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
    
    public function str2Bold($str)
    {
        if (preg_match("/\{(.*?)\}/is", $str, $matches)) {
            if (isset($matches[0]) && ! empty($matches[0])) {
                return str_replace($matches[0], '<strong>' . $matches[1] . '</strong>', $str);
            }
        }
        
        return $str;
    }
    
    public function str2Link($str)
    {
        if (preg_match("/\/{2}(.*?)\((.*?)\)\/{2}/is", $str, $matches)) {
            if (isset($matches[0]) && ! empty($matches[0])) {
                return str_replace($matches[0], '<a href="' . $matches[2] . '" class="button button-small">' . $matches[1] . '</a>', $str);
            }
        }
        
        return $str;
    }
    
    public function convertValues($str)
    {
          $str = $this->str2table($str);
          $str = $this->str2List($str);
          $str = $this->str2NumList($str);
          $str = $this->str2Bold($str);
          $str = $this->str2Link($str);
          $str = str_replace('※', '<span class="red_text">※</span>', $str);
          
          return nl2br($str);
    }
    
    public function parseLine($str)
    {
        $str = str_replace(array("\r\n", "\r", "\n"), "\n", trim($str));
        $lines = explode("\n", $str);
        return $lines;
    }
    
    public function truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false)
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
}
?>
