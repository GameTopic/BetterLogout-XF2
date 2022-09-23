<?php

namespace nick97\BetterLogout\Listener;

use XF\Mvc\Entity\Entity;

class EntityStructure
{
	/**
	 * Allows direct modification of the Entity structure.
	 * Event hint: Fully qualified name of the root class that was called.
	 * @param \XF\Mvc\Entity\Manager $em Entity Manager object.
	 * @param \XF\Mvc\Entity\Structure &$structure Entity Structure object.
	 */
	public static function xfUser(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
	{
		$structure->columns['xm_bl_logout_type'] = ['type' => Entity::UINT, 'default' => 0];
	}
}
