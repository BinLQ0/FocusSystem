<?php

namespace App\Observers;

class RoleObserver
{
    /**
     * Handle the Moved "saved" event.
     *
     * @return void
     */
    public function saved($event)
    {
        $event->syncPermissions([]);
        $permissions = request('permissions');

        foreach ($permissions as $permission) {
            $event->givePermissionTo($permission);
        }
    }
}
