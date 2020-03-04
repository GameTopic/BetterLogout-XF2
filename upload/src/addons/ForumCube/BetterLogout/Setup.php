<?php

namespace ForumCube\BetterLogout;

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
         $schemaManager = $this->db()->getSchemaManager(); 
            $schemaManager->alterTable('xf_user', function(\XF\Db\Schema\Alter $table) {
                $table->addColumn('logout_options', 'int')->setDefault(0);
            });
    } 
    
    /**
     * Uninstall Functions
     */
    public function uninstallStep1()
    {
        $schemaManager = $this->db()->getSchemaManager();
        $schemaManager->alterTable('xf_user', function(\XF\Db\Schema\Alter $table) {
            $table->dropColumns(['logout_options']);
        });
    }
}