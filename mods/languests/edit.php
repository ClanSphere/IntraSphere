<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: edit.php 1775 2009-02-17 20:59:11Z duRiel $

$cs_lang = cs_translate('languests');

$languests_id = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
settype($languests_id,'integer');

$users_nick = '';
$cs_languests['users_id'] = 0;

if(isset($_POST['submit'])) {
  $cs_languests['lanpartys_id'] = $_POST['lanpartys_id'];
  $cs_languests['languests_status'] = $_POST['languests_status'];
  $cs_languests['languests_money'] = $_POST['languests_money'];
  $cs_languests['languests_notice'] = $_POST['languests_notice'];
  $cs_languests['languests_team'] = $_POST['languests_team'];
  $cs_languests['languests_paytime'] = cs_datepost('pay','unix');

  settype($cs_languests['lanpartys_id'],'integer');
  settype($cs_languests['users_id'],'integer');

  $error = 0;
  $errormsg = '';

  $users_nick = empty($_REQUEST['users_nick']) ? '' : $_REQUEST['users_nick'];

  $where = "users_nick = '" . cs_sql_escape($users_nick) . "'";
  $users_data = cs_sql_select(__FILE__, 'users', 'users_id', $where);
  if(empty($users_data['users_id'])) {
    $error++;
    $errormsg .= $cs_lang['no_user'] . cs_html_br(1);
  }
  else
    $cs_languests['users_id'] = $users_data['users_id'];
  
  if(empty($cs_languests['lanpartys_id'])) {
    $error++;
    $errormsg .= $cs_lang['no_lanparty'] . cs_html_br(1);
  }
  else {
    
  $where = "lanpartys_id = '" . $cs_languests['lanpartys_id'] . "' AND users_id = '";
    $where .= $cs_languests['users_id'] . "' AND languests_id != '" . $languests_id . "'";
    $search_collision = cs_sql_count(__FILE__,'languests',$where);
    
  if(!empty($search_collision)) {
      $error++;
      $errormsg .= $cs_lang['user_lan_exists'] . cs_html_br(1);
    }
    
  $where2 = "lanpartys_id = '" . $cs_languests['lanpartys_id'] . "'";
    $maxguests = cs_sql_select(__FILE__,'lanpartys','lanpartys_maxguests',$where2);
    $where3 = "lanpartys_id = '" . $cs_languests['lanpartys_id'] . "' AND languests_status > 3";
    $where3 .= " AND languests_id != '" . $languests_id . "'";
    $search_max = cs_sql_count(__FILE__,'languests',$where3);
    
  if($search_max >= $maxguests['lanpartys_maxguests']) {
      $error++;
      $errormsg .= $cs_lang['lan_full'] . cs_html_br(1);
    }
  }
}
else {
  $cells = 'lanpartys_id, users_id, languests_status, languests_money, languests_paytime, languests_notice, languests_team';
  $cs_languests = cs_sql_select(__FILE__,'languests',$cells,"languests_id = '" . $languests_id . "'");
  $cs_users = cs_sql_select(__FILE__,'users','users_nick','users_id = ' . (int) $cs_languests['users_id']);
  $users_nick = $cs_users['users_nick'];
}

if(!isset($_POST['submit'])) {
  $data['lang']['body'] = $cs_lang['errors_here'];
}

if(!empty($error)) {
  $data['lang']['body'] = $errormsg;
}

if(!empty($error) OR !isset($_POST['submit'])) {
  $data['url']['form'] = cs_url('languests','edit');

  $lanpartys_data = cs_sql_select(__FILE__,'lanpartys','lanpartys_name, lanpartys_id',0,'lanpartys_name',0,0);
  $lanpartys_data_loop = count($lanpartys_data);

  if(empty($lanpartys_data_loop)) {
    $data['lanpartys'] = '';
  }

  for($run=0; $run<$lanpartys_data_loop; $run++) {
    $data['lanpartys'][$run]['id'] = $lanpartys_data[$run]['lanpartys_id'];
    $data['lanpartys'][$run]['name'] = $lanpartys_data[$run]['lanpartys_name'];
    $data['lanpartys'][$run]['select'] = ($cs_languests['lanpartys_id'] == $lanpartys_data[$run]['lanpartys_id']) ? 'selected="selected"' : '';
  }

  $data['languests']['team'] = $cs_languests['languests_team'];
  
  $cs_languests['languests_status'] == 3 ? $sel[3] = 1 : $sel[3] = 0;
  $cs_languests['languests_status'] == 4 ? $sel[4] = 1 : $sel[4] = 0;
  $cs_languests['languests_status'] == 5 ? $sel[5] = 1 : $sel[5] = 0;

  $data['select']['3'] = $cs_languests['languests_status'] == 3 ? 'selected="selected"' : '';
  $data['select']['4'] = $cs_languests['languests_status'] == 4 ? 'selected="selected"' : '';
  $data['select']['5'] = $cs_languests['languests_status'] == 5 ? 'selected="selected"' : '';

  $data['languests']['money'] = $cs_languests['languests_money'];
  $data['languests']['paytime'] = cs_dateselect('pay','unix',$cs_languests['languests_paytime']);
  $data['languests']['notice'] = $cs_languests['languests_notice'];
  $data['data']['id'] = $languests_id;

  $data['users']['nick'] = cs_secure($users_nick);

  echo cs_subtemplate(__FILE__,$data,'languests','edit');
}
else {
  $languests_cells = array_keys($cs_languests);
  $languests_save = array_values($cs_languests);
  cs_sql_update(__FILE__,'languests',$languests_cells,$languests_save,$languests_id);
  
  cs_redirect($cs_lang['changes_done'], 'languests') ;
}  