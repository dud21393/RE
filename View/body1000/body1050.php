<?php
$admin_buy=isset($_SESSION['admin_buy'])?$_SESSION['admin_buy']:null;
$pageinfo =isset($_SESSION['pageinfo'])?$_SESSION['pageinfo']:null;
$product_serch['serch'] = isset($_REQUEST['serch']) ? $_REQUEST['serch'] : null;
$product_serch['all'] = isset($_REQUEST['all']) ? $_REQUEST['all'] : null;
$pageNumParaName="";
if($admin_buy)
{?>
    <h1 align="center">구매신청여부</h1>
    <table border="1" align="center" style="text-align: center; margin-bottom: 30px">
        <tr>
            <td>상품이미지</td><td>번호</td><td>상품이름</td><td>카테고리</td><td>상품코드</td><td>주문수량</td><td>주문금액</td><td>유저아이디</td><td>입금여부</td>
        </tr>
        <?php for($iCount=0; $iCount<count($admin_buy); $iCount++){ ?>
        <tr>
            <td><img src="../img/product_S/<?=$admin_buy[$iCount]['psimage']?>" style="width: 200px; height: 100px"></td>
            <td><?=$admin_buy[$iCount]['buynum']?></td>
            <td><?=$admin_buy[$iCount]['pname']?></td>
            <td><?=$admin_buy[$iCount]['pcategory']?></td>
            <td><?=$admin_buy[$iCount]['pcode']?></td>
            <td><?=$admin_buy[$iCount]['pstock']?></td>
            <td><?=$admin_buy[$iCount]['pprice']?></td>
            <td><?=$admin_buy[$iCount]['user_id']?></td>
            <td><?=$admin_buy[$iCount]['money']?></td>
        </tr>
        <?php } ?>
    </table>
<?php
}else{
    echo "목록이 비어있습니다.";
}
?>

<?php

include_once "./page.php";
$action=$action['action'];
Master_pagenation($pageinfo,$action,$product_serch,$pageNumParaName);

?>

