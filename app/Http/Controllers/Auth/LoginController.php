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

        $message = $otp.", is Otp for MRGrandson Caters . This is one time valid OTP.";
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

      $validator = Validator::make($request->all(),['contact_number'=>'required|exists:users,contact_number,status,1'],['contact_number'=>'Mobile Number'],['contact_number.exists'=>"Mobile Number doesn't match with our records !."]);

      if($validator->fails()) {
            $errors = $validator->errors();

            $error_view = view('website.common.validator-error',compact('errors'))->render();

            return sendError(['_error_view'=>$error_view],"Mobile Number Doesn't match with our records !",404);
        }

      $contact_number = $request->contact_number;

      $user = User::where('contact_number', $contact_number)->first();

      Auth::loginUsingId($user->id);

      return response(['message'=>'Login successfull !']);
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
        return redirect()->intended('/login');
      }

    }



}
