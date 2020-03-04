<?php


namespace ForumCube\BetterLogout\XF\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\AbstractReply;

class Logout extends XFCP_Logout
{
	public function actionIndex()
	{
		$visitor = \XF::visitor();
		$userId = $visitor->user_id;
		if (!$userId)
		{
			return $this->redirect($this->buildLink('index'));
		}
		if ($visitor['logout_options'] == 0 && !$this->isPost()) {
			return $this->view('XF:Logout', 'XMBL_logout');
		}
		else
		{
			$logoutOption = $visitor->logout_options;
			$remember = 0;
			if ($logoutOption == 0) 
			{
				$logoutOption = $this->filter('logout_options', 'uint');
				$remember = $this->filter('dont_ask_again', 'bool');
				if ($logoutOption != 2) {
					$logoutOption = 1;
				}
			}
			if ($logoutOption == 2) 
			{
				if($remember)
				{
					$visitor->logout_options = $logoutOption;
					$visitor->Profile->password_date = \XF::$time;
					$visitor->save();
				}
				$loginPlugin = $this->plugin('XF:Login');
				$loginPlugin->logoutVisitor();
				return $this->redirect($this->buildLink('index'), \XF::phrase('xm_bl_you_have_been_logged_out_on_all_devices'));
			}
			else if ($logoutOption == 1) 
			{
				if($remember)
				{
					$visitor->logout_options = $logoutOption;
					$visitor->save();
				}
				$loginPlugin = $this->plugin('XF:Login');
				$loginPlugin->logoutVisitor();

				return $this->redirect($this->buildLink('index'), \XF::phrase('xm_bl_you_have_been_logged_out_on_this_device'));
			}
		}
	}

	public function updateSessionActivity($action, ParameterBag $params, AbstractReply &$reply) {}

	public function assertNotRejected($action) {}
	public function assertNotDisabled($action) {}
	public function assertViewingPermissions($action) {}
	public function assertCorrectVersion($action) {}
	public function assertBoardActive($action) {}
	public function assertTfaRequirement($action) {}
}