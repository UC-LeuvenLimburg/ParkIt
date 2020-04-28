<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::id() == $this->input('user_id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lease_id' => 'required|integer|min:1|exists:App\Models\Lease,id',
            'user_id' => 'required|integer|min:1|exists:App\Models\User,id',
            'payment_method' => "required",
            'user_agreement' => "required"
        ];
    }
}
