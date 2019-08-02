<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;
use App\ContactUS;
use DB;

class ContactUSController extends Controller
{
	/**
     * Display a listing of the contact list.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
  {
    $contacts = ContactUS::paginate(10);

    return view('contacts.index',compact('contacts',$contacts));
  }

  public function destroy($id){

    DB::table("contactus")->delete($id);
    return response()->json(['success'=>"Product Deleted successfully.", 'tr'=>'tr_'.$id]);
  }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function contactUS()
    {
    	return view('contactUS');
    }
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function contactUSPost(Request $request)
   {

   	$this->validate($request, [
   		'name' => 'required',
   		'email' => 'required|email',
   		'message' => 'required'
   	]);

   	ContactUS::create($request->all());
   	$contact = array(
       'name' => $request->get('name'),
       'email' => $request->get('email'),
       'user_message' => $request->get('message')
     );

   	Mail::to("rgarg@practicebuilders.com")->send(new ContactMail($contact));

   /*	Mail::send('email',
       array(
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'user_message' => $request->get('message')
       ), function($message)
   {
       $message->from('saquib.gt@gmail.com');
       $message->to('saquib.rizwan@cloudways.com', 'Admin')->subject('Cloudways Feedback');
     });*/

     return back()->with('success', 'Thanks for contacting us!');
   }
 }
