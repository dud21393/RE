<?php
$admin_list=isset($_SESSION['admin_list'])?$_SESSION['admin_list']:null;
if($admin_list) {
    ?>
    <table border="1" align="center" style="text-align: center">
        <tr>
            <td>번호</td>
            <td>상품이미지</td>
            <td>상품이름</td>
            <td>카테고리</td>
            <td>상품코드</td>
            <td>유저아이디</td>
            <td>받는사람</td>
            <td>주소지</td>
            <td>휴대폰번호</td>
            <td>입금여부</td>
            <td>구매번호</td>
            <td>배송여부</td>
        </tr>
        <?php for($iCount=0; $iCount<count($admin_list); $iCount++){ ?>
        <tr>
            <td><?=$admin_list[$iCount]['anum']?></td>
            <td><img src="../img/product_S/<?=$admin_list[$iCount]['psimage']?>" style="width: 200px; height: 100px"></td>
            <td><?=$admin_list[$iCount]['pname']?></td>
            <td><?=$admin_list[$iCount]['pcategory']?></td>
            <td><?=$admin_list[$iCount]['pcode']?></td>
            <td><?=$admin_list[$iCount]['user_id']?></td>
            <td><?=$admin_list[$iCount]['user_name']?></td>
            <td><?=$admin_list[$iCount]['home']?></td>
            <td><?=$admin_list[$iCount]['phone']?></td>
            <td><?=$admin_list[$iCount]['money']?></td>
            <td><?=$admin_list[$iCount]['buynum']?></td>
            <td>
                <?php if($admin_list[$iCount]['delivery'] == 'no') { ?>
                <a href="../Ctl/MainCTL.php?action=1061&anum=<?=$admin_list[$iCount]['anum']?>&buynum=<?=$admin_list[$iCount]['buynum']?>"><?=$admin_list[$iCount]['delivery']?></a>
                <?php }elseif($admin_list[$iCount]['delivery'] == '배송중'){ ?>
                   <a href="../Ctl/MainCTL.php?action=1062&anum=<?=$admin_list[$iCount]['anum']?>&buynum=<?=$admin_list[$iCount]['buynum']?>"><?=$admin_list[$iCount]['delivery']?></a>
               <?php  }elseif($admin_list[$iCount]['delivery'] == '배송완료'){ ?>
                    <?=$admin_list[$iCount]['delivery']?>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php
}else{
    echo "목록이 비어있습니다.";
}
?>

