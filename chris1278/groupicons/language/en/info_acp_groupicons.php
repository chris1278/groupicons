<?php
/**
*
* @package phpBB Extension - Checkbox when registering for consent to permanent data storage
* @copyright (c) 2022 Chris1278
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_GROUPICONS_TITLE'						=> 'Icons for the groups in the legend view',
	'ACP_GROUPICONS'							=> 'Settigs',
]);
