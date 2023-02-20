<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\CustomClass\PasswordHash;

class HomeController extends Controller
{

    public function login(Request $req){
        $email = $req->get('email');
        $password = $req->get('password');
        $user = DB::table('wp_users')->select('*')
            ->where('user_email', '=', $email)
            ->first();
        if(isset($user)){
            $wpHasher = new PasswordHash(8, TRUE);
            $passwordCheck = $wpHasher->CheckPassword($password, $user->user_pass);
            if($passwordCheck == true){
                $res['success'] = true;
                $res['user'] = $user;
                return response()->json($res);
            }else{
                $res['success'] = false;
                $res['message'] = 'Invalid email or password';
                return response()->json($res, '401');
            }
        }else{
            $res['success'] = false;
            $res['message'] = 'Invalid email or password';
            return response()->json($res,'401');
        }
    }

    public function calculator(Request $req){
        $name = $req->get('name');
        $email = $req->get('email');
        $gender = $req->get('gender');
        $age = $req->get('age');
        $heightFt = $req->get('height_ft');
        $heightInch = $req->get('height_inch');
        $heightCms = $req->get('height_cms');
        $weightLbs = $req->get('weight_lbs');
        $weightKgs = $req->get('weight_kgs');
        $dailyActivities = $req->get('daily_activities');
        $dayPerWeekExercise = $req->get('days_per_week_exercise');
        $minutesPerDayExercise = $req->get('minutes_per_day_exercise');
        $intenseExercise = $req->get('intense_exercise');
        $trainingDoYouDoNone = $req->get('training_do_you_do_none');
        $trainingDoYouDoCardio = $req->get('training_do_you_do_cardio');
        $trainingDoYouDoWeightresistance = $req->get('training_do_you_do_weightresistance');
        $goal = $req->get('goals');
        $proteinResult = $req->get('protein_result');
        $fatResult = $req->get('fat_result');
        $carbsResult = $req->get('carbs_result');
        $caloriesResult = $req->get('calories_result');
        $userId = $req->get('user_id');

        DB::table('wp_food_calculator')->insert([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'age' => $age,
            'height_ft' => $heightFt ?? "",
            'height_inch' => $heightInch ?? "",
            'height_cms' => $heightCms ?? "",
            'weight_lbs' => $weightLbs ?? "",
            'weight_kgs' => $weightKgs ?? "",
            'daily_activities' => $dailyActivities,
            'days_per_week_exercise' => $dayPerWeekExercise,
            'minutes_per_day_exercise' => $minutesPerDayExercise,
            'intense_exercise' => $intenseExercise,
            'training_do_you_do_none' => $trainingDoYouDoNone ?? "",
            'training_do_you_do_cardio' => $trainingDoYouDoCardio ?? "",
            'training_do_you_do_weightresistance' => $trainingDoYouDoWeightresistance ?? "",
            'goals' => $goal,
            'protein_result' => $proteinResult ?? 0,
            'fat_result' => $fatResult ?? 0,
            'carbs_result' => $carbsResult ?? 0,
            'fiber_result' => 0,
            'sodium_result' => 0,
            'calories_result' => $caloriesResult ?? 0,
            'formula_used' => 'Total Body Weight Formula',
            'user_id' => $userId,
            'date_added' => now()->toDateString(),
        ]);

        $res['success'] = true;
        return response()->json($res);

    }

    public function getMealTypes(){
        $meals = DB::table('wp_meal_type')->select('*')->get();
        return response()->json($meals);
    }

