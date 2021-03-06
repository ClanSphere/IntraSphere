<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: center.php 1898 2009-03-05 06:12:49Z fay-pain $

$cs_lang = cs_translate('lanshop');
$cs_post = cs_post('where,start,sort');
$cs_get = cs_get('where,start,sort');
$data = array();

$start = empty($cs_get['start']) ? 0 : $cs_get['start'];
if (!empty($cs_post['start']))  $start = $cs_post['start'];
$sort = empty($cs_get['sort']) ? 2 : $cs_get['sort'];
if (!empty($cs_post['sort']))  $sort = $cs_post['sort'];

$article = empty($_POST['lanshop_articles_id']) ? 0 : $_POST['lanshop_articles_id'];
$value = empty($_POST['lanshop_orders_value']) ? 0 : $_POST['lanshop_orders_value'];

settype($article,'integer');
settype($value,'integer');

if(!empty($article) AND !empty($value)) {

  $where = 'users_id = ' . (int) $account['users_id'] . ' AND lanshop_articles_id = ' . (int) $article . ' AND lanshop_orders_status = 1';
  $check = cs_sql_count(__FILE__, 'lanshop_orders', $where);

  $get_art = "lanshop_articles_id = " . (int) $article;
  $fetch = cs_sql_select(__FILE__,'lanshop_articles','categories_id',$get_art);
  $categories_id = $fetch['categories_id'];

  if(empty($check)) {
    $order_cells = array('users_id', 'lanshop_articles_id', 'lanshop_orders_since', 'lanshop_orders_value', 'lanshop_orders_status');
    $order_save = array($account['users_id'], $article, cs_time(), $value, 1);
    cs_sql_insert(__FILE__,'lanshop_orders',$order_cells,$order_save);

    cs_redirect(cs_icon('submit') . ' ' . $cs_lang['order_done'],'lanshop','center', 'where=' . $categories_id);
  }
  else
  {
    cs_redirect(cs_icon('cancel') . ' ' . $cs_lang['order_double'],'lanshop','center', 'where=' . $categories_id);
  }
}
else {
  $categories_id = empty($cs_get['where']) ? 0 : $cs_get['where'];
  if (!empty($cs_post['where']))  $categories_id = $cs_post['where'];
}

$cs_sort[1] = 'lanshop_articles_name DESC';
$cs_sort[2] = 'lanshop_articles_name ASC';
$cs_sort[3] = 'lanshop_articles_price DESC';
$cs_sort[4] = 'lanshop_articles_price ASC';
$order = $cs_sort[$sort];
$where = empty($categories_id) ? 0 : "categories_id = '" . $categories_id . "'";
$lanshop_count = cs_sql_count(__FILE__,'lanshop_articles',$where);


$data['head']['body'] = sprintf($cs_lang['items_found'],$lanshop_count);
$data['head']['pages'] = cs_pages('lanshop','center',$lanshop_count,$start,$categories_id,$sort);

$lanshopmod = "categories_mod='lanshop'";
$categories_data = cs_sql_select(__FILE__,'categories','*',$lanshopmod,'categories_name',0,0);
$data['head']['cat_dropdown'] = cs_dropdown('where','categories_name',$categories_data,$categories_id,'categories_id');
$data['head']['getmsg'] = cs_getmsg();

$data['sort']['name'] = cs_sort('lanshop','center',$start,$categories_id,1,$sort);
$data['sort']['price'] = cs_sort('lanshop','center',$start,$categories_id,3,$sort);

$select = 'lanshop_articles_name, lanshop_articles_price, lanshop_articles_id';
$data['articles'] = cs_sql_select(__FILE__,'lanshop_articles',$select,$where,$order,$start,$account['users_limit']);
$lanshop_loop = count($data['articles']);

for($run=0; $run<$lanshop_loop; $run++) {

  $data['articles'][$run]['id'] = $data['articles'][$run]['lanshop_articles_id'];
  $data['articles'][$run]['name'] = cs_secure($data['articles'][$run]['lanshop_articles_name']);
  $data['articles'][$run]['price'] = $data['articles'][$run]['lanshop_articles_price'] / 100 . ' ' . $cs_lang['cost'];
}

echo cs_subtemplate(__FILE__,$data,'lanshop','center');