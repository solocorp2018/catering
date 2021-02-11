<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Validator;
use App\Models\VerifyOtp;
use App\Models\User;
use App\Services\TextLocalSmsGateway;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function triggerOtp(Request $request) {

        $validator = Validator::make($request->all(),['contactNumber'=>'required|unique:users,contact_number']);
        
        if($validator->fails()) {
          return response()->json(['status'=>0,'message'=>'Mobile Number has been already registered with us. Please do Login !']);
        }

        $mobileNumber = $request->contactNumber;

        $otp = $this->generateNumericOTP();

        VerifyOtp::updateOrCreate(['mobile'=>$mobileNumber],['mobile'=>$mobileNumber,'otp'=>$otp]);

        $message = $otp." is the OTP for your ".env('APP_NAME')." registration.";
        TextLocalSmsGateway::sendSms($mobileNumber,$message);

        return response(['status'=>1,'message'=>'OTP sent successfully !']);
    }

    public function validateOtp(Request $request) {
        $this->validate($request,[
            'contactNumber'=>'required|exists:verify_otps,mobile',
            'otp' => 'required|min:4|exists:verify_otps,otp,mobile,'.$request->contactNumber
        ]);

        $mobileNumber = $request->contactNumber;

        return response(['message'=>'OTP verified successfully !']);
    }

    public function generateNumericOTP($n = 4) {

        $generator = "1357902468";

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }

        return $result;
    }

    public function customerLogin(Request $request) {
      
      $contact_number = $request->contact_number;

      $user = User::where('contact_number', $contact_number)->first();

      if(!empty($user)) {

        Auth::loginUsingId($user->id);

        return redirect()->intended('/');
      } else {

        session()->flash('Invalid credentials for login');
        return redirect()->intended('/');
      }

    }

    public function login(Request $request) {

      $credentials = array(
        'email' => $request->email,
        'password' => $request->password
      );

      if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');


      } else {
        return redirect()->intended('/');
      }

    }



}
