<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the payment can view any models.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Payment $payment)
    {
        return $this->own(Auth::user(), $payment);
    }

    /**
     * Determine whether the payment can view the model.
     *
     * @param  \App\Models\Payment  $payment
     * @param  \App\Models\Payment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Payment $model)
    {
        return $this->own($user, $model);
    }

    /**
     * Determine whether the payment can create models.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Payment $payment)
    {
        return Auth::user()->hasRole('admin');
    }

    /**
     * Determine whether the payment can update the model.
     *
     * @param  \App\Models\Payment  $payment
     * @param  \App\Models\Payment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Payment $model)
    {
        return false;
    }

    /**
     * Determine whether the payment can delete the model.
     *
     * @param  \App\Models\Payment  $payment
     * @param  \App\Models\Payment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Payment $model)
    {
        return $this->own($user, $model);
    }
     /**
     * Determine whether the payment can restore the model.
     *
     * @param  \App\Models\Payment  $payment
     * @param  \App\Models\Payment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Payment $model)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the payment can permanently delete the model.
     *
     * @param  \App\Models\Payment  $payment
     * @param  \App\Models\Payment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Payment $payment, Payment $model)
    {
        return $payment->hasRole('admin');
    }
    /**
     * Determine is payment admin or own model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function own(User $user, Payment $model)
    {
        if ($user->hasRole('admin')) {
            return true;
        } else if ($user->id === $model->user_id) {
            return true;
        }
        return false;
    }

}
