<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>

<!-- 상품진열 10 시작 { -->
<?php
for ($i=1; $row=sql_fetch_array($result); $i++) {
    if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$this->list_mod == 0) $syt_last = ' syt_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $syt_last = ' syt_clear'; // 줄 첫번째
        else $syt_last = '';
    } else { // 1줄 이미지 : 1개
        $syt_last = ' syt_clear';
    }

    if ($i == 1) {
        echo "<ul class=\"syt syt_10\">\n";
    }

    echo "<li class=\"center-align syt_li{$syt_last}\" style=\"width:{$this->img_width}px\">\n";

    if ($this->href) {
        echo "<div class=\"syt_img\"><a href=\"{$this->href}{$row['it_id']}\" class=\"syt_a\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_icon) {
        echo "<div class=\"syt_icon\">".item_icon($row)."</div>\n";
    }

    if ($this->href) {
        echo "<div class=\"syt_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"syt_a\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_cust_price || $this->view_it_price) {

        echo "<div class=\"syt_cost\">\n";

        echo "<strike>".display_price($row['it_cust_price'])."</strike>\n";


        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

        echo "</div>\n";

    }

    echo "</li>\n";
}

if ($i > 1) echo "</ul>\n";

if($i == 1) echo "<p class=\"syt_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->