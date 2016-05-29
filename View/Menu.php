<?php

$Menu = array("상의","하의","모자","신발","장갑","게시판","주문배송","장바구니");
$Num = intval($action['action'] / 100) -1 ;
for($iCount=0; $iCount<count($Menu); $iCount++)
{
    $Menu_Num = ($iCount+1) * 100; //MainMenu Code create
        echo "<a href='../Ctl/MainCTL.php?action=$Menu_Num'>";
        echo "$Menu[$iCount]";
        echo "</a>";

}
?>