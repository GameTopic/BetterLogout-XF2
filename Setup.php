<?php

namespace nick97\BetterLogout;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function installStep1()
	{
		$schemaManager = $this->schemaManager();
		$schemaManager->alterTable('xf_user', function (\XF\Db\Schema\Alter $table) {
			$table->addColumn('xm_bl_logout_type', 'int')->setDefault(0);
		});
	}

	/**
	 * Uninstall Functions
	 */
	public function uninstallStep1()
	{
		$schemaManager = $this->schemaManager();
		$schemaManager->alterTable('xf_user', function (\XF\Db\Schema\Alter $table) {
			$table->dropColumns(['xm_bl_logout_type']);
		});
	}

	public function upgrade2020091Step1()
	{
		$schemaManager = $this->schemaManager();
		$schemaManager->alterTable('xf_user', function (\XF\Db\Schema\Alter $table) {
			$table->renameColumn('logout_options', 'xm_bl_logout_type');
		});
	}
}