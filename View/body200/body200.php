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



$productfImage_path="../img/product/";
$productsImage_path="../img/product_S/";
$productNoimage="../img/Noimg/";

$noimageFile="NOIMG_S.JPG";

echo "<table align='center' style='width: 1000px;'>";
if($productList) {
    foreach ($productList as $product) {
        $fImage = $productfImage_path . $product['pfimage'];
        $sImage = $productsImage_path . $product['psimage'];

        echo "<td style='padding-left: 30px; text-align: center'>";
        echo "<a href='../Ctl/MainCTL.php?action=1031&pnum={$product['pnum']}&return={$action['action']}'>";
        echo "<img src = '";
        if (!file_exists($sImage) || !$product['psimage']) { // 썸네일 이미지 파일이 존재 하지 않거나 null 이라면.
            if (!file_exists($sImage) || !$product['pfimage']) // 썸네일 이미지는 없지만 fimage는 존재 한다면.
                echo($productNoimage . $noimageFile);
            else {
                echo($fImage);
            }
        } else {                          // 썸네일 이미지 파일이 존재 하면.
            echo($sImage);
        }
        echo "' height='150' border='0'/></a><br/>";
        echo($product['pname']);
        echo "<br/>";
        echo($product['pstock']);
        echo "개<br/>";
        echo($product['pprice']);
        echo "원<br/>";
        echo "</td>";
    }
    echo "</tr>";
}else{
    echo "<tr><td width='200px'>상품이 없습니다.</td></tr>";
}

echo "</table>";
?>

<?php
if($productList) {
    include_once "./page.php";
    $master_action = $action['action'];
    Master_pagenation($productpageinfo, $master_action, $product_serch, $pageParaName);

}
