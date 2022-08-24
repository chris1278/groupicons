<?php
/**
 *
 * Counter. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\groupicons\controller;

class acp_controller
{
	protected $container;
	protected $config;
	protected $template;
	protected $db;
	protected $request;
	protected $language;
	protected $phpbb_root_path;

	protected $u_action;

	public function __construct(
		\Symfony\Component\DependencyInjection\ContainerInterface $container,
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\request\request $request,
		\phpbb\language\language $language,
		$phpbb_root_path
	)
	{
		$this->container			= $container;
		$this->config				= $config;
		$this->request				= $request;
		$this->language				= $language;
		$this->db					= $db;
		$this->template				= $template;
		$this->group_helper			= $group_helper = $this->container->get('group_helper');
		$this->phpbb_root_path		= $phpbb_root_path;
	}

	public function display_options()
	{
		$this->groupicons_group_selection();
		$this->language->add_lang('acp_groupicons', 'chris1278/groupicons');
		add_form_key('chris1278_groupicons_acp');
		$this->group_name = '';
		$this->group_name = $this->request->variable('groupicons_group_selection', '');
		$this->group_groupicons_value = $this->request->variable('group_icon', '');
		$this->group_groupicons_pixel = $this->request->variable('icon_max_pixel', '');
		$this->groupicons_group_overview();
		$this->groupicons_group_files();
		$errors = [];

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('chris1278_groupicons_acp'))
			{
				$errors[] = $this->language->lang('FORM_INVALID');
			}

			if (empty($errors))
			{
				$this->config->set('group_groupicons_switch', $this->request->variable('group_groupicons_switch', 0));

			}
		}

		if ($this->request->is_set_post('update_group_icon'))
		{
			$this->update_group_icon();
		}

		if ($this->request->is_set_post('delete_icon_entry'))
		{
			$this->group_name = $this->request->variable('delete_icon_entry', '');
			$this->delete_group_icon();
		}

		$s_errors = !empty($errors);

		$this->template->assign_vars([
			'S_ERROR'					=> $s_errors,
			'ERROR_MSG'					=> $s_errors ? implode('<br />', $errors) : '',
			'GROUP_ICONS_SWITCH'		=> $this->config['group_groupicons_switch'],
			'GROUPICONSURL'				=> $this->phpbb_root_path . 'images/groupicons/',
			'ACP_GROUPICONS_INFO'		=> sprintf($this->language->lang('ACP_GROUPICONS_EXPLAIN'), generate_board_url() . '/images/groupicons/'),
		]);
	}

	public function groupicons_group_files()
	{
		$dir_icons		= $this->phpbb_root_path . 'images/groupicons';

		$file_ary		= [];

		if (is_dir($dir_icons))
		{
			$scan_ary 	= preg_grep('~\.(jpeg|jpg|gif|png)$~', scandir($dir_icons));

			foreach ($scan_ary as $file)
			{
				$file_ary[] = $file;
			}
		}

		if (!empty($file_ary))
		{
			$this->template->assign_vars([
			'ICONS_DROPDWON'		=> true,
		]);
		}
		else
		{
			$this->template->assign_vars([
			'ICONS_DROPDWON'		=> false,
		]);
		}

		foreach ($file_ary as $row)
		{

			$this->template->assign_block_vars('groupicons_group_file', [
				'GROUPICON_FILE'					=> $row,
			]);
		}
	}

	public function groupicons_group_overview()
	{
		$sql = 'SELECT group_name, group_groupicons, group_groupicons_pixel
			FROM ' . GROUPS_TABLE . '
			ORDER BY group_name';
		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		if (count($rows) > 0)
		{
			foreach ($rows as $row)
			{
				if (empty($row['group_groupicons']))
				{
					$this->icon_file				= $this->language->lang('ACP_NO_FILE');
					$this->groupicon				= '<i class="groupicon_fa fa fa-times-circle" aria-hidden="true"></i>';
				}
				else
				{
					$this->icon_file				= '<b>' . generate_board_url() . '/images/groupicons/' . $row['group_groupicons'] . '</b>';
					$this->groupicon				= '<img src="' . $this->phpbb_root_path . 'images/groupicons/' . $row['group_groupicons'] . '" />';
				}

				if (empty($row['group_groupicons_pixel']))
				{
					$this->icon_pixel			= '-';
				}
				else
				{
					$this->icon_pixel			= $row['group_groupicons_pixel'] . 'px';
				}

				$this->template->assign_block_vars('group_icons_display', [
					'OVERVIEW_GROUPICON_GROUP_NAME_FORM'			=> $this->group_helper->get_name($row['group_name']),
					'OVERVIEW_GROUPICON_GROUP_ICON'					=> $this->icon_file,
					'OVERVIEW_GROUPICON_GROUP_NAME'					=> $row['group_name'],
					'OVERVIEW_GROUPICON_GROUP_ICON_PIXEL'			=> $this->icon_pixel,
					'OVERVIEW_GROUPICON_GROUP_ICON_PIC'				=> $this->groupicon,
				]);
			}
		}
	}

	public function groupicons_group_selection()
	{
		$sql = 'SELECT group_name
			FROM ' . GROUPS_TABLE . '
				ORDER BY group_name';
		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		if (count($rows) > 0)
		{
			foreach ($rows as $row)
			{
				$this->template->assign_block_vars('groupicons_group_selection', [
					'GROUPICON_GROUP_NAME_FORM'			=> $this->group_helper->get_name($row['group_name']),
					'GROUPICON_GROUP_NAME'				=> $row['group_name'],
				]);
			}
		}
	}

	public function update_group_icon()
	{
		$sql_update = [
			'group_groupicons'				=> $this->group_groupicons_value,
			'group_groupicons_pixel'		=> $this->group_groupicons_pixel,
		];

		$sql = 'UPDATE ' . GROUPS_TABLE . '
			SET ' . $this->db->sql_build_array('UPDATE', $sql_update) . '
			WHERE ' . $this->db->sql_in_set('group_name', $this->group_name);
		$this->db->sql_query($sql);
		$this->page_refresh();
	}

	public function delete_group_icon()
	{
		$sql_update = [
			'group_groupicons'				=> '',
			'group_groupicons_pixel'		=> '',
		];

		$sql = 'UPDATE ' . GROUPS_TABLE . '
			SET ' . $this->db->sql_build_array('UPDATE', $sql_update) . '
			WHERE ' . $this->db->sql_in_set('group_name', $this->group_name);
		$this->db->sql_query($sql);
		$this->page_refresh();
	}

	public function page_refresh()
	{
		meta_refresh(0, $this->u_action);
	}

	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
