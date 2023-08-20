<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Hash;
use Session;
use Carbon\Carbon;

class CustomAuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function registration(){
        return view('auth.registration');
    }
    public function registerUser(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $res=$user->save();
        if($res){
            return back()->with('success','You have registered Successfully');

        }
        else{
            return back()->with('fail','Something wrong');

        }
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);
        $user=User::where('email','=',$request->email)->first();
        if($user && $user->email_verified_at!= null){
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('loginId',$user->id);
                return redirect('posts');
            }
            else
            {
                return back()->with('fail','Password not match');
            }
        }
        else
        {
            return back()->with('fail','This email is not registered.');
        }
        return "login User";
    }
    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
        }
        // $posts=Post::orderBy('created_at','desc')->limit(4)->get();
        // return view('pages.welcome')->withPosts($posts);
        return redirect('/');
    }
    public function showForgetForm(){
        return view('auth.forgot');
    }
    public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);
        $token= \Str::random(64);

        \DB::table('password_reset_tokens')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
        $action_link=route('reset.password.form',['token'=>$token,'email'=>$request->email]);

        $body="We recieved the request to reset your password for Blog Application your account associated with ".$request->email."
        You can reset your password by clicking the link below.";

        \Mail::send('emails.email-forgot',['action_link'=>$action_link,'body'=>$body],function($message) use ($request){
            $message->from('noreply@example.com','Blog Application');
            $message->to($request->email,'Your Name')
                    ->subject('Reset Password');
        });
        
        return back()->with('success','We have email your password reset link');
    }
    public function showResetForm(Request $request, $token=null){

        return view('auth.reset')->with(['token'=>$token,'email'=>$request->email]);

    }
    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required'
        ]);
        $check_token= \DB::table('password_reset_tokens')->where([
            'email'=>$request->email,
            'token'=>$request->token
        ])->first();
        if(!$check_token){
            return back()->withInput()->with('fail','Invalid token');
        }
        else{
            User::where('email',$request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_reset_tokens')->where([
                'email'=>$request->email
            ])->delete();
        }
        return redirect()->route('login')->with('info','Your Password has been changed! You can login with new Password.')->with('verifiedEmail',$request->email);
    }

}