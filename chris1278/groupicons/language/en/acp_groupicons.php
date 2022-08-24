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
	'GROUP_ICONS_SWITCH'						=> 'Icon´s for Group´s activate',
	'GROUP_ICONS_SWITCH_EXPLAIN'				=> 'Here you can disable the feature without uninstalling the extension',
	'ACP_GROUPICONS'							=> 'Icon´s for the groups in the legend view',
	'ACP_GROUPICONS_EXPLAIN'					=> 'With this extension you can insert icons for the individual groups. These icons are then displayed to the left of the group name in the legend.<br><br>The files must be in the <b>%1$s</b> folder. The following file extensions are permitted: <b>jpeg,jpg,gif,png</b>.',
	'ACP_ICON_SAVE'								=> 'Creating the icons for the desired group',
	'ACP_ICON_SAVE_EXPLAIN'						=> '<b>Here you can specify for which group you would like to have icons displayed. To do this, simply select from the following options and save them.</b>',
	'ACP_GROUP_SELECTION'						=> 'Selection of the group',
	'ACP_GROUP_SELECTION_EXPLAIN'				=> 'Please select the group for which you would like to enter the icon',
	'ACP_ICON_FILENAME'							=> 'Selection of the icon',
	'ACP_ICON_FILENAME_EXPLAIN'					=> 'Please select the icon here that you would like to assign to the group',
	'ACP_ICON_PIXEL'							=> 'Maximum pixel size',
	'ACP_ICON_PIXEL_EXPLAIN'					=> 'Here you can set the maximum number of pixels that the corresponding icon can be enlarged. Note that this is not a zoom function for icons. If you are here worth of. e.g. 24 set your icon but only has 12 pixels, this will only be displayed in 12 pixels. This only serves to compensate because some icons have to be displayed a little larger so that the optics look better. If you have a larger icon that exceeds the preset number of pixels, it will be displayed up to this number of pixels. e.g. if you have set 16px here, the icon will only be displayed as 16px even if it is larger than 16px.<br><br><b>Recommended default value: </b> 16',
	'ACP_GROUP_ICONS_OVERVIEW'					=> 'Overview of the used and assigned group icons',
	'ACP_LANG_GRUPPE'							=> 'Group',
	'ACP_ICON_NO_FILENAME'						=> 'No files have been uploaded to the <b>./images/groupicons/...</b> directory yet. As soon as you have uploaded your files there, they appear here for selection.',
	'ACP_LANG_ICON_PREVIEW'						=> 'Preview of the icon',
	'ACP_LANG_ICON_PIXEL'						=> 'Max. Pixel',
	'ACP_LANG_ICON_FILE'						=> 'File path and file name of the icon',
	'ACP_NO_FILE'								=> 'No file loaded',
	'ACP_SAVE'									=> 'Save',
	'ACP_DELETE'								=> 'Delete',
]);
