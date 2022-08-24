<?php
/**
 *
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\groupicons\acp;

class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\chris1278\groupicons\acp\main_module',
			'title'		=> 'ACP_GROUPICONS_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_GROUPICONS',
					'auth'	=> 'ext_chris1278/groupicons && acl_a_board',
					'cat'	=> ['ACP_GROUPICONS_TITLE'],
				]
			],
		];
	}
}
