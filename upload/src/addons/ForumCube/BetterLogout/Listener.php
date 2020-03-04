<?php

namespace ForumCube\BetterLogout;

/**
 * Class Listener
 * 
 * This class declares code event listeners for the add-on.
 * 
 * @package ForumCube\BetterLogout
 */
class Listener
{
	/**
	 * Allows direct modification of the Entity structure.

	 * Event hint: Fully qualified name of the root class that was called.

	 * @param  \XF\Mvc\Entity\Manager $em               Entity Manager object.
	 * @param  \XF\Mvc\Entity\Structure &$structure     Entity Structure object.
	 */
	public static function xfUser(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
	{
	}
}