<?php


namespace App\Http\Controllers;


use App\Mail\NoteMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function welcome(){
        Mail::to('vadim.haliullin02@gmail.com')->send(new NoteMail());
    }
}
