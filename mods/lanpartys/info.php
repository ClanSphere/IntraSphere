<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: info.php 1851 2009-03-01 19:13:21Z hajo $

$cs_lang = cs_translate('lanpartys');

$mod_info['name']       = $cs_lang['mod_name'];
$mod_info['version']    = '2010.3';
$mod_info['released']   = '2011-03-10';
$mod_info['creator']    = 'hajo';
$mod_info['team']       = 'ClanSphere';
$mod_info['url']        = 'www.clansphere.net';
$mod_info['text']       = $cs_lang['modtext'];
$mod_info['icon']       = 'connect_to_network';
$mod_info['show']       = array('clansphere/admin' => 3,'users/settings' => 2,'users/view' => 1,'options/roots' => 5,'lanpartys/view' => 1);
$mod_info['references'] = array('users' => 'languests');
$mod_info['categories'] = FALSE;
$mod_info['comments']   = FALSE;
$mod_info['protected']  = FALSE;
$mod_info['tables']     = array('lanpartys');