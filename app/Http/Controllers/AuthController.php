<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class AuthController extends Controller
{
    protected $user;

    public function __construct(Users $user)
    {
      $this->user=$user;
    }
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password','birthdate','phone','address','city','state','zip');

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password'=> 'required',
            "birthdate"  => 'required',
            "phone"  => 'required',
            "address"  => 'required',
            "city"  => 'required',
            "state"  => 'required',
            "zip"  => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],422);
        }
        $user = [
          "name"  => $request->name,
          "email"  => $request->email,
          "password"  => Hash::make($request->password),
          "birthdate"  => $request->birthdate,
          "phone"  => $request->phone,
          "address"  => $request->address,
          "city"  => $request->city,
          "state"  => $request->state,
          "zip"  => $request->zip
        ];
        $user = $this->user->create($user);
        $name = $request->name;
        $email = $request->email;
        $verification_code = str_random(30);
        DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        Mail::send('confirm', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from("rangkaspc@gmail.com","RangkasPC.me");
                $mail->to($email, $name);
                $mail->subject($subject);
            });
        return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);
    }
    public function verifyUser($verification_code)
    {
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();
        if(!is_null($check)){
          $user = $this->user->where('id',$check->id)->first();
          if(!is_null($user))
          {
            if($user->is_verified == 1){
                return response()->json(['success'=> false, 'message'=> 'You are already verified! Please login!']);
            }
            $user->is_verified = 1;
            $user->save();
            DB::table('user_verifications')->where('token',$verification_code)->delete();
            return response()->json(['success'=> true, 'message'=> 'You have successfully verified your email']);
        }
        return response()->json(['success'=> false, 'message'=> 'Oops! Your verification code is wrong']);
      }
    }
    public function login(Request $request)
    {
      $credentials = $request->only('email','password');

      $rules = [
        'email' => 'required|email',
        'password' => 'required',
      ];

      $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],400);
        }

        $credentials['is_verified'] = 1;
          try {
              if (! $token = JWTAuth::attempt($credentials)) {
                  return response()->json(['success'=> false,  'message'=> 'Incorrect username/password'],401);
              }
          } catch (JWTException $ex) {
            return response()->json(['success'=> false, 'message'=> 'Failed to login! Please try again later!'],500);
          }
          return response()->json(['success' => true, 'data'=> [ 'token' => $token]],200);
    }
    public function logout(Request $request) {
        // $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate();
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."],200);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }
    public function recover(Request $request)
    {
        $user = $this->user->where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }
        $email = $user->email;
        $name = $user->name;
        $subject = "Reset Password";
        $verification_code = str_random(30);
        try {
          Mail::send('reset', ['verification_code' => $verification_code],
              function($mail) use ($email, $name, $subject){
                  $mail->from("rangkaspc@gmail.com","RangkasPC.me");
                  $mail->to($email, $name);
                  $mail->subject($subject);
              });
          DB::table('password_resets')->insert(['email'=>$user->email,'token'=>$verification_code]);
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
        return response()->json([
            'success' => true, 'data'=> ['message'=> 'A reset email has been sent! Please check your email.']
        ]);
    }
    public function resetpass(Request $request, $verification_code)
    {
        $check = DB::table("password_resets")->where('token', $verification_code)->first();
        if(!is_null($check)){
            $user = $this->user->where('email',$check->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            DB::table('password_resets')->where('token',$verification_code)->delete();
            return response()->json(['success'=> true, 'message'=> 'You have successfully created a new password']);
        }
        return response()->json(['success'=> false, 'message'=> 'Oops! Your verification code is wrong. Please request for password change']);
    }
    public function EditProfile(Request $request)
    {
      try{
      $user = auth()->user();
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->birthdate = $request->input('birthdate');
      $user->phone = $request->input('phone');
      $user->address = $request->input('address');
      $user->city = $request->input('city');
      $user->state = $request->input('state');
      $user->zip = $request->input('zip');

        $user->save();
        return response()->json(['success'=>true, 'message'=> 'Changes saved']);
      }
      catch(Exception $ex){
        return response()->json(['success'=>false, 'message'=> $ex],400);
      }
    }
}
