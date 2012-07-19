<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: remove.php 1775 2009-02-17 20:59:11Z duRiel $

$cs_lang = cs_translate('lanrooms');

$lanrooms_form = 1;
$lanrooms_id = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
settype($lanrooms_id,'integer');

if(isset($_GET['agree'])) {
  $lanrooms_form = 0;
  cs_sql_delete(__FILE__,'lanroomd',$lanrooms_id,'lanrooms_id');
  cs_sql_delete(__FILE__,'lanrooms',$lanrooms_id);
  
  cs_redirect($cs_lang['del_true'], 'lanrooms');
}

if(isset($_GET['cancel']))
  cs_redirect($cs_lang['del_false'], 'lanroom');
  
if(!empty($lanrooms_form)) {
  $data['lang']['body'] = sprintf($cs_lang['del_rly'],$lanrooms_id);
  
  $data['lang']['content'] = cs_link($cs_lang['confirm'],'lanrooms','remove','id=' . $lanrooms_id . '&amp;agree');
  $data['lang']['content'] .= ' - ';
  $data['lang']['content'] .= cs_link($cs_lang['cancel'],'lanrooms','remove','id=' . $lanrooms_id . '&amp;cancel');
  
  echo cs_subtemplate(__FILE__,$data,'lanrooms','remove');
}