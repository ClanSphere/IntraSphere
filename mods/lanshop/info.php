<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: info.php 1775 2009-02-17 20:59:11Z duRiel $

$cs_lang = cs_translate('lanshop');

$mod_info['name']    = $cs_lang['mod_name'];
$mod_info['version']    = '2011.0';
$mod_info['released']   = '2011-03-03';
$mod_info['creator']  = 'hajo';
$mod_info['team']    = 'ClanSphere';
$mod_info['url']    = 'www.clansphere.net';
$mod_info['text']      = $cs_lang['modtext'];
$mod_info['icon']    = 'warehause';
$mod_info['show']    = array('clansphere/admin' => 3,'users/settings' => 2);
$mod_info['categories']  = TRUE;
$mod_info['comments']  = FALSE;
$mod_info['protected']  = FALSE;
$mod_info['tables']    = array('lanshop_articles','lanshop_orders'); 