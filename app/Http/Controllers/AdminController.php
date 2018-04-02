<?php

namespace App\Http\Controllers;
use App\Admin;
use Exception;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  protected $admin;

  public function __construct(Admin $admin)
  {
    $this->admin = $admin;
  }

  public function register(Request $request)
  {
    $token=str_random(30);
    $admin = [
      "username"  => $request->username,
      "password"  => md5($request->password),
    ];
    $to=$request->email;
    try{
      $admin = $this->admin->create($admin);
      return response('Created',201);
    }
    catch(Exception $ex){
      return response($ex,400);
    }
  }

  public function all()
  {
    try{
      $admin = $this->admin->all();
      return $admin;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function find($id)
  {

    // $admin = $this->admin->where("id", "=", $id);
    try{
      $admin = $this->admin->find($id);
      return $admin;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }

  }
  public function delete($id)
  {

    try{
      $admin = $this->admin->where('id',$id)->delete();
      return response('Deleted',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }

  }
  public function login(Request $request)
  {
    $admin=[
      "username" => $request->username,
      "password" => md5($request->password),
    ];
    try
    {
      $check = $this->admin->where("username",$admin["username"])->where("password",$admin["password"])->get();
      if($check->isEmpty())
      {
        return ("Incorrect Username/Password");
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
  public function changepassword(Request $request,$id)
  {
    $oldpass = md5($request->oldpass);
    $newpass = md5($request->newpass);
    $confirm = md5($request->confirm);

    $admin = $this->admin->find($id);

    if($newpass == $confirm)
    {
      if($admin->password != $oldpass)
      {
        return ("Incorrect Password");
      }
      else {
        try{
          $admin->password = $newpass;
          $admin->save();
          return ("Password Changed");
        }
        catch(Exception $ex){
          return ("Failed!");
        }
      }
    }
    else {
      return ("Re-type password does not match");
    }
  }
  public function updateData(Request $request,$id)
  {
    $admin = $this->admin->find($id);

    $admin->username = $request->input('username');
    if($admin->password == $request->input('password'))
    {

    }
    else
    {
      $admin->password = md5($request->input('password'));
    }
    try{
      $admin->save();
      return response('Updated',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }
}
