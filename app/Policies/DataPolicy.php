<?php

namespace App\Policies;

use App\Models\DataModel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\DataModel $dataModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DataModel $dataModel)
    {
        return $user->id === $dataModel->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\DataModel $dataModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
//    public function delete(User $user, DataModel $dataModel)
//    {
//        return $user->id === $dataModel->user_id;
//    }


}
