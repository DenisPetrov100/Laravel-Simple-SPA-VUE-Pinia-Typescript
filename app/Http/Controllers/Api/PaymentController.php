<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\PaymentResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $userId = request("id", false);

        if ($userId) {
            return $this->showByUserId($userId);
        } else {
            if(Auth::user()->can('viewAllPayments', Auth::user())){
                return PaymentResource::collection(Payment::all());
            } else {
                return PaymentResource::collection(Auth::user()->payments);
            }
        }
    }
    public function showByUserId($user_id)
    {
        $user = User::findOrFail($user_id);
        abort_if(Auth::user()->cant('viewSelf', $user, Auth::user()), 403);
        return PaymentResource::collection($user->payments);
    }

    public function store(PaymentRequest $request)
    {
        $payment = Payment::create($request->validated());
        $payment->user()->associate(Auth::user()->id)->save();

        return new PaymentResource($payment);
    }

    public function show(Payment $payment)
    {
        abort_if(Auth::user()->cant('view', $payment, Auth::user()), 403);
        return new PaymentResource($payment);
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        abort_if(Auth::user()->cant('update', $payment, Auth::user()), 403);
        $payment->update($request->validated());
        return new PaymentResource($payment);
    }

    public function destroy(Payment $payment)
    {
        abort_if(Auth::user()->cant('delete', $payment, Auth::user()), 403);
        $payment->delete();
        return response()->noContent();
    }
}
