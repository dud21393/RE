<?php
$buy_list=isset($_SESSION['buy_list'])?$_SESSION['buy_list']:null;
if($id)
{
    if($id == $buy_list[0]['user_id'])
    {
        ?>
        <table border="1" style="text-align: center;margin-left: 0px; margin-bottom: 20px;" >
            <h1 align="center">주문배송</h1>
            <tr><td>번호</td><td>이미지</td><td>상품명</td><td>갯수</td><td>가격</td><td>입금여부</td><td>주문취소</td></tr>
            <?php for($iCount=0; $iCount<count($buy_list); $iCount++) { ?>
                <tr>
                    <td width="100"><?= $buy_list[$iCount]['buynum'] ?></td>
                    <td><img src="../img/product_S/<?=$buy_list[$iCount]['psimage']?>"></td>
                    <td width="150"><?= $buy_list[$iCount]['pname'] ?></td>
                    <td width="150"><?= $buy_list[$iCount]['pstock'] ?></td>
                    <td width="150"><?= $buy_list[$iCount]['pprice'] ?></td>
                    <td width="150">
                        <?php if($buy_list[$iCount]['money'] != "on") {?>
                        <a href="../Ctl/MainCTL.php?action=703&buynum=<?=$buy_list[$iCount]['buynum']?>">입금대기</a>
                        <?php  }else{
                           echo $buy_list[$iCount]['delivery'];
                        }?>
                    </td>
                    <td width="150">
                        <?php if($buy_list[$iCount]['delivery'] != '배송완료'){?>
                        <a href="../Ctl/MainCTL.php?action=702&buynum=<?=$buy_list[$iCount]['buynum']?>&pstock=<?=$buy_list[$iCount]['pstock']?>&pcode=<?=$buy_list[$iCount]['pcode']?>">주문취소</a>
                        <?php }elseif($buy_list[$iCount]['buy'] == ''){
                            echo "<a href='../Ctl/MainCTL.php?action=705&buynum={$buy_list[$iCount]['buynum']}'>구매확정</a><br>";
                            echo "<a href='../Ctl/MainCTL.php?action=703'>환불하기</a>";
                        }elseif($buy_list[$iCount]['buy']=='구매완료') {
                            echo $buy_list[$iCount]['buy'];
                        }?>
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


