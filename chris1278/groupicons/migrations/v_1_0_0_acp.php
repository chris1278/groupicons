<?php
/**
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\groupicons\migrations;

class v_1_0_0_acp extends \phpbb\db\migration\migration
{

	public static function depends_on()
	{
		return ['\chris1278\groupicons\migrations\v_1_0_0_db'];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_GROUPICONS_TITLE'
			]],
			['module.add', [
				'acp',
				'ACP_GROUPICONS_TITLE',
				[
					'module_basename'	=> '\chris1278\groupicons\acp\main_module',
					'modes'				=> ['settings'],
				],
			]],
		];
	}
}
