<?php  namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller {
    public function postNewTrigger(Request $request)
    {
        Auth::user()->addTriggerAddress($request->get('address'));

        return Redirect::back()->with('success', 'Successfully added email trigger.');
    }
} 