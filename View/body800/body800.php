<?php
$basket_list=isset($_SESSION['basket_list'])?$_SESSION['basket_list']:null;
if($id)
{
if($id == $basket_list[0]['user_id'])
{
?>
<table border="1" style="text-align: center;margin-left: 40px; margin-bottom: 20px">
    <h1 align="center">장바구니</h1>
    <tr><td>번호</td><td>이미지</td><td>상품명</td><td>갯수</td><td>가격</td><td>구매</td></tr>
    <?php for($iCount=0; $iCount<count($basket_list); $iCount++) { ?>
    <tr>
            <td width="100"><?= $basket_list[$iCount]['snum'] ?></td>
            <td><img src="../img/product_S/<?=$basket_list[$iCount]['psimage']?>"></td>
            <td width="150"><?= $basket_list[$iCount]['pname'] ?></td>
            <td width="150"><?= $basket_list[$iCount]['pstock'] ?></td>
            <td width="150"><?= $basket_list[$iCount]['pprice'] ?></td>
            <td width="150">
                <a href="../Ctl/MainCTL.php?action=802&snum=<?=$basket_list[$iCount]['snum']?>">바로구매</a>
            </td>
    </tr>
        <?php
    }?>

</table>
<?php }else{
    echo "목록이 비었습니다.";
} ?>
<?php }else{
    echo "로그인 후 이용가능 합니다.";
} ?>

