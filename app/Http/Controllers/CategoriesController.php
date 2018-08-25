<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public static $reference = "categories";
    private $viewPath = "category.";

    /**
     * CategoriesController constructor.
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
        $categories = self::getCategories();
        $data = [
            'title' => "Categories",
            'categories' => $categories
        ];
        return view($this->viewPath."index")->with($data);
    }
//todo: add class 'active' in dashboard from app service provider

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => "required|string"
        ]);
        //store category in firebase here
        $name = $request->input("name");
        $newPost = self::$database
            ->getReference('categories')
            ->push([
                'name' => $name
            ]);
        return redirect()->route("categories.index")->with("success", "category $name added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $result = self::$database->getReference(ClothingController::$reference)
            ->orderByChild('category_key')
            ->equalTo($id)
            ->getValue();
        $title = "Category";
        $categories = $this->getCategories();
        $clothings = [];
        if(count($result) != 0)
            $clothings = (new ClothingController)->getClothing($result, false, $categories);
        foreach ($categories as $category) {
            if($category['key'] == $id) $title = $category['name'];
        }
        $data = [
            "title" => $title,
            "clothings" => $clothings,
            "category_name" => "category",
            "link" => true
        ];

        return view($this->viewPath."show")->with($data);
    }

    public function getCategories() : array {
        $categoriesFromFirebase = self::$database->getReference(self::$reference)->getValue();
        $categories = [];
        foreach ($categoriesFromFirebase as $key => $value) {
            $category = new Category();
            $category->key = $key;
            $category->name = $value['name'];
            $category->no_of_clothing = count(self::$database->getReference(ClothingController::$reference)
                ->orderByChild('category_key')
                ->equalTo($key)
                ->getValue());
            array_push($categories, $category);
        }
        return $categories;
    }

}
