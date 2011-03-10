<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: edit.php 1775 2009-02-17 20:59:11Z duRiel $

$cs_lang = cs_translate('lanrooms');

$lanrooms_id = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
settype($lanrooms_id,'integer');

$op_lanrooms = cs_sql_option(__FILE__,'lanrooms');
$img_filetypes = array('gif','jpg','png');
$files = cs_files();

$data['if']['more'] = FALSE;

if(isset($_POST['submit'])) {
  $cs_lanrooms['lanpartys_id'] = $_POST['lanpartys_id'];
  $cs_lanrooms['lanrooms_name'] = $_POST['lanrooms_name'];
  $cs_lanrooms['lanrooms_background'] = $_POST['lanrooms_background'];

  $error = '';

  if(isset($_POST['delete']) AND $_POST['delete'] == TRUE AND !empty($cs_lanrooms['lanrooms_background'])) {
    cs_unlink('lanrooms', $cs_lanrooms['lanrooms_background']);
    $cs_lanrooms['lanrooms_background'] = '';
  }

  $img_size = false;
  if(!empty($files['background']['tmp_name']))
    $img_size = getimagesize($files['background']['tmp_name']);

  if(!empty($files['background']['tmp_name']) AND empty($img_size) OR $img_size[2] > 3) {
    $error .= $cs_lang['ext_error'] . cs_html_br(1);
  }
  elseif(!empty($files['background']['tmp_name'])) {

    switch($img_size[2]) {
    case 1:
      $ext = 'gif'; break;
    case 2:
      $ext = 'jpg'; break;
    case 3:
      $ext = 'png'; break;
    }
    $filename = 'background-' . $lanrooms_id . '.' . $ext;
    
    if($img_size[0]>$op_lanrooms['max_width']) {
      $error .= $cs_lang['too_wide'] . cs_html_br(1);
    }
    if($img_size[1]>$op_lanrooms['max_height']) { 
      $error .= $cs_lang['too_high'] . cs_html_br(1);
    }
    if($files['background']['size']>$op_lanrooms['max_size']) { 
      $error .= $cs_lang['too_big'] . cs_html_br(1);
    }
    if(empty($error) AND cs_upload('lanrooms', $filename, $files['background']['tmp_name']) OR !empty($error) AND extension_loaded('gd') AND cs_resample($files['background']['tmp_name'], 'uploads/lanrooms/' . $filename, $op_lanrooms['max_width'], $op_lanrooms['max_height'])) {
      $error = '';
      if($cs_lanrooms['lanrooms_background'] != $filename AND !empty($cs_lanrooms['lanrooms_background'])) {
        cs_unlink('lanrooms', $cs_lanrooms['lanrooms_background']);
      }
      $cs_lanrooms['lanrooms_background'] = $filename;
    }
    else {
      $error .= $cs_lang['up_error'];
    }
  }

  if(empty($cs_lanrooms['lanpartys_id'])) {
    $error .= $cs_lang['no_lanparty'] . cs_html_br(1);
  }
  else {
    $where = "lanpartys_id = '" . cs_sql_escape($cs_lanrooms['lanpartys_id']) . "' AND ";
    $where .= "lanrooms_name = '" . cs_sql_escape($cs_lanrooms['lanrooms_name']) . "'";
    $where .= " AND lanrooms_id != '" . $lanrooms_id . "'";
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
  $cells = 'lanpartys_id, lanrooms_name, lanrooms_background';
  $cs_lanrooms = cs_sql_select(__FILE__,'lanrooms',$cells,"lanrooms_id = '" . $lanrooms_id . "'");
}

$data['lang']['body'] = $cs_lang['body_edit'];
if(!empty($error))
  $data['lang']['body'] = $error;

if(!empty($error) OR !isset($_POST['submit'])) {
  $data['url']['form'] = cs_url('lanrooms','edit');

  $lan_old = cs_sql_select(__FILE__,'lanpartys','*','lanpartys_id = "' . $cs_lanrooms['lanpartys_id'] . '"');
  
  $data['lan_old']['id'] = $lan_old['lanpartys_id'];
  $data['lan_old']['name'] = $lan_old['lanpartys_name'];

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

  $data['data']['id'] = $lanrooms_id;

  include_once 'mods/lanrooms/functions.php';
  $data['data']['map'] = cs_lanroom('lanrooms','edit',$lanrooms_id);

  $data['data']['current_pic'] = $cs_lang['nopic'];
  if(!empty($cs_lanrooms['lanrooms_background'])) {
    $data['if']['more'] = TRUE;
    $place = 'uploads/lanrooms/' . $cs_lanrooms['lanrooms_background'];
    $size = getimagesize($cs_main['def_path'] . '/' . $place);
    $data['data']['current_pic'] = cs_html_img($place,$size[1],$size[0]);
  }

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

  echo cs_subtemplate(__FILE__,$data,'lanrooms','edit');
}
else {
  $lanrooms_cells = array_keys($cs_lanrooms);
  $lanrooms_save = array_values($cs_lanrooms);
  cs_sql_update(__FILE__,'lanrooms',$lanrooms_cells,$lanrooms_save,$lanrooms_id);
  
  cs_redirect($cs_lang['changes_done'], 'lanrooms') ;
}