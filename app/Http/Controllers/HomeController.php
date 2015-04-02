<?php namespace App\Http\Controllers;

use App\EmailMessage;
use App\Services\Inbox\InboxCommunicator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
    /**
     * @var InboxCommunicator
     */
    private $inbox;

    /**
     * Create a new controller instance.
     *
     * @param InboxCommunicator $inbox
     * @return \App\Http\Controllers\HomeController
     */
	public function __construct(InboxCommunicator $inbox)
	{
        $this->inbox = $inbox;
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $emails = Auth::user()->emailMessages;
        $user = Auth::user();
		return view('home', compact('emails', 'user'));
	}

}