    public function getFoodRecord(Request $req){
        $date = $req->get('date');
        $userId = $req->get('user_id');
        $meals = DB::table('wp_meal_type')->select('*')->get();
        $totalKcal = 0;
        foreach ($meals as $meal){
            $record = DB::table('wp_food_parameters_record as fpr')->select('fpr.*', 'fp.brand', 'fp.protein', 'fp.servingsize')
                ->join('wp_food_parameters as fp', 'fp.id', '=', 'fpr.food_id')
                ->where('fpr.date_selected','=', $date)
                ->where('fpr.user_id','=', $userId)
                ->where('fpr.meal_type','=', $meal->id)
                ->get();
            $kcal = 0; $prot = 0; $car = 0 ; $fat = 0;
            foreach ($record as $rec){
                $kcal += $rec->calories;
                $prot += $rec->protien;
                $car += $rec->carbs;
                $fat += $rec->fat;
            }
            $totalKcal += $kcal;
            $meal->meal_record = $record;
            $total['kcal'] = $kcal;
            $total['prot'] = $prot;
            $total['car'] = $car;
            $total['fat'] = $fat;
            $meal->total = $total;
        }
        $calculator = DB::table('wp_food_calculator')
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'desc')->first();
        $todayCal = DB::table('wp_food_parameters_record')
            ->where('date_selected', '=', $date)
            ->where('user_id','=', $userId)
            ->sum('calories');
        $protein = DB::table('wp_food_parameters_record')
            ->where('date_selected', '=', $date)
            ->where('user_id','=', $userId)
            ->sum('protien');
        $carbs = DB::table('wp_food_parameters_record')
            ->where('date_selected', '=', $date)
            ->where('user_id','=', $userId)
            ->sum('carbs');
        $fat = DB::table('wp_food_parameters_record')
            ->where('date_selected', '=', $date)
            ->where('user_id','=', $userId)
            ->sum('fat');

        $totalCal = $calculator->calories_result;
        $totalProtein = $calculator->protein_result;
        $totalCarb = $calculator->carbs_result;
        $totalFat = $calculator->fat_result;
        $pie['calIntakePer'] = floor(($todayCal/$totalCal) * 100);
        $pie['proteinIntakePer'] = floor(($protein/$totalProtein) * 100);
        $pie['carbsIntakePer'] = floor(($carbs/$totalCarb) * 100);
        $pie['fatIntakePer'] = floor(($fat/$totalFat) * 100);

        $pie['totalCalIntake'] = $totalCal;
        $pie['totalProteinIntake'] = $totalProtein;
        $pie['totalCarbsIntake'] = $totalCarb;
        $pie['totalFatIntake'] = $totalFat;

        $pie['todayCalIntake'] = floor($totalCal - $todayCal);
        $pie['todayProteinIntake'] = floor($totalProtein - $protein);
        $pie['todayCarbsIntake'] = floor($totalCarb - $carbs);
        $pie['todayFatIntake'] = floor($totalFat - $fat);

