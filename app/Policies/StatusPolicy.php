<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Status;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Status $status)
    {
        return $user->id === $status->user_id;
    }
    public function staticu(User $user,Status $staticu)
    {
        $user_ids = $user->followings->pluck('id')->toArray();
        return $staticu->user_id !== $user->id && in_array($staticu->user_id,$user_ids);
    }

}
