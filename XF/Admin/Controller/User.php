<?php

namespace nick97\BetterLogout\XF\Admin\Controller;

use XF\Mvc\ParameterBag;

class User extends XFCP_User
{
	public function actionLogout(ParameterBag $params)
	{
		$user = $this->assertUserExists($params->user_id);
		$this->assertCanEditUser($user);
		$this->assertAdminPermission('xm_bl_logout');

		if ($this->isPost())
		{
			$user->Profile->password_date = \XF::$time;
			$user->addCascadedSave($user->Profile);
			$user->save();

			$redirect = $this->getDynamicRedirectIfNot(
				$this->buildLink('users/edit', $user),
				$this->buildLink('users/list')
			);

			return $this->redirect($redirect);
		}
		else
		{
			$viewParams = [
				'user' => $user
			];
			return $this->view('XF:User\Logout', 'XMBL_logout', $viewParams);
		}
	}
}
