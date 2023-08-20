<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use Mail;
use Session;

class PagesController extends Controller{
    public function getIndex(){
        $posts=Post::orderBy('created_at','desc')->limit(6)->get();
        return view('pages.welcome')->withPosts($posts);
    }

    public function getAbout(){
        $first="Waleed";
        $last="Saddique";
        $fullname=$first." ".$last;
        $email="waleed.saddique.developer@gmail.com";
        //below is the one method to pass the data from controller to view.
        // return view('pages.about')->with("fullname",$full);
        // return view('pages.about')->withFullname($full);  // we can also submit it like this 
        //but the letter after with must be in capital.



        // return view('pages.about')->withFullname($fullname)->withEmail($email);



        //passing data with an array

        $data=[];
        $data['fullname']=$fullname;
        $data['email']=$email;
        
        return view('pages.about')->withData($data);

        // We can also pass data through using compact function
        // return view('pages.about',compact("data"));

    }

    public function getContact(){
        return view('pages.contact');
    }
    public function postContact(Request $request){
        $this->validate($request,array(
            'email'=>'required|email',
            'subject'=>'min:3',
            'message'=>'min:10'
        ));

        //email sending code we need to modify gmail account for less secure password and .env file mail
        //settings to send emails.

        $data=array(
            'email'=>$request->email,
            'subject'=>$request->subject,
            'bodymessage'=>$request->message
        );
        Mail::send('emails.contact',$data,function($message) use ($data){
            $message->from($data['email']);
            $message->to('engr.waleed.saddique.developer@gmail.com');
            $message->subject($data['subject']);

        });
        Session::flash('success','Your email was sent successfully');
        return redirect('/');

    }
}
?>
