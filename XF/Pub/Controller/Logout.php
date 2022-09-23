<?php


namespace nick97\BetterLogout\XF\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\AbstractReply;

class Logout extends XFCP_Logout
{
	public function actionIndex()
	{
		/** @var \nick97\BetterLogout\XF\Entity\User $visitor */
		$visitor = \XF::visitor();
		if ($visitor->user_id && $visitor->hasPermission('general', 'xm_bl_use'))
		{
			if ($visitor->xm_bl_logout_type == 0 && !$this->isPost())
			{
				return $this->view('XF:Logout', 'XMBL_logout');
			}
			else
			{
				$logoutOption = $visitor->xm_bl_logout_type;
				$remember = 0;
				if ($logoutOption == 0)
				{
					$logoutOption = $this->filter('logout_options', 'uint');
					$remember = $this->filter('dont_ask_again', 'bool');
					if ($logoutOption != 2)
					{
						$logoutOption = 1;
					}
				}

				if ($logoutOption == 2)
				{
					if ($remember)
					{
						$visitor->xm_bl_logout_type = $logoutOption;
					}

					$visitor->Profile->password_date = \XF::$time;
					$visitor->addCascadedSave($visitor->Profile);
					$visitor->save();

					/** @var \XF\ControllerPlugin\Login $loginPlugin */
					$loginPlugin = $this->plugin('XF:Login');
					$loginPlugin->logoutVisitor();

					return $this->redirect($this->buildLink('index'), \XF::phrase('xm_bl_you_have_been_logged_out_on_all_devices'));
				}
				else if ($logoutOption == 1)
				{
					if ($remember)
					{
						$visitor->xm_bl_logout_type = $logoutOption;
						$visitor->save();
					}

					/** @var \XF\ControllerPlugin\Login $loginPlugin */
					$loginPlugin = $this->plugin('XF:Login');
					$loginPlugin->logoutVisitor();

					return $this->redirect($this->buildLink('index'), \XF::phrase('xm_bl_you_have_been_logged_out_on_this_device'));
				}
			}
		}

		return parent::actionIndex();
	}

	public function updateSessionActivity($action, ParameterBag $params, AbstractReply &$reply)
	{
	}

	public function assertNotRejected($action)
	{
	}

	public function assertNotDisabled($action)
	{
	}

	public function assertViewingPermissions($action)
	{
	}

	public function assertCorrectVersion($action)
	{
	}

	public function assertBoardActive($action)
	{
	}

	public function assertTfaRequirement($action)
	{
	}
}