<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\NewOrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'from_address' => 'required|string',
            'to_address' => 'required|string',
            'distance' => 'required|numeric',
            'cost' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $order = Order::create($validator->validated());

        // Отправляем письмо администратору
        // Убедитесь, что в .env указан MAIL_FROM_ADDRESS
        try {
            Mail::to(config('mail.from.address'))->send(new NewOrderMail($order));
        } catch (\Exception $e) {
            // Можно добавить логирование ошибки, если письмо не отправилось
            return response()->json(['success' => false, 'message' => 'Не удалось отправить заявку. Пожалуйста, попробуйте позже.']);
        }

        return response()->json(['success' => true, 'message' => 'Ваша заявка успешно отправлена!']);
    }
}