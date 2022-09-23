<?php

namespace nick97\BetterLogout\nick97\recentlyuseddevices\Pub\Controller;

use XF\Mvc\ParameterBag;

class Device extends XFCP_Device
{
	public function actionLogout(ParameterBag $params)
	{
		$visitor =  \XF::visitor();

		/** @var \nick97\recentlyuseddevices\Entity\Device $device */
		$device = $this->finder('nick97\recentlyuseddevices:Device')
			->where('user_id', $visitor->user_id)
			->where('device_id', '=', $params->device_id)
			->where('status', '=', 0) // which is currently logged in
			->fetchOne();

		if ($this->isPost())
		{
			$logoutType = $this->filter('logout_options', 'uint');
			if ($logoutType == 2)
			{
				/** @var \nick97\recentlyuseddevices\Repository\Device $deviceRepo */
				$deviceRepo = $this->repository('nick97\recentlyuseddevices:Device');
				$deviceRepo->logoutUserDevices($visitor->user_id);

				return $this->redirect($this->buildLink('account/devices'));
			}

			return parent::actionLogout($params);
		}

		$viewParams = ['device' => $device];
		return $this->view('nick97\recentlyuseddevices:Logout', 'XMBL_logout_device', $viewParams);
	}
}