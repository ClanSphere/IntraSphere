<?php
// ClanSphere 2009 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('lanshop');
$cs_post = cs_post('id');
$cs_get = cs_get('id');
$data = array();
$data['time']['now'] = cs_date('unix',cs_time(),1);

$categories_id = empty($cs_get['id']) ? 0 : $cs_get['id'];
if(!empty($cs_post['where'])) $categories_id = $cs_post['id'];
$where = "lso.lanshop_orders_status = 2 AND las.categories_id = " . (int) $categories_id;

$cat_data = cs_sql_select(__FILE__, 'categories' ,'categories_name, categories_id', 'categories_id = ' . (int) $categories_id);
$data['data']['category'] = cs_secure($cat_data['categories_name']);

$from = 'lanshop_orders lso INNER JOIN {pre}_lanshop_articles las ON lso.lanshop_articles_id = las.lanshop_articles_id';
$select = 'SUM(lso.lanshop_orders_value) AS totalvalue, SUM(lso.lanshop_orders_value * las.lanshop_articles_price) AS totalcost';
$details = cs_sql_select(__FILE__, $from, $select, $where);
$data['data']['totalvalue'] = $details['totalvalue'];
$data['data']['totalcost'] = $details['totalcost'] / 100 . ' ' . $cs_lang['cost'];

$select = 'usr.users_id AS users_id, usr.users_nick AS users_nick, usr.users_active AS users_active, usr.users_delete AS users_delete, lso.lanshop_orders_value AS lanshop_orders_value, las.lanshop_articles_name AS lanshop_articles_name, las.lanshop_articles_price AS lanshop_articles_price';
$from = 'lanshop_orders lso INNER JOIN {pre}_lanshop_articles las ON lso.lanshop_articles_id = las.lanshop_articles_id INNER JOIN {pre}_users usr ON lso.users_id = usr.users_id';
$order = 'lso.users_id ASC, las.lanshop_articles_name ASC';
$cs_lanshop = cs_sql_select(__FILE__,$from,$select,$where,$order,0,0);
$lanshop_loop = count($cs_lanshop);

$users_id = 0;

$data['orders'] = array();

for($run = 0; $run < $lanshop_loop; $run++) {

	$data['orders'][$run]['if']['user'] = FALSE;
  if($users_id != $cs_lanshop[$run]['users_id']) {
  	$data['orders'][$run]['if']['user'] = TRUE;
    $users_id = $cs_lanshop[$run]['users_id'];
    $data['orders'][$run]['user'] = cs_user($users_id, $cs_lanshop[$run]['users_nick'], $cs_lanshop[$run]['users_active'], $cs_lanshop[$run]['users_delete']);
  }

  $data['orders'][$run]['users_id'] = $cs_lanshop[$run]['users_id'];
  $data['orders'][$run]['article'] = cs_secure($cs_lanshop[$run]['lanshop_articles_name']);
  $data['orders'][$run]['value'] = $cs_lanshop[$run]['lanshop_orders_value'];
  $pay = ($cs_lanshop[$run]['lanshop_orders_value'] * $cs_lanshop[$run]['lanshop_articles_price'] / 100) . ' ' . $cs_lang['cost'];
  $data['orders'][$run]['money'] = $pay;
}

echo cs_subtemplate(__FILE__,$data,'lanshop','printcat');