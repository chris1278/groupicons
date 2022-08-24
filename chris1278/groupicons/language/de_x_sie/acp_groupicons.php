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
	'GROUP_ICONS_SWITCH'						=> 'Icon´s für Gruppen aktivieren',
	'GROUP_ICONS_SWITCH_EXPLAIN'				=> 'Hier können Sie die Funktion deaktivieren ohne die Erweiterung zu deinstallieren',
	'ACP_GROUPICONS'							=> 'Icon´s für Gruppen in der Gruppen-Legende',
	'ACP_GROUPICONS_EXPLAIN'					=> 'Mit dieser Erweiterung können Sie für die einzelnen Gruppen icons einfügen. Diese Icons werden dann links neben dem Gruppennamen in der Legende angezeigt.<br><br>Die Dateien müssen sich im Ordner <b>%1$s</b> befinden. Erlaubt sind folgende Dateiendungen: <b>jpeg,jpg,gif,png</b>.',
	'ACP_ICON_SAVE'								=> 'Anlegen der Icons für die gewünschte Gruppe',
	'ACP_ICON_SAVE_EXPLAIN'						=> '<b>Hier können Sie festlegen bei welcher Gruppe Sie gerne icons anzeigen lassen möchten. Dazu wählen Sie hier einfach aus den nachfolgenen Optionen und Speichere diese ab.</b>',
	'ACP_GROUP_SELECTION'						=> 'Auswahl der Gruppe',
	'ACP_GROUP_SELECTION_EXPLAIN'				=> 'Wählen Sie hier bitte die Gruppe aus bei der Sie das Icon eintragen möchten.',
	'ACP_ICON_FILENAME'							=> 'Auswahl des Icon',
	'ACP_ICON_FILENAME_EXPLAIN'					=> 'Wählen Sie hier bitte das Icon aus, welches Sie der Gruppe zuordnen möchtest',
	'ACP_ICON_PIXEL'							=> 'Maximale Pixelgrösse',
	'ACP_ICON_PIXEL_EXPLAIN'					=> 'Hier können Sie die maximale Pixelzahl einstellen bis der das entsprechende Icon vergrößert werden kann. Beachten Sie, das dies keine Zoom-Funktion für Icons ist. Wenn Sie hier einen wert von. z.b. 24 einstellen ihr Icon aber nur 12 Pixel hat wird dies auch nur in 12 Pixel angezeigt. Dies dient nur zum Ausgleich weil manche Icons ein wenig Grösser dargestellt werden müssen damit die Optik besser wirkt. Wenn Sie ein Größeres Icon haben was die vor eingestellte Pixelzahl übersteigt wird dies bis eben dieser Pixelzahl angezeigt. z.B. wenn Sie hier 16px eingestellt haben wird das Icon auch wenn größer als 16px nur als 16px angezeigt.<br><br><b>Empfohlener Standartwert: </b> 16',
	'ACP_GROUP_ICONS_OVERVIEW'					=> 'Übersicht der genutzten und zugeordneten Gruppen Icons',
	'ACP_LANG_GRUPPE'							=> 'Gruppe',
	'ACP_ICON_NO_FILENAME'						=> 'Es wurden noch keine Dateien in das Verzeichnis <b>./images/groupicons/...</b> hochgeladen. Sobald Sie dort ihre Dateien hochgeladen haben erscheinen diese hier zur Auswahl.',
	'ACP_LANG_ICON_PREVIEW'						=> 'Vorschau des Icons',
	'ACP_LANG_ICON_PIXEL'						=> 'Max. Pixel',
	'ACP_LANG_ICON_FILE'						=> 'Dateipfad und Dateiname des Icons',
	'ACP_NO_FILE'								=> 'Keine Datei geladen',
	'ACP_SAVE'									=> 'Speichern',
	'ACP_DELETE'								=> 'Löschen',
]);
