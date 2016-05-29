<?php
function insert_basket($view_result,$stock_count,$id)
{
    $db_conn=db_connection();
    $pprice=$stock_count*$view_result['pprice'];
    $sql="insert into shoppingbasket(pname,pcategory,pcode,pstock,pprice,psimage,user_id)
          values('{$view_result['pname']}','{$view_result['pcategory']}','{$view_result['pcode']}','$stock_count',$pprice,'{$view_result['psimage']}','$id')";
    $query = mysqli_query($db_conn,$sql);
    mysqli_close($db_conn);
    return $query;
}
function shop_select($id)
{
    $db_conn=db_connection();
    $sql="select * from shoppingbasket where user_id='$id'";
    $query=mysqli_query($db_conn,$sql);
    $iCount=0;
    while($rows=mysqli_fetch_array($query))
    {
        $result[$iCount]=$rows;
        $iCount++;
    }
    mysqli_close($db_conn);
    return $result;
}
function shop_select2($snum)
{
    $db_conn=db_connection();
    $sql="select * from shoppingbasket where snum='$snum'";
    $query=mysqli_query($db_conn,$sql);
    $rows=mysqli_fetch_array($query,MYSQLI_ASSOC);
    $sql2="delete from shoppingbasket where snum=$snum";
    mysqli_query($db_conn,$sql2);
    mysqli_close($db_conn);
    return $rows;
}
function buy_insert($result)
{
    $db_conn=db_connection();
    $sql="insert into buy(pname,pcategory,pcode,pstock,pprice,psimage,user_id)
          VALUES('{$result['pname']}','{$result['pcategory']}','{$result['pcode']}','{$result['pstock']}','{$result['pprice']}','{$result['psimage']}','{$result['user_id']}')";
    $query=mysqli_query($db_conn,$sql);
    mysqli_close($db_conn);
    return $query;
}
function buy_insert2($view_result,$id)
{
    $db_conn=db_connection();
    $sql="insert into buy(pname,pcategory,pcode,pstock,pprice,psimage,user_id)
          VALUES('{$view_result['pname']}','{$view_result['pcategory']}','{$view_result['pcode']}','{$view_result['pstock']}','{$view_result['pprice']}','{$view_result['psimage']}','{$id}')";
    $query=mysqli_query($db_conn,$sql);
    mysqli_close($db_conn);
    return $query;
}
function buy_select($id,$pstock,$pcode)
{
    $db_conn=db_connection();
    $sql="select * from buy where user_id='$id'";
    $query=mysqli_query($db_conn,$sql);
    $sql2="update product set pstock=pstock-$pstock where pcode='$pcode'";
    mysqli_query($db_conn,$sql2);
    $iCount=0;
    while($rows=mysqli_fetch_array($query))
    {
        $result[$iCount]=$rows;
        $iCount++;
    }
    mysqli_close($db_conn);
    return $result;
}
function buy_delete($delete_buy)
{
    $db_conn=db_connection();
    $sql="delete from buy where buynum={$delete_buy['buynum']}";
    $query=mysqli_query($db_conn,$sql);
    $sql2="update product set pstock=pstock+{$delete_buy['pstock']} where pcode='{$delete_buy['pcode']}'";
    mysqli_query($db_conn,$sql2);
    mysqli_close($db_conn);
    return $query;
}
function buy_view($buy)
{
    $db_conn=db_connection();
    $sql="select * from buy where buynum={$buy['buynum']}";
    $query=mysqli_query($db_conn,$sql);
    $rows=mysqli_fetch_array($query);
    mysqli_close($db_conn);
    return $rows;
}
function buy_success($buy_action,$buyView_list)
{
    $db_conn=db_connection();
    $sql="insert into admin(pname,pcategory,pcode,pprice,psimage,user_id,user_name,home,phone,money,buynum)
          VALUES ('{$buyView_list['pname']}','{$buyView_list['pcategory']}','{$buyView_list['pcode']}','{$buyView_list['pprice']}','{$buyView_list['psimage']}',
                   '{$buyView_list['user_id']}','{$buy_action['name']}','{$buy_action['home']}','{$buy_action['phone']}','{$buy_action['money']}','{$buyView_list['buynum']}')";
    $query=mysqli_query($db_conn,$sql);
    $sql2="update buy set money='{$buy_action['money']}' where buynum={$buyView_list['buynum']}";
    mysqli_query($db_conn,$sql2);
    $sql="update buy set delivery='배송준비'";
    mysqli_query($db_conn,$sql);
    mysqli_close($db_conn);
    return $query;
}
function buy_clear($buynum){
    $db_conn=db_connection();
    $sql="update buy set buy='구매완료' where buynum=$buynum";
    $query=mysqli_query($db_conn,$sql);
    return $query;
}
function adminbuy($pageinfo,$page)
{
    $db_conn=db_connection();
    $first_num=($pageinfo['current_page']-1)*$page;
    $sql="select * from buy limit $first_num,$page";
    $query=mysqli_query($db_conn,$sql);
    $iCount=0;
    while($rows=mysqli_fetch_array($query))
    {
        $result[$iCount]=$rows;
        $iCount++;
    }
    mysqli_close($db_conn);
    return $result;
}
function adminbuy_count(){
    $db_conn=db_connection();
    $sql="select count(*) from buy";
    $query=mysqli_query($db_conn,$sql);
    $count=mysqli_fetch_array($query);
    return $count;
}
function selectadmin()
{
    $db_conn=db_connection();
    $sql="select * from admin";
    $query=mysqli_query($db_conn,$sql);
    $iCount=0;
    while($rows=mysqli_fetch_array($query))
    {
        $result[$iCount]=$rows;
        $iCount++;
    }
    mysqli_close($db_conn);
    return $result;
}
function delivery_update($anum,$buynum)
{
    $db_conn=db_connection();
    $sql="update admin set delivery='배송중' where anum=$anum";
    $query=mysqli_query($db_conn,$sql);
    $sql2="update buy set delivery='배송중' where buynum=$buynum";
    mysqli_query($db_conn,$sql2);
    mysqli_close($db_conn);

    return $query;
}
function delivery_update2($anum,$buynum)
{
    $db_conn=db_connection();
    $sql="update admin set delivery='배송완료' where anum=$anum";
    $query=mysqli_query($db_conn,$sql);
    $sql2="update buy set delivery='배송완료' where buynum=$buynum";
    mysqli_query($db_conn,$sql2);
    mysqli_close($db_conn);

    return $query;
}
function admin_view($user_id)
{
    $db_conn=db_connection();
    $sql="select * from admin where user_id='$user_id'";
    $query=mysqli_query($db_conn,$sql);
    $iCount=0;
    while($rows=mysqli_fetch_array($query))
    {
        $result[$iCount]=$rows;
    }
    mysqli_close($db_conn);
    return $result;
}
function view_product($pnum)
{
}
?>