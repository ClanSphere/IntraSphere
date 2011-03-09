<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: export.php 1898 2009-03-05 06:12:49Z fay-pain $

$cs_lang = cs_translate('lanshop');

$data = array();

$data['cat'] = cs_sql_select(__FILE__, 'categories', 'categories_id, categories_name', "categories_mod='lanshop'", 'categories_name ASC', 0, 0);
$cs_countcat = count($data['cat']);

$from = 'lanshop_orders lso INNER JOIN {pre}_lanshop_articles las ON lso.lanshop_articles_id = las.lanshop_articles_id';
$select = 'SUM(lso.lanshop_orders_value) AS totalvalue, SUM(lso.lanshop_orders_value * las.lanshop_articles_price) AS totalcost';
$where = 'lso.lanshop_orders_status = 2 AND las.categories_id = ';

for($run = 0; $run < $cs_countcat; $run++) {
  $cat_id = $data['cat'][$run]['categories_id'];
  $data['cat'][$run]['id'] = $cat_id;
  $data['cat'][$run]['name'] = cs_link(cs_secure($data['cat'][$run]['categories_name']), 'categories', 'view', 'id=' . $cat_id);

  $details = cs_sql_select(__FILE__, $from, $select, $where . $cat_id);

  $data['cat'][$run]['totalvalue'] = $details['totalvalue'];
  $data['cat'][$run]['totalcost'] = $details['totalcost'] / 100 . ' ' . $cs_lang['cost'];
}

echo cs_subtemplate(__FILE__,$data,'lanshop','export');