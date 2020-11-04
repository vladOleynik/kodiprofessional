<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use App\Models\FormMessage;
use Illuminate\Support\Facades\Mail;

Class FormController extends Controller
{


    public function store(Request $request)
    {
        $data = $request->except('_token');
        FormMessage::create($data);
        Mail::to('kodiprofessional2016@gmail.com')->send(new FeedbackMail($request->email, $request->msg));
        return response()->json(['res' => 'success']);
    }
}
