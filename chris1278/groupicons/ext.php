<?php
/**
*
* @package phpBB EExtension bridge for “Statistics Block”
* @copyright (c) 2022 (Christian-Esch.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace chris1278\groupicons;

class ext extends \phpbb\extension\base
{
	public function enable_step($old_state)
	{
		global $phpbb_container, $phpbb_root_path;

		$this->filesystem	=	$phpbb_container->get('filesystem');

		$this->root_path	=	$phpbb_root_path;

		if ($old_state === false)
		{
			if (!$this->filesystem->exists($this->root_path . 'images/groupicons'))
			{
				$this->filesystem->mkdir($this->root_path . 'images/groupicons');
			}
		}

		return parent::enable_step($old_state);
	}
}
