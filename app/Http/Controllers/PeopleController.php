<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Support\Carbon;

class PeopleController extends Controller
{
    public static $reference = "users";
    private $viewPath = "people.";

    /**
     * PeopleController constructor.
     */
    public function __construct()
    {
        $this->middleware("auth");
        self::$database = self::firebaseDatabaseInstance();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        /*$users = self::$database->getReference(self::$reference)->push([
            'name' => 'chris',
            'email' => 'okoroefe18@gmail.com',
            'phone' => "08102620726",
            'date_of_birth' => Carbon::today(),
            'created_at' => Carbon::today(),
            "password" => bcrypt("password")
        ]);
        return $users->getKey();*/
        $users = [];
        $usersFromFirebase = self::$database->getReference(self::$reference)->getValue();
        foreach ($usersFromFirebase as $key => $value) {
            $people = new People();
            $people->id = $key;
            $people->name = $value["name"];
            $people->phone = $value['phone'];
            $people->email = $value["email"];
            $people->date_of_birth = Carbon::createFromTimestamp($value['date_of_birth']);
            $people->created_at = Carbon::createFromTimestamp($value['created_at']);
            array_push($users, $people);
        }
        $data = [
            'title' => "Users",
            "users" => $users
        ];
        return view($this->viewPath . "index")->with($data);
    }
}
