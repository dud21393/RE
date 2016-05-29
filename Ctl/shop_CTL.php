<?php
function shop_CTL($action){
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    include_once "../Mod/shopModel.php";
    switch($action)
    {
        case 700: //결제 창으로 이동 액션
            $pstock=isset($_REQUEST['pstock'])?$_REQUEST['pstock']:null;
            $pcode =isset($_REQUEST['pcode'])?$_REQUEST['pcode']:null;
            $result=buy_select($id,$pstock,$pcode);
            $_SESSION['buy_list']=$result;
            $action=701;
            header("location:../View/MainView.php?action=$action");
            break;
        case 702: //주문취소 액션
            $delete_buy['buynum']=isset($_REQUEST['buynum'])?$_REQUEST['buynum']:null;
            $delete_buy['pstock']=isset($_REQUEST['pstock'])?$_REQUEST['pstock']:null;
            $delete_buy['pcode']=isset($_REQUEST['pcode'])?$_REQUEST['pcode']:null;
            buy_delete($delete_buy);

            header("location:../Ctl/MainCTL.php?action=700");
            break;
        case 703: //결제액션
            $buy['buynum']=isset($_REQUEST['buynum'])?$_REQUEST['buynum']:null;
            $result=buy_view($buy);
            $_SESSION['buyView_list']=$result;
            header("location:../View/MainView.php?action=$action");

            break;
        case 704: //결제 완료 액션
            $buy_action['name']=isset($_REQUEST['name'])?$_REQUEST['name']:null;
            $buy_action['home']=isset($_REQUEST['home'])?$_REQUEST['home']:null;
            $buy_action['phone']=isset($_REQUEST['phone'])?$_REQUEST['phone']:null;
            $buy_action['money']=isset($_REQUEST['money'])?$_REQUEST['money']:null;
            $buyView_list=$_SESSION['buyView_list'];
            buy_success($buy_action,$buyView_list);

            header("location:../Ctl/MainCTL.php?action=700");
            break;
        case 705:
            $buynum=isset($_REQUEST['buynum'])?$_REQUEST['buynum']:null;
            buy_clear($buynum);
            header("location:../Ctl/MainCTL.php?action=700");
            break;
        case 800:
            $result=shop_select($id);
            $_SESSION['basket_list']=$result;
            header("location:../View/MainView.php?action=$action");
            break;
        case 801:
            $view_result=isset($_SESSION['view_result'])?$_SESSION['view_result']:null;
            $stock_count=isset($_REQUEST['number'])?$_REQUEST['number']:null;
            $user_id    =isset($_REQUEST['id'])?$_REQUEST['id']:null;
            insert_basket($view_result,$stock_count,$user_id);
            header("location:../View/MainView.php?action=1031");
            break;
        case 802:
            $snum=isset($_REQUEST['snum'])?$_REQUEST['snum']:null;
            $result=shop_select2($snum);
            buy_insert($result);
            header("location:../Ctl/MainCTL.php?action=700&pstock={$result['pstock']}&pcode={$result['pcode']}");
            break;
        case 803:
            $view_result=$_SESSION['view_result'];
            $id=$_SESSION['id'];
            $result=buy_insert2($view_result,$id);
            header("location:../Ctl/MainCTL.php?action=700&pstock={$result['pstock']}&pcode={$result['pcode']}");
            break;
    }
}

?>