<?php

namespace App\Policies;

use App\Models\TrackingLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrackingLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrackingLog  $log
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TrackingLog $log)
    {
        return true;
    }
}
