<?php

namespace Modules\Moonlaunch\Console\Commands;

use Illuminate\Console\Command;
use Modules\Admin\Services\AdminModule;
use Modules\Moonlaunch\Services\Launch;

class LaunchPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'launch:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates the permissions for the resources specified in the handle method by executing multiple related commands.';

    /**
     * Execute the console command.
     */
    public function handle(Launch $launch, AdminModule $adminModule)
    {
        foreach ($launch->getResources() as $item) {
            $this->call('moonshine-rbac:permissions', [
                'resourceName' => class_basename($item),
            ]);
        }

        foreach ($adminModule->getResources() as $item) {
            $this->call('moonshine-rbac:permissions', [
                'resourceName' => class_basename($item),
            ]);
        }

        // $this->call('moonshine-rbac:permissions', [
        //     'resourceName' => ''
        // ]);

        $this->call('moonshine-rbac:role', [
            'name' => 'Super Admin',
            '--all-permissions' => true,
        ]);
    }
}
