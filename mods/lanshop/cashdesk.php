<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: cashdesk.php 1898 2009-03-05 06:12:49Z fay-pain $

$cs_lang = cs_translate('lanshop');

$data = array();

$users_id = empty($_REQUEST['users_id']) ? 0 : $_REQUEST['users_id'];
settype($users_id, 'integer');
$search_name = empty($_POST['search_name']) ? '' : $_POST['search_name'];

$where = empty($users_id) ? "users_nick = '" . cs_sql_escape($search_name) . "'" : 'users_id = ' . $users_id; 

$select = 'users_id, users_nick, users_active, users_delete';
$cs_user = cs_sql_select(__FILE__, 'users', $select, $where);
$users_id = $cs_user['users_id'];
$data['search']['name'] = empty($cs_user['users_nick']) ? cs_secure($search_name) : cs_secure($cs_user['users_nick']);

if(!empty($_GET['remove_id']) AND $account['access_lanshop'] == 5) {
  $remove_id = $_GET['remove_id'];
  settype($remove_id,'integer');
 cs_sql_delete(__FILE__,'lanshop_orders',$remove_id);
}
elseif($account['access_lanshop'] >= 4) {
  if(!empty($_GET['pay_id']) OR !empty($_GET['unpay_id'])) {
    $status = isset($_GET['pay_id']) ? 2 : 1;
    $pay_id = ($status == 2) ? $_GET['pay_id'] : $_GET['unpay_id'];
    settype($pay_id,'integer');
    $lanshop_cells = array('lanshop_orders_since','lanshop_orders_status');
    $lanshop_save = array(cs_time(), $status);
    cs_sql_update(__FILE__,'lanshop_orders',$lanshop_cells,$lanshop_save,$pay_id);
  }
}

$categories_id = empty($_REQUEST['categories_id']) ? 0 : $_REQUEST['categories_id'];
$orders_status = empty($_REQUEST['status']) ? 0 : $_REQUEST['status'];

settype($categories_id,'integer');
settype($orders_status,'integer');

$data['if']['user'] = empty($users_id) ? FALSE : TRUE;

$lanshopmod = "categories_mod='lanshop'";
$categories_data = cs_sql_select(__FILE__,'categories','*',$lanshopmod,'categories_name',0,0);
$data['head']['cat_dropdown'] = cs_dropdown('categories_id','categories_name',$categories_data,$categories_id);

$status = array();
$status[0]['status'] = 1;
$status[0]['name'] = $cs_lang['status_1'];
$status[1]['status'] = 2;
$status[1]['name'] = $cs_lang['status_2'];
$status[2]['status'] = 3;
$status[2]['name'] = $cs_lang['status_3'];
$data['head']['status_dropdown'] = cs_dropdown('status','name',$status,$orders_status);

if(empty($users_id)) {
  $data['bottom']['body'] = $cs_lang['no_user_info'];
}
else {
  $where = "lso.users_id = '" . $users_id . "' AND ";
  $where .= empty($categories_id) ? '' : "las.categories_id = '" . $categories_id . "' AND ";
  $where .= empty($orders_status) ? '' : "lso.lanshop_orders_status = '" . $orders_status . "' AND ";
  $where = substr($where,0,-5);

  $from = 'lanshop_orders lso INNER JOIN {pre}_lanshop_articles las ON lso.lanshop_articles_id = las.lanshop_articles_id';
  $select = 'lso.lanshop_orders_id AS lanshop_orders_id, lso.lanshop_orders_status AS lanshop_orders_status, lso.lanshop_orders_value AS lanshop_orders_value, las.lanshop_articles_id AS lanshop_articles_id, las.lanshop_articles_name AS lanshop_articles_name, las.lanshop_articles_price AS lanshop_articles_price';
  $order = 'lanshop_orders_status ASC, lanshop_articles_name ASC';
  $data['orders'] = cs_sql_select(__FILE__,$from,$select,$where,$order,0,0);
  $lanshop_loop = count($data['orders']);

  $money = 0;

  for($run = 0; $run < $lanshop_loop; $run++) {

    $get = 'users_id=' . $users_id . '&amp;categories_id=' . $categories_id . '&amp;status=' . $orders_status . '&amp;';
    $id = $data['orders'][$run]['lanshop_orders_id'];

    $lanshop_view = cs_secure($data['orders'][$run]['lanshop_articles_name']);
    $data['orders'][$run]['article'] = cs_link($lanshop_view,'lanshop','view','id=' . $data['orders'][$run]['lanshop_articles_id']);
    $status = $data['orders'][$run]['lanshop_orders_status'];
    $data['orders'][$run]['status'] = $cs_lang['status_' . $status];

    if($status == 1)
      $data['orders'][$run]['pay_id'] = cs_link(cs_icon('money',16),'lanshop','cashdesk',$get . 'pay_id=' . $id);
    elseif($status == 2)
      $data['orders'][$run]['pay_id'] = cs_link(cs_icon('cancel',16),'lanshop','cashdesk',$get . 'unpay_id=' . $id);
    else
      $data['orders'][$run]['pay_id'] = cs_icon('submit',16);

    $data['orders'][$run]['value'] = $data['orders'][$run]['lanshop_orders_value'];
    $img_del = cs_icon('editdelete',16);
    $data['orders'][$run]['remove_id'] = cs_link($img_del,'lanshop','cashdesk',$get . 'remove_id=' . $id,0,$cs_lang['remove']);
    $cost = $data['orders'][$run]['lanshop_articles_price'] * $data['orders'][$run]['lanshop_orders_value'];
    $data['orders'][$run]['cost'] = $cost / 100 . ' ' . $cs_lang['cost'];

    if($status == 1) {
      $money = $money + $cost;
    }
  }

  $data['bottom']['body'] = sprintf($cs_lang['money_all'],$money / 100);
}

echo cs_subtemplate(__FILE__,$data,'lanshop','cashdesk');