<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: options.php 1430 2008-12-10 13:08:44Z Fr33z3m4n $

$cs_lang = cs_translate('lanpartys');

$op_lanpartys = cs_sql_option(__FILE__,'lanpartys');

if(isset($_POST['submit'])) {

  require_once 'mods/clansphere/func_options.php';
  $save = array();

  $save['max_width'] = (int) $_POST['max_width'];
  $save['max_height'] = (int) $_POST['max_height'];
  $save['max_size'] = (int) $_POST['max_size'];

  cs_optionsave('lanpartys', $save);

  cs_redirect($cs_lang['changes_done'],'lanpartys','options');
}
else {
  $data['url']['form']= cs_url('lanpartys','options');
  $data['lanpartys']['max_width'] = $op_lanpartys['max_width'];
  $data['lanpartys']['max_height'] = $op_lanpartys['max_height'];
  $data['lanpartys']['max_size'] = $op_lanpartys['max_size'];
  $data['lang']['getmsg'] = cs_getmsg();
  
  echo cs_subtemplate(__FILE__,$data,'lanpartys','options');
}