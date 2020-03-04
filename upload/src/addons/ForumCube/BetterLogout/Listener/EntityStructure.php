<?php

namespace ForumCube\BetterLogout\Listener;

use XF\Mvc\Entity\Entity;

class EntityStructure
{
    public static function xfUser(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
    {
        $structure->columns['logout_options'] = ['type' => Entity::UINT, 'default' => 0];
    }

}