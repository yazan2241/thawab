<?php

use App\Models\Donation;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', function (Request $request) {
    $phone = $request->input('phone');
    $password = $request->input('password');

    $user = Person::where('phone', '=', $phone)->where('password', '=', $password)->first();
    if ($user) {
        return Response::json($user, 200);
    } else {
        return Response::json(['error' => 'user not exist'], 201);
    }
});

Route::post('/signup', function (Request $request) {
    $type = $request->input('type');
    $name = $request->input('name');
    $phone = $request->input('phone');
    $address = $request->input('address');
    $password = $request->input('password');

    $father_alive = $request->input('father_alive');
    $father_age = $request->input('father_age');
    $father_job = $request->input('father_job');
    $father_disease = $request->input('father_disease');

    $mother_alive = $request->input('mother_alive');
    $mother_age = $request->input('mother_age');
    $mother_job = $request->input('mother_job');
    $mother_disease = $request->input('mother_disease');

    $boys = $request->input('boys');
    $girls = $request->input('girls');

    $capicity = $request->input('capicity');


    $user = Person::where('phone', '=', $phone)->first();
    if ($user) {
        return Response::json(["error" => "user already exist"], 201);
    } else {
        $user = new Person();
        $user->type = $type;
        $user->name = $name;
        $user->phone = $phone;
        $user->address = $address;
        $user->password = $password;
        ($father_alive) ? $user->father_alive = $father_alive : Null;
        ($father_age) ? $user->father_age = $father_age : Null;
        ($father_job) ? $user->father_job = $father_job : Null;

        ($father_disease) ? $user->father_disease = $father_disease : Null;
        ($mother_alive) ? $user->mother_alive = $mother_alive : Null;
        ($mother_age) ? $user->mother_age = $mother_age : Null;
        ($mother_job) ? $user->mother_job = $mother_job : Null;
        ($mother_disease) ? $user->mother_disease = $mother_disease : Null;
        ($boys) ? $user->boys = $boys : Null;
        ($girls) ? $user->girls = $girls : Null;
        ($capicity) ? $user->capicity = $capicity : Null;


        if ($user->save()) {
            return Response::json($user, 200);
        } else {
            return Response::json(['error' => 'can not save'], 201);
        }
    }
});

Route::post('/donateforany', function (Request $request) {
    $name = $request->input('name');
    $ammount = $request->input('ammount');

    $userId = 2;
    $donorId = $request->input('donorId');

    $donationType = 1;

    $type = $request->input('type');
    
    $donation = new Donation();
    $donation->userId = $userId;
    $donation->donorId = $donorId;
    $donation->donationType = $donationType;
    $donation->name = $name;
    $donation->ammount = $ammount;
    $donation->type = $type;

    if($donation->save()){
        return Response::json($donation, 200);
    }
    else {
        return Response::json(['error' => 'can not add donation'] , 201);
    }
    
});

Route::post('/groups', function (Request $request) {
    $type = $request->input('type');
    $groups = Person::where('type', '=', $type)->get();

    return Response::json($groups, 200);
});


Route::post('/profile', function (Request $request) {
    $userId = $request->input('userId');
    $user = Person::where('id' , '=' , $userId)->first();

    $box = Donation::where('userId' , '=' , $userId)->where('donationType' , '=' , 0)->get();
    $money = Donation::where('userId' , '=' , $userId)->where('donationType' , '=' , 1)->get();
    $alms = Donation::where('userId' , '=' , $userId)->where('donationType' , '=' , 2)->get();

    $user['box'] = sizeof($box);
    $user['money'] = sizeof($money);
    $user['alms'] = sizeof($alms);

    return Response::json($user, 200);
});


Route::post('/donate', function (Request $request) {
    $userId = $request->input('userId');
    $donorId = $request->input('donorId');
    $type = $request->input('type');
    $name = $request->input('name');
    $ammount = $request->input('ammount');

    $donation = new Donation();
    $donation->userId = $userId;
    $donation->donorId = $donorId;
    $donation->donationType = $type;
    $donation->name = $name;
    $donation->ammount = $ammount;

    if($donation->save()){
        return Response::json($donation, 200);
    }
    else {
        return Response::json(['error' => 'can not add donation'] , 201);
    }
});