        $res['totalKcal'] = $totalKcal;
        $res['listData'] = $meals;
        $res['pie'] = $pie;
        return response()->json($res);
    }

    public function getFoodParameters(Request $req){
        $name = $req->get('name');
        $record = DB::table('wp_food_parameters')->select('*')
            ->where('name','like', "%{$name}%")->get();
        return response()->json($record);
    }

    public function saveFoodRecord(Request $req){
        $type = $req->get('type');
        $postData = [
            "name"=> $req->get('name'),
            "decimal_or_fraction" =>$req->get('decimal_or_fraction'),
            "numberofserving"=> $req->get('numberofserving'),
            "first_fractions"=> $req->get('first_fractions'),
            "second_fractions"=> $req->get('second_fractions'),
            "select_options"=> $req->get('select_options'),
            "protien"=> $req->get('protien'),
            "fat"=> $req->get('fat'),
            "carbs"=> $req->get('carbs'),
            "calories"=> $req->get('calories'),
            "sodium"=> $req->get('sodium'),
            "fibre"=> $req->get('fibre'),
            "quantity"=> $req->get('quantity'),
            "meal_type"=> $req->get('meal_type'),
            "food_state"=> $req->get('food_state'),
            "serving_w_v"=> $req->get('serving_w_v'),
            "food_id"=> $req->get('food_id'),
            "user_id"=> $req->get('user_id'),
            "date_selected"=> $req->get('date_selected')
        ];
//        return response()->json($postData);

        if($type == 'update'){
            $updateId = $req->get('update_id');
            DB::table('wp_food_parameters_record')->where('id', '=', $updateId)->update($postData);
            $res['success'] = true;
            return response()->json($res);
        }else {
            DB::table('wp_food_parameters_record')->insert($postData);
            $res['success'] = true;
            return response()->json($res);
        }
    }

    public function getDashboard(Request $req){
        try {
            $days = json_decode($req->get('days'));
            $userId = $req->get('user_id');
            $calories = array();
            $totalCalories = 0;

            $calculator = DB::table('wp_food_calculator')
                ->where('user_id', '=', $userId)
                ->orderBy('id', 'desc')->first();
            foreach ($days as $day){
                $cal = DB::table('wp_food_parameters_record')
                    ->where('date_selected', '=', $day)
                    ->where('user_id','=', $userId)
                    ->sum('calories');
                array_push($calories, $cal);
                $totalCalories += $cal;
            }

            $todayCal = DB::table('wp_food_parameters_record')
                ->where('date_selected', '=', date('Y-m-d'))
                ->where('user_id','=', $userId)
                ->sum('calories');
            $protein = DB::table('wp_food_parameters_record')
                ->where('date_selected', '=', date('Y-m-d'))
                ->where('user_id','=', $userId)
                ->sum('protien');
            $carbs = DB::table('wp_food_parameters_record')
                ->where('date_selected', '=', date('Y-m-d'))
                ->where('user_id','=', $userId)
                ->sum('carbs');
            $fat = DB::table('wp_food_parameters_record')
                ->where('date_selected', '=', date('Y-m-d'))
                ->where('user_id','=', $userId)
                ->sum('fat');
            $weightType = 'lbs';
            if(isset($calculator->weightKgs) && $calculator->weightKgs > 0){
                $weightType = 'kg';
            }

            $totalCal = $calculator->calories_result;
            $totalProtein = $calculator->protein_result;
            $totalCarb = $calculator->carbs_result;
            $totalFat = $calculator->fat_result;

            $pie['todayIntake'] = $todayCal;
            $pie['calIntakePer'] = floor(($todayCal/$totalCal) * 100);
            $pie['proteinIntakePer'] = floor(($protein/$totalProtein) * 100);
            $pie['carbsIntakePer'] = floor(($carbs/$totalCarb) * 100);
            $pie['fatIntakePer'] = floor(($fat/$totalFat) * 100);

            $pie['totalCalIntake'] = $totalCal;
            $pie['totalProteinIntake'] = $totalProtein;
            $pie['totalCarbsIntake'] = $totalCarb;
            $pie['totalFatIntake'] = $totalFat;

            $pie['todayCalIntake'] = floor($totalCal - $todayCal);
            $pie['todayProteinIntake'] = floor($totalProtein - $protein);
            $pie['todayCarbsIntake'] = floor($totalCarb - $carbs);
            $pie['todayFatIntake'] = floor($totalFat - $fat);

            $res['calories'] = $calories;
            $res['totalCalConsume'] = $totalCalories;
            $res['totalCal'] = $totalCalories * 5;
            $res['success'] = true;
            $res['calculator'] = $totalCalories;
            $res['weightType'] = $weightType;
            $res['pie'] = $pie;

            return response()->json($res);
        }catch (\Exception $e){
            $res['success'] = false;
            $res['message'] = $e->getMessage();
            return response()->json($res, 500);
        }
    }

    public function changePassword(Request $req){
        $password = $req->get('password');
        $userId = $req->get('user_id');
        $wpHasher = new PasswordHash(8, TRUE);
        DB::table('wp_users')
            ->where('id', $userId)
            ->update(['user_pass' => $wpHasher->HashPassword($password) ]);
        $res['success'] = true;
        return response()->json($res);
    }

    public function changeEmail(Request $req){
        $password = $req->get('password');
        $email = $req->get('email');
        $userId = $req->get('user_id');
        $emailCount = DB::table('wp_users')->where('user_email', '=' ,$email)->count();
        if($emailCount > 0){
            $res['success'] = false;
            $res['message'] = 'Email already taken';
            return response()->json($res);
        }
        $user = DB::table('wp_users')->select('*')
            ->where('ID', '=', $userId)->first();
        $wpHasher = new PasswordHash(8, TRUE);
        $passwordCheck = $wpHasher->CheckPassword($password, $user->user_pass);
        if ($passwordCheck == true) {
            DB::table('wp_users')
                ->where('id', $userId)
                ->update(['user_email' => $email]);
            $res['success'] = true;
            $res['message'] = 'email updated';
            return response()->json($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Invalid password';
            return response()->json($res);
        }

    }

    public function forgetPassword(Request $req){
        $email = $req->get('email');

        $emailCount = DB::table('wp_users')->where('user_email', '=' ,$email)->count();
        if($emailCount == 0){
            $res['success'] = false;
            $res['message'] = 'Email address not found.';
            return response()->json($res);
        }else{
            $code = random_int(1000, 9999);
            sendMail($email, 'Reset Password','Your reset password OTP is '.$code);
            $res['success'] = true;
            $res['code'] = $code;
            return response()->json($res);
        }
    }

    public function resendOtp(Request $req){
        $email = $req->get('email');
        $code = random_int(1000, 9999);
        sendMail($email, 'Reset Password','Your reset password OTP is '.$code);
        $res['success'] = true;
        $res['code'] = $code;
        return response()->json($res);
    }

    public function resetPassword(Request $req){
        $password = $req->get('password');
        $email = $req->get('email');
        $wpHasher = new PasswordHash(8, TRUE);
        DB::table('wp_users')
            ->where('user_email', $email)
            ->update(['user_pass' => $wpHasher->HashPassword($password) ]);
        $res['success'] = true;
        return response()->json($res);
    }

    public function saveWeight(Request $req){
        $imageName = '';
        if($req->hasFile('front_image')){
            $imageName = time().'.'.$req->file('front_image')->extension();
            $req->file('front_image')->move(storage_path('app/public'), $imageName);
        }
        $postData = [
            "date_added"=> $req->get('date_added'),
            "arm" =>$req->get('arm') ?? '',
            "chest" =>$req->get('chest') ?? '',
            "stomach" =>$req->get('stomach') ?? '',
            "hips_thigh" =>$req->get('hips_thigh') ?? '',
            "leg" =>$req->get('leg') ?? '',
            "total" =>$req->get('total') ?? '',
            "current_weight" =>$req->get('current_weight') ?? '',
            'front_image' => $imageName,
            'side_image' => '',
            'back_image' => '',
            "user_id" =>$req->get('user_id'),
            "status" =>'publish'
        ];
        DB::table('wp_custom_image_uploader')->insert($postData);
        $res['success'] = true;
        return response()->json($res);
    }

    public function activityStatus(Request $req){
        $userId = $req->get('user_id');
        $calculator = DB::table('wp_food_calculator')
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'desc')->first();
        $activityLevel =  isset($calculator) ? $calculator->days_per_week_exercise : 0;
        $userData = DB::table('wp_custom_image_uploader')
            ->where('user_id', '=', $userId)
            ->orderBy('image_id', 'desc')->first();
        $currentWeight = 0;
        $height = 0;
        if(isset($userData)){
            $currentWeight = $userData->current_weight;
            $height = $userData->total;
        }
        $res['success'] = true;
        $res['activityLevel'] = $activityLevel;
        $res['currentWeight'] = $currentWeight;
        $res['height'] = $height;
        return response()->json($res);
    }

}
