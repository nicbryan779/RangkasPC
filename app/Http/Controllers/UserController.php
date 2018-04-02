<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Mailers\AppMailer;
use App\Users;
use Exception;
use Mail;

class UserController extends Controller
{
  protected $user;

  public function __construct(Users $user)
  {
    $this->user = $user;
  }

  public function register(Request $request, AppMailer $mailer)
  {
    $token=str_random(30);
    $user = [
      "name"  => $request->name,
      "email"  => $request->email,
      "password"  => md5($request->password),
      "birthdate"  => $request->birthdate,
      "phone"  => $request->phone,
      "address"  => $request->address,
      "city"  => $request->city,
      "state"  => $request->state,
      "zip"  => $request->zip,
      "token" => $token
    ];
    try{
      $user = $this->user->create($user);
      $mailer->sendEmailConfirmationTo($user);
      // flash('Please confirm your email address.');

      return response('Created',201);
    }
    catch(Exception $ex){
      return response($ex,400);
    }
  }

  public function all()
  {
    try{
      $user = $this->user->all();
      return $user;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function find($id)
  {

    // $user = $this->user->where("id", "=", $id);
    try{
      $user = $this->user->find($id);
      return response('Found',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }

  }
  public function delete($id)
  {

    try{
      $user = $this->user->where('id',$id)->delete();
      return response('Deleted',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }

  }
  public function updateData(Request $request,$id)
  {
    $user = $this->user->find($id);

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    if($user->password == $request->input('password'))
    {

    }
    else
    {
      $user->password = md5($request->input('password'));
    }
    $user->birthdate = $request->input('birthdate');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');
    $user->city = $request->input('city');
    $user->state = $request->input('state');
    $user->zip = $request->input('zip');
    try{
      $user->save();
      return response('Updated',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }
  public function login(Request $request)
  {
    $user=[
      "email" => $request->email,
      "password" => md5($request->password),
    ];
    try
    {
      $check = $this->user->where("email",$user["email"])->where("password",$user["password"])->get();
      if($check->isEmpty())
      {
        return ("Incorrect Email/Password");
      }
      else {
        return ("Login Successful");
      }
    }
    catch(Exception $ex)
    {
      return ("Login Failed!");
    }
  }
  public function confirmEmail($token,$id)
  {
      try{
        $user = $this->user->where('token',$token)->where('id',$id)->first();
        $user->status = "active";
        $user->save();
        return response('Email Verification Success');
      }
      catch(Exception $ex){
        return response($ex,400);
      }
  }
}
