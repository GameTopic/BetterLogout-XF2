<?php

namespace nick97\BetterLogout\XF\Pub\Controller;
class Account extends XFCP_Account
{
	protected function preferencesSaveProcess(\XF\Entity\User $visitor)
	{
		$form = parent::preferencesSaveProcess($visitor);

		$input = $this->filter([
			'user' => [
				'xm_bl_logout_type' => 'uint',
			]
		]);

		/** @var \XF\Entity\UserProfile $userProfile */
		$form->basicEntitySave($visitor, $input['user']);
		return $form;
	}
} 