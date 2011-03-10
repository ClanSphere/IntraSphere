<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: info.php 1775 2009-02-17 20:59:11Z duRiel $

$cs_lang = cs_translate('lanvotes');

$mod_info['name']       = $cs_lang['mod_name'];
$mod_info['version']    = '2010.3';
$mod_info['released']   = '2011-03-10';
$mod_info['creator']    = 'hajo';
$mod_info['team']       = 'ClanSphere';
$mod_info['url']        = 'www.clansphere.net';
$mod_info['text']       = $cs_lang['modtext'];
$mod_info['icon']       = 'package_games_arcade';
$mod_info['show']       = array('clansphere/admin' => 3,'users/settings' => 2,'lanpartys/view' => 1);
$mod_info['references'] = array('lanpartys' => 'lanvotes');
$mod_info['categories'] = FALSE;
$mod_info['comments']   = FALSE;
$mod_info['protected']  = FALSE;
$mod_info['tables']     = array('lanvoted','lanvotes');