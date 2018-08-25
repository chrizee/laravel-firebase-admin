<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        self::$database = self::firebaseDatabaseInstance();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $category = self::$database->getReference(CategoriesController::$reference)->getSnapshot()->numChildren();
        $clothing = self::$database->getReference(ClothingController::$reference)->getSnapshot()->numChildren();
        $users = self::$database->getReference(PeopleController::$reference)->getSnapshot()->numChildren();
        $likes = self::$database->getReference(LikesController::$reference)->getSnapshot()->numChildren();
        $data = [
            'title' => "Dashboard",
            'category' => $category,
            'clothing' => $clothing,
            'users' => $users,
            'likes' => $likes
        ];
        return view('home')->with($data);
    }

    public function images()
    {
        $names = Storage::files("public/clothing/Index Images - Necklines");
        //renaming all files in a directory with a particular pattern
        foreach ($names as $name) {
            //return str_replace("- Neckline -", "- Necklines -", $name);
            if (str_contains($name, "Necklines")) {
                Storage::move($name, str_replace("- Neckline -", "- Necklines -", $name));
            }
        }

        return "success";

        //to populate firebase with data
        /*$arr = [];
        $clothingName = [];
        foreach ($names as $name){
            $arr[] = "Index Image - Sleeves - ".explode(" - ", $name)[3];
            $clothingName[] = explode(".",explode(" - ", $name)[3])[0];
        }
        return $arr;
        foreach ($arr as $key => $value) {
            ClothingController::storeImage($clothingName[$key],$value,"-LK1WbGUHo0CVWke5EfE");
        }

        return "success";*/
    }
}
