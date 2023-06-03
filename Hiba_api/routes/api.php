<?php

use App\Models\donate;
use App\Models\person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});









// sign up
Route::Post('/signup', function (Request $request) {
    $name = $request->input('name');
    $phone_number = $request->input('phone_number');
    $email = $request->input('email');
    $password = $request->input('password');
   
    $person = new person();

    $person->name = $name;
    $person->phone_number = $phone_number;
    $person->email = $email;
    $person->password = $password;
    


    $item = Person::where('email', '=', $email)->first();
    if ($item) {
        return Response::json(
            ['error' => 'email already exist'],
            201
        );
    } else {
        if ($person->save()) {
            return Response::json(
                $person,
                200
            );
        } else {
            return Response::json(
                ['error' => 'error network'],
                201
            );
        }
    }
});
// log in
Route::Post('/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    $person = Person::where('email', '=', $email)->where('password', '=', $password)->first();
    if ($person) {
        return Response::json(
            $person,
            200
        );
    } else {
        return Response::json(
            ['error' => 'email or password are rong'],
            201
        );
    }
});
// reset password
Route::Post('/reset_password', function (Request $request , $id) {

    $person = person::find($id);
    $person->password =$request->input('new_password');
        if ($person->update()) {
            return Response::json(
                $person,
                200
            );
        } else {
            return Response::json(
                ['error' => 'error network'],
                201
            );
        }
});
//profile
Route::get('/profile', function ($id) {

    $person = person::find($id);
        if ($person) {
            return Response::json(
                $person,
                200
            );
        } else {
            return Response::json(
                ['error' => 'error network'],
                201
            );
        }
});
//Edit_name
Route::Post('/Edit_name', function (Request $request , $id) {

    $person = person::find($id);
    $person->name =$request->input('new_name');
        if ($person->update()) {
            return Response::json(
                $person,
                200
            );
        } else {
            return Response::json(
                ['error' => 'error network'],
                201
            );
        }
});
//Edit_Email
Route::Post('/Edit_Email', function (Request $request , $id) {

    $person = person::find($id);
    $person->email =$request->input('new_Email');
        if ($person->update()) {
            return Response::json(
                $person,
                200
            );
        } else {
            return Response::json(
                ['error' => 'error network'],
                201
            );
        }
});
//Edit_number
Route::Post('/Edit_number', function (Request $request , $id) {

    $person = person::find($id);
    $person->phone_number =$request->input('new_phone_number');
        if ($person->update()) {
            return Response::json(
                $person,
                200
            );
        } else {
            return Response::json(
                ['error' => 'error network'],
                201
            );
        }
});
//delete my account
// Route::get('/delete_account', function ($id) {

//     $person = person::find($id);

//         if ($person->delete()) {

//             return Response::json(
//                 $person,
//                 200
//             );
//         } else {
//             return Response::json(
//                 ['error' => 'error network'],
//                 201
//             );
//         }
// });

//donate
Route::Post('/Donate', function (Request $request) {
    $donor_id = $request->input('donor_id');
    $item_name = $request->input('item_name');
    $item_image = $request->input('item_image');
    $item_address = $request->input('item_address');

    $donate = new donate();

    $donate->donor_id = $donor_id;
    $donate->item_name = $item_name;
    $donate->item_image = $item_image;
    $donate->item_address = $item_address;

    if ($donate->save()) {
        return Response::json(
            $donate,
            200
        );
    } else {
        return Response::json(
            ['error' => 'error network'],
            201
        );
    }
});