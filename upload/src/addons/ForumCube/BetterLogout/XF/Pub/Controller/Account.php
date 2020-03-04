<?php

namespace ForumCube\BetterLogout\XF\Pub\Controller;
use XF\Mvc\Reply\View;
class Account extends XFCP_Account
{
	protected function preferencesSaveProcess(\XF\Entity\User $visitor)
	{
		$form = parent::preferencesSaveProcess($visitor);

		$input = $this->filter([
			'user' => [
				'logout_options' => 'uint',
			]
			
		]);
		/** @var \XF\Entity\UserProfile $userProfile */
		$form->basicEntitySave($visitor, $input['user']);
		return $form;
	}
 

	 
} 