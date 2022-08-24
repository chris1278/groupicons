<?php
/**
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\groupicons\migrations;

class v_1_0_0_db extends \phpbb\db\migration\migration
{

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v32x\v329'];
	}

	public function update_schema()
	{
		return [
			'add_columns'	=> [
				$this->table_prefix . 'groups'			=> [
					'group_groupicons'		=> ['VCHAR', '', 'after' => 'group_id'],
					'group_groupicons_pixel'	=> ['VCHAR', '', 'after' => 'group_id'],
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_columns'	=> [
				$this->table_prefix . 'groups'			=> [
					'group_groupicons',
					'group_groupicons_pixel',
				],
			],
		];
	}

	public function update_data()
	{
		return [
			['config.add',['group_groupicons_switch', 1]],
		];
	}
}
