<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: info.php 1775 2009-02-17 20:59:11Z duRiel $

$cs_lang = cs_translate('languests');

$mod_info['name']       = $cs_lang['mod_name'];
$mod_info['version']    = '2011.0';
$mod_info['released']   = '2013-12-06';
$mod_info['creator']    = 'hajo';
$mod_info['team']       = 'ClanSphere';
$mod_info['url']        = 'www.clansphere.net';
$mod_info['text']       = $cs_lang['modtext'];
$mod_info['icon']       = 'neotux';
$mod_info['show']       = array('clansphere/admin' => 3,'lanpartys/view' => 1);
$mod_info['references'] = array('lanpartys' => 'languests');
$mod_info['categories'] = FALSE;
$mod_info['comments']   = FALSE;
$mod_info['protected']  = FALSE;
$mod_info['tables']     = array('languests');
