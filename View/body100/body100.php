<?php

$sub_Menu = array(
    array("티셔츠","반팔","긴팔","니트"),
    array("바지","5부바지","팬츠","스키니"),
    array("모자","비니","캡"),
    array("신발","나이키","아디다스"),
    array("장갑","털장갑","가죽장갑","반장갑")
);


$action_Main=floor($action['action']/100) -1 ;
$action_Sub=floor($action['action']/10)%10-1;

$pageParaName="ppageNum".$action['action'];
$pageinfoName="productPageinfo".$action['action'];

$productList=isset($_SESSION['product_List']) ? $_SESSION['product_List'] : null;
$productpageinfo=isset($_SESSION[$pageinfoName]) ? $_SESSION[$pageinfoName] : null;

$product_serch['serch']=isset($_REQUEST['product_serch']) ?$_REQUEST['product_serch'] : null;
$product_serch['all']=isset($_REQUEST['product_all']) ?$_REQUEST['product_all'] : null;


?>
<table border="1" align="center">
    <tr><td>순번</td><td>카테고리</td><td>코드</td><td>상품명</td><td>재고량</td><td>가격</td><td>이미지명</td><td>썸네일명</td></tr>
<?php
if($productList) {
    for ($iCount = 0; $iCount < count($productList); $iCount++) {
        echo "<tr>";
        for ($jCount = 0; $jCount < 8; $jCount++) {
            echo "<td>" . $productList[$iCount][$jCount] . "</td>";
        }
        echo "</tr>";
    }
}
else
{
    echo "<tr><td colspan='8' align='center'>상품이 없습니다.</td></tr>";
}
?>
</table>

<?php
if($productList) {
    include_once "./page.php";
    $master_action = $action['action'];
    Master_pagenation($productpageinfo, $master_action, $product_serch, $pageParaName);

}
?>