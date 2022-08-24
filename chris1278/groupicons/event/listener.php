<?php
/**
*
* @package phpBB Extension - Checkbox when registering for consent to permanent data storage
* @copyright (c) 2022 Chris1278
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace chris1278\groupicons\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	protected $container;
	protected $request;
	protected $config;
	protected $template;
	protected $auth;
	protected $db;
	protected $user;
	protected $php_ext;
	protected $phpbb_root_path;

	public function __construct(
		\Symfony\Component\DependencyInjection\ContainerInterface $container,
		\phpbb\request\request_interface $request,
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\auth\auth $auth,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\user $user,
		$php_ext,
		$phpbb_root_path
	)
	{
		$this->container		= $container;
		$this->request			= $request;
		$this->config			= $config;
		$this->template			= $template;
		$this->auth				= $auth;
		$this->db				= $db;
		$this->user				= $user;
		$this->php_ext			= $php_ext;
		$this->phpbb_root_path	= $phpbb_root_path;
		$this->group_helper		= $group_helper = $this->container->get('group_helper');

	}

	public static function getSubscribedEvents()
	{
		return [
			'core.page_header'			=> 'groupicons_load',
		];
	}

	public function groupicons_load()
	{
		$order_legend = ($this->config['legend_sort_groupname']) ? 'group_name' : 'group_legend';

		if ($this->auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
		{
			$sql = 'SELECT group_id, group_name, group_colour, group_type, group_legend, group_groupicons, group_groupicons_pixel
				FROM ' . GROUPS_TABLE . '
				WHERE group_legend > 0
				ORDER BY ' . $order_legend . ' ASC';
		}
		else
		{
			$sql = 'SELECT g.group_id, g.group_name, g.group_colour, g.group_type, g.group_legend, group_groupicons, group_groupicons_pixel
				FROM ' . GROUPS_TABLE . ' g
				LEFT JOIN ' . USER_GROUP_TABLE . ' ug
					ON (
						g.group_id = ug.group_id
						AND ug.user_id = ' . $this->user->data['user_id'] . '
						AND ug.user_pending = 0
					)
				WHERE g.group_legend > 0
					AND (g.group_type <> ' . GROUP_HIDDEN . ' OR ug.user_id = ' . $this->user->data['user_id'] . ')
				ORDER BY g.' . $order_legend . ' ASC';
		}
		$result = $this->db->sql_query($sql);

		$legend = '';

		while ($row = $this->db->sql_fetchrow($result))
		{
			if ($row['group_name'] == 'BOTS')
			{
				$legend .= (($legend != '') ? ', ' : '') . '<span style="color:#' . $row['group_colour'] . '">' . $this->user->lang['G_BOTS'] . '</span>';
			}
			else
			{
				if ($row['group_groupicons'] == '' || $this->config['group_groupicons_switch'] == 0)
				{
					$legend .= (($legend != '') ? ', ' : '')  . '<a style="color:#' . $row['group_colour'] . '" href="' . append_sid("{$this->phpbb_root_path}memberlist.$this->php_ext", 'mode=group&amp;g=' . $row['group_id']) . '">' . $this->group_helper->get_name($row['group_name']) . '</a>';
				}
				else
				{
					$file = $this->phpbb_root_path . 'images/groupicons/' . $row['group_groupicons'];

					if (file_exists($file))
					{
						if ($row['group_groupicons_pixel'] == '')
						{
							$max_pixel	= '16';
						}
						else
						{
							$max_pixel	=	$row['group_groupicons_pixel'];
						}

						$icon_if_exist	= '<img style="max-height: '. $max_pixel . 'px;" class="groupicons_size" src="' . $this->phpbb_root_path . 'images/groupicons/' . $row['group_groupicons'] . '" />';
					}
					else
					{
						if ($this->auth->acl_get('a_'))
						{

							$icon_if_exist	= '<i style="color: #ff0000; font-size: 16px; max-height: 16px;" class="groupicon_fa fa fa-times-circle" aria-hidden="true"></i> ';
						}
						else
						{
							$icon_if_exist	= '';
						}
					}

					$legend .= (($legend != '') ? ', ' : '')  . '<a style="color:#' . $row['group_colour'] . '" href="' . append_sid("{$this->phpbb_root_path}memberlist.$this->php_ext", 'mode=group&amp;g=' . $row['group_id']) . '">' . $icon_if_exist .  $this->group_helper->get_name($row['group_name']) . '</a>';
				}
			}
		}
		$this->db->sql_freeresult($result);

		$this->template->assign_vars([
			'LEGEND'		=> false,
			'LEGEND'		=> $legend,
		]);
	}
}
