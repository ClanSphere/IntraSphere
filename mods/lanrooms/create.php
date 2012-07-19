<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: create.php 1775 2009-02-17 20:59:11Z duRiel $

$cs_lang = cs_translate('lanrooms');

$files_gl = cs_files();

$op_lanrooms = cs_sql_option(__FILE__,'lanrooms');
$img_filetypes = array('gif','jpg','png');

if(isset($_POST['submit'])) {

  $cs_lanrooms['lanpartys_id'] = $_POST['lanpartys_id'];
  $cs_lanrooms['lanrooms_name'] = $_POST['lanrooms_name'];

  $error = '';

  $img_size = false;
  if(!empty($files_gl['background']['tmp_name']))
    $img_size = getimagesize($files_gl['background']['tmp_name']);

  if(!empty($files_gl['background']['tmp_name']) AND empty($img_size) OR $img_size[2] > 3) {
    $error .= $cs_lang['ext_error'] . cs_html_br(1);
  }
  elseif(!empty($files_gl['background']['tmp_name'])) {

    switch($img_size[2]) {
    case 1:
      $extension = 'gif'; break;
    case 2:
      $extension = 'jpg'; break;
    case 3:
      $extension = 'png'; break;
    }
    
    if($img_size[0]>$op_lanrooms['max_width']) {
      $error .= $cs_lang['too_wide'] . cs_html_br(1);
    }
    if($img_size[1]>$op_lanrooms['max_height']) { 
      $error .= $cs_lang['too_high'] . cs_html_br(1);
    }
    if($files_gl['background']['size']>$op_lanrooms['max_size']) { 
      $error .= $cs_lang['too_big'] . cs_html_br(1);
    }
  }

  if(empty($cs_lanrooms['lanpartys_id'])) {
    $error .= $cs_lang['no_lanparty'] . cs_html_br(1);
  }
  else {
    $where = "lanpartys_id = '" . cs_sql_escape($cs_lanrooms['lanpartys_id']) . "' AND ";
    $where .= "lanrooms_name = '" . cs_sql_escape($cs_lanrooms['lanrooms_name']) . "'";
    $search_collision = cs_sql_count(__FILE__,'lanrooms',$where);
    if(!empty($search_collision)) {
      $error .= $cs_lang['name_lan_exists'] . cs_html_br(1);
    }
  }

  if(empty($cs_lanrooms['lanrooms_name'])) {
    $error .= $cs_lang['no_name'] . cs_html_br(1);
  }
}
else {
  $cs_lanrooms['lanpartys_id'] = 0;
  $cs_lanrooms['lanrooms_name'] = '';
}

$data['lang']['body'] = $cs_lang['body_create'];
if(!empty($error))
  $data['lang']['body'] = $error;

if(!empty($error) OR !isset($_POST['submit'])) {
  $data['url']['form'] = cs_url('lanrooms','create');
  
  $lan_data = cs_sql_select(__FILE__,'lanpartys','lanpartys_name, lanpartys_id',0,'lanpartys_name',0,0);
  $lan_data_loop = count($lan_data);

  if(empty($lan_data_loop)) {
    $data['lan'] = '';
  }

  for($run=0; $run<$lan_data_loop; $run++) {
    $data['lan'][$run]['id'] = $lan_data[$run]['lanpartys_id'];
    $data['lan'][$run]['name'] = $lan_data[$run]['lanpartys_name'];
  }

  $data['lanroom']['name'] = $cs_lanrooms['lanrooms_name'];

  $matches[1] = $cs_lang['pic_infos'];
  $return_types = '';
  foreach($img_filetypes AS $add) {
    $return_types .= empty($return_types) ? $add : ', ' . $add;
  }
  $matches[2] = $cs_lang['max_width'] . ': ' . $op_lanrooms['max_width'] . ' px' . cs_html_br(1);
  $matches[2] .= $cs_lang['max_height'] . ': ' . $op_lanrooms['max_height'] . ' px' . cs_html_br(1);
  $matches[2] .= $cs_lang['max_size'] . ': ' . cs_filesize($op_lanrooms['max_size']) . cs_html_br(1);
  $matches[2] .= $cs_lang['filetypes'] . $return_types;
  $data['data']['picup_clip'] = cs_abcode_clip($matches);

  echo cs_subtemplate(__FILE__,$data,'lanrooms','create');
}
else {
  $lanrooms_cells = array_keys($cs_lanrooms);
  $lanrooms_save = array_values($cs_lanrooms);
  cs_sql_insert(__FILE__,'lanrooms',$lanrooms_cells,$lanrooms_save);
  $last_id = cs_sql_insertid(__FILE__);

  if(!empty($files_gl['background']['tmp_name'])) {
    $filename = 'background-' . $last_id . '.' . $extension;
    cs_upload('lanrooms',$filename,$files_gl['background']['tmp_name']);
    
    $cs_lanrooms['lanrooms_background'] = $filename;
    $lanrooms_cells = array_keys($cs_lanrooms);
    $lanrooms_save = array_values($cs_lanrooms); 
    cs_sql_update(__FILE__,'lanrooms',$lanrooms_cells,$lanrooms_save,$last_id);
  }

  cs_redirect($cs_lang['create_done'],'lanrooms');
}