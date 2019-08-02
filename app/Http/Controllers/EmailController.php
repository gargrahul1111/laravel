<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMailable;
use Mail;
use App\Jobs\SendEmailJob;

class EmailController extends Controller
{
    //
	public function sendEmail()
	{
		$emailJob = (new SendEmailJob('rahul'))->delay(\Carbon\Carbon::now()->addSeconds(3));
		dispatch($emailJob);

		echo 'email sent';
		/*Mail::to('rgarg@practicebuilders.com')->send(new SendMailable('rahul'));
		echo 'email sent';*/
	}
}
