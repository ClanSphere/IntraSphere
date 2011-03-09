<?php
// ClanSphere 2009 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('lanrooms');

$op_lanrooms = cs_sql_option(__FILE__,'lanrooms');

if(isset($_POST['submit'])) {

  require_once 'mods/clansphere/func_options.php';
  $save = array();

  $save['max_width'] = (int) $_POST['max_width'];
  $save['max_height'] = (int) $_POST['max_height'];
  $save['max_size'] = (int) $_POST['max_size'];

  cs_optionsave('lanrooms', $save);

  cs_redirect($cs_lang['changes_done'],'lanrooms','options');
}
else {
  $data['url']['form']= cs_url('lanrooms','options');
  $data['lanrooms']['max_width'] = $op_lanrooms['max_width'];
  $data['lanrooms']['max_height'] = $op_lanrooms['max_height'];
  $data['lanrooms']['max_size'] = $op_lanrooms['max_size'];
  $data['lang']['getmsg'] = cs_getmsg();
  
  echo cs_subtemplate(__FILE__,$data,'lanrooms','options');
}