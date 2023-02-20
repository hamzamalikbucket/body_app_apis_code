<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\GeneralInfo;
use App\Models\SiteInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function sendTestingEmail(Request $req) {
        sendMail($req->email,'Order received','Your order received successfully, Order will be delivered on your address');
        return response()->json([
            'success' => true,
        ]);
    }
    
    public function testFile(Request $req) {
         $validate = Validator::make($req->all(),[
                'file' => 'required|mimes:png,jpg,svg,jpeg'
            ]);
            if($validate->fails()){
                return response()->json([
                'success' => false,
                'name'=> 'file not found'
                ]);
            }
        $file = $req->file('file');
        $file->move(public_path('images/hireQ'), $file->getClientOriginalName());
        return response()->json([
            'success' => true,
            'name'=> 'File Name: '.$file->getClientOriginalName()
        ]);
    }
    
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|string',
            'dob' => 'required|date',
            'city' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'role' => 'required|in:admin,user'
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()->first()
            ]);
        }

        $data = $request->all();
        $data['status'] = 'inactive';
        $data['otp'] =  mt_rand(100000,999999);
        $data['password'] = Hash::make($request->password);

        $isExist = User::where('email',$request->email)->first();
        if($isExist){

            if($isExist->status == 'active'){
                return response()->json([
                    'success' => false,
                    'message' => 'User Already Exist with this Email'
                ]);
            }

             $isExist->update($data);
             $user = $isExist;
        }else{
            $user = User::create($data);
        }

        $token = $user->createToken('MyApp')->accessToken;

        //SEND OTP MAIL
        $template = view('admin.email.otp',['otp'=> $user->otp])->render();
        sendMail($user->email,'OTP EMAIL',$template);

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function confirmOtp(Request $request)
    {
        $message = '';
        $success = false;

        $validate = Validator::make($request->all(),[
            'user_id' => 'integer|required|exists:users,id',
            'otp' => 'integer|required'
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()->first()
            ]);
        }

        $user = User::findorfail($request->user_id);

        if($user->status == 'active'){
            return response()->json([
                'success' => false,
                'message' => 'User Already Active'
            ]);
        }

        if($user->otp == $request->otp){
            $user->status = 'active';
            $user->save();
            $message = 'User Active Successfully!';
            $success = true;
        }else{
            $message = 'Invalid OTP';
            $success = false;
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function login(Request $request)
    {

        $message = '';
        $success = false;

        $validate = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
            'device_id' => 'required|string'
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()->first()
            ]);
        }

        $user = User::where('email',$request->email)->first();

        if($user){

            if($user->status == 'inactive'){

                $success = false;
                $message = 'Email is not verified';

            }elseif($user->status == 'active'){

                $verifyPassword = Hash::check($request->password,$user->password);

                if($verifyPassword){

                    if(empty($user->device_id)){
                        $user->device_id = $request->device_id;
                        $user->save();
                    }elseif($user->device_id !== $request->device_id){
                        return response()->json([
                            'success' => false,
                            'message' => 'Please Login with your Registered Device'
                        ]);
                    }

                    Auth::login($user);
                    $token = $user->createToken('MyApp')->accessToken;
                    return response()->json([
                        'success' => true,
                        'message' => 'Login Successfully!',
                        'token' => $token,
                        'user' => $user
                    ]);
                }else{
                    $success = false;
                    $message = 'Invalid Password';
                }

            }

        }else{
            $success = false;
            $message = 'Invalid Email';
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ]);

    }

    public function forgotPassword(Request $request)
    {
        $message = '';
        $success = false;

        $validate = Validator::make($request->all(),[
            'email' => 'string|required|email'
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()->first()
            ]);
        }

        $user = User::where('email',$request->email)->first();
        if($user){
            $code = Crypt::encrypt($user->id);
            // $decrypted = Crypt::decrypt($code);
            $link = url('/reset-password').'/'.$code;
            $template = view('admin.email.forgot-password',compact('link'));
            sendMail($user->email,'Forgot Password Email',$template);
            $success = true;
            $message = 'Forgot Password Email Send Successfully!';
        }else{
            $success = false;
            $message = 'Email Not Found';
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }


    public function contactUs(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'mobile' => 'required|string'
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()->first()
            ]);
        }
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $contactUs = ContactUs::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Message Send Successfully',
            'contactUs' => $contactUs
        ]);
    }

    public function changePassword(Request $request){
        $validate = Validator::make($request->all(),[
            'user_id' => 'integer|required|exists:users,id',
            'new_password' => 'string|required',
            'old_password' => 'string|required',
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()->first()
            ]);
        }

        $user = User::find($request->user_id);

        if(! Hash::check($request->old_password,$user->password)){
            return response()->json([
                'success' => false,
                'message' => 'Invalid Old Password'
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Password Changed Successfully'
        ]);
    }

    public function updateProfile(Request $request){

        $validate = Validator::make($request->all(),[
            'user_id' => 'integer|required|exists:users,id',
            'profile_pic' => 'nullable|mimes:png,jpg,jpeg,svg',
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()->first()
            ]);
        }

        $user = User::find($request->user_id);
        if($request->hasFile('profile_pic')){
//            $path = $request->file('profile_pic')->store('public/ProfilePic');
//            $path = str_replace('public/','',$path);

            $imageName = time().'.'.$request->file('profile_pic')->extension();
            $request->file('profile_pic')->move(public_path('ProfilePic'), $imageName);
            $imageName = 'public/ProfilePic/' . $imageName;
            $user->profile_pic = $imageName;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile Updated Successfully',
            'user' => $user
        ]);
    }


    public function aboutUs(Request $request)
    {
       $info = SiteInfo::where('key','aboutUs')->first();

       if(!$info){
            return[
                'success' => false,
                'message' => 'AboutUs Content Not Found',
                'data' => $info
            ];
       }

        return[
            'success' => true,
            'message' => 'AboutUs Content Found Successfully',
            'data' => $info
        ];

    }

    public function faqs(Request $request)
    {

       $info = SiteInfo::where('key','faqs')->first();

       if(!$info){
            return[
                'success' => false,
                'message' => 'FAQs Content Not Found',
                'data' => $info
            ];
       }

        return[
            'success' => true,
            'message' => 'FAQs Content Updated Successfully',
            'data' => $info
        ];

    }
}
