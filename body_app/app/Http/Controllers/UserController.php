<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role','user')->get();
        return view('admin.users.index',compact('users'));
    }

    public function userAction(Request $request){
        $user = User::find($request->userId);
        if(!$user){
            return back()->with('error','Something went wrong!');
        }
        if($request->action == 'removeId'){
            if($user->device_id == null){
                return back()->with('error',"User Does't have Device");
            }
            $user->device_id = null;
            $user->save();
            return back()->with('succes',"User Device Removed Successfully");
        }
        return back();
    }

    public function responseToEmail(Request $request)
    {
        sendMail($request->email,'RESPONSE FROM ADMIN',$request->message);
        return ['success' => true];
    }

    public function purchaseHistory($userId = null)
    {
        $user = User::find($userId);
        $courses = [];

        if($user){
            $orders = $user->userPurchaseHistory;
            if(count($orders) > 0){
                foreach($orders as $order){
                    $orderDetails = $order->orderDetail;
                    foreach($orderDetails as $od){
                        $course = Course::find($od->course_id);
                        $course->purchaseDate = Carbon::parse($od->create_at)->isoFormat('MMM D YYYY');
                        $courses [] = $course;
                    }
                }
            }
        }

        return view('admin.users.purchase-history',compact('courses'));
    }


    public function activeCourses($userId = null)
    {
        $user = User::find($userId);
        $courses = [];

        if($user){
            $orders = $user->userPurchaseCourses;
            if(count($orders) > 0){
                foreach($orders as $order){
                    $orderDetails = $order->orderDetail;
                    foreach($orderDetails as $od){
                        $course = Course::find($od->course_id);
                        $course->purchaseDate = Carbon::parse($od->create_at)->isoFormat('MMM D YYYY');
                        // $course->valid_till = Carbon::parse($od->valit_till)->isoFormat('MMM D YYYY');
                        $courses [] = $course;
                    }
                }
            }
        }
        return view('admin.users.activeCourses',compact('courses'));
    }
}
