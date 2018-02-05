<?php

class PageNav {

    protected $model;
    protected $pages_count;
    protected $linksPages;

    function __construct() {
        $this->model = new SiteModel();
    }

    function createLinksPages($table, $class = '', $show_link = 10) {
        unset($_GET['page']);
        $parsUrl = parse_url('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

        if($parsUrl[query] !=''){
            $parsUrlArr = explode('&', $parsUrl[query]);            
            preg_match_all("|page=[0-9]*|", $parsUrl[query],  $outArr);
            if ($key = array_search($outArr[0][0], $parsUrlArr)) {
              unset($parsUrlArr[$key]);
            }
            $parsUriStr = implode('&', $parsUrlArr);
            $pageGet = '?'.$parsUriStr.'&page=';
        }else{
           $pageGet = '?page=';
        }

        if ($this->pages_count == 1) {
            return false;
        }
        $begin = $page - intval($show_link / 2);
        unset($show_dots);
        if ($this->pages_count <= $show_link + 1) {
            $show_dots = 'no';
        }
        $this->linksPages .= '<ul class="pagination '.$class.'">';
        if (($begin > 2) && !isset($show_dots) && ($this->pages_count - $show_link > 2)) {
            $this->linksPages .=  '<li><a ' . $style . ' href=' . $_SERVER['php_self'] . ''.$pageGet.'1> |< </a></li> ';
        }

        for ($j = 0; $j < $page; $j++) {
            if (($begin + $show_link - $j > $this->pages_count) && ($this->pages_count - $show_link + $j > 0)) {
                $page_link = $this->pages_count - $show_link + $j;
                if (!isset($show_dots) && ($this->pages_count - $show_link > 1)) {
                    $this->linksPages .= ' <li><a  href=' . $_SERVER['php_self'] . ''.$pageGet.'' . ($page_link - 1) . '><b>...</b></a></li> ';
                    $show_dots = "no";
                }
                $this->linksPages .= ' <li><a  href=' . $_SERVER['php_self'] . ''.$pageGet.'' . $page_link . '>' . $page_link . '</a></li> ';
            } else {
                continue;
            }
        }
        for ($j = 0; $j <= $show_link; $j++) {
            $i = $begin + $j;
            if ($i < 1) {
                $show_link++;
                continue;
            }
            if (!isset($show_dots) && $begin > 1) {
                $this->linksPages .=' <li><a  href=' . $_SERVER['php_self'] . ''.$pageGet.'' . ($i - 1) . '><b>...</b></a></li> ';
                $show_dots = "no";
            }

            if ($i > $this->pages_count) {
                break;
            }
            if ($i == $page) {
                $this->linksPages .= ' <li><a  ><b>' . $i . '</b></a> ';
            } else {
                $this->linksPages .= ' <li><a  href=' . $_SERVER['php_self'] . ''.$pageGet.'' . $i . '>' . $i . '</a></li> ';
            }
            if (($i != $this->pages_count) && ($j != $show_link)) {
                if (($j == $show_link) && ($i < $this->pages_count)) {
                    $this->linksPages .= ' <li><a  href=' . $_SERVER['php_self'] . ''.$pageGet.'' . ($i + 1) . '><b>...</b></a></li> ';
                }
            }
        }
        if ($begin + $show_link + 1 < $this->pages_count) {
            $this->linksPages .= ' <li><a  href=' . $_SERVER['php_self'] . ''.$pageGet.'' . $this->pages_count . '> >| </a></li>';
        }
        $this->linksPages .= '</ul">';
        return true;
    }

    function pagesLinks($perpage, $table, $page) {
        $count = $this->model->select('SELECT * FROM ' . $table . '');
        $count = count($count);
        $countRow = ceil($count / $perpage);
        if (empty($page) || ($page <= 0)) {
            $page = 1;
        } else {
            $page = (int) $page; 
        }
        if ($page > $countRow) {
            $page = $countRow;
        }

        $start_pos = ($page - 1) * $perpage;
        $this->pages_count = $countRow;
        return $start_pos;
    }
    
    function showLinksPages(){
        return $this->linksPages;
    }

}
