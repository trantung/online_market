<?php

class ApiPasswordController extends ApiController {

	public function resetpassword()
	{
		$input = Input::all();
		$user = User::where('email', $input['email'])->first();
		if(is_null($user)){
			throw new Prototype\Exceptions\EmailErrorException();
		}
		$user->update(['password' => Hash::make(DEFAULT_PASSWORD)]);
		$mailData = [];
		Mail::send('emails.changepass', $mailData, function($message) use ($user, $input) {
			$message->to($input['email'], 'Hello'.$user->name)->subject('Authorize password');
		});
		if(Mail::failures()) {
			throw new Prototype\Exceptions\EmailErrorException();
		}
		return Common::returnData(200, SUCCESS);
	}

}
