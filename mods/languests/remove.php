<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: remove.php 1775 2009-02-17 20:59:11Z duRiel $

$cs_lang = cs_translate('languests');

$languests_form = 1;
$languests_id = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
settype($languests_id,'integer');

if(isset($_GET['agree'])) {
  $languests_form = 0;
  cs_sql_delete(__FILE__,'languests',$languests_id);
  
    cs_redirect($cs_lang['del_true'], 'languests');
}

if(isset($_GET['cancel']))
    cs_redirect($cs_lang['del_false'], 'languests');

if(!empty($languests_form)) {
  $data['lang']['body'] = sprintf($cs_lang['del_rly'],$languests_id);
  
  $data['lang']['content'] = cs_link($cs_lang['confirm'],'languests','remove','id=' . $languests_id . '&amp;agree');
  $data['lang']['content'] .= ' - ';
  $data['lang']['content'] .= cs_link($cs_lang['cancel'],'languests','remove','id=' . $languests_id . '&amp;cancel');
  
  echo cs_subtemplate(__FILE__,$data,'languests','remove');
}
