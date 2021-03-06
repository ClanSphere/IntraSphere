<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: remove.php 1898 2009-03-05 06:12:49Z fay-pain $

$cs_lang = cs_translate('lanshop');
$cs_get = cs_get('id');

$lanshop_id = empty($cs_get['id']) ? 0 : $cs_get['id'];

if(isset($_GET['agree'])) {
 cs_sql_delete(__FILE__,'lanshop_articles',$lanshop_id);
 cs_redirect($cs_lang['del_true'],'lanshop');
}

if(isset($_GET['cancel'])) 
 cs_redirect($cs_lang['del_false'],'lanshop');

else {

  $data['head']['body'] = sprintf($cs_lang['del_rly'],$lanshop_id);
  $data['url']['agree'] = cs_url('lanshop','remove','id=' . $lanshop_id . '&amp;agree');
  $data['url']['cancel'] = cs_url('lanshop','remove','id=' . $lanshop_id . '&amp;cancel');
  
 echo cs_subtemplate(__FILE__,$data,'lanshop','remove');
}