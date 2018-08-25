<?php

namespace App\Http\Controllers;

use App\Clothing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClothingController extends Controller
{
    public static $reference = "clothings";
    private $viewPath = "clothing.";

    /**
     * ClothingController constructor.
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
        $categories = (new CategoriesController)->getCategories();
        $result = self::$database->getReference(self::$reference)->getValue();
//return $result;
        $clothings = $this->getClothing($result, false, $categories);
        $data = [
            'title' => "Clothing",
            "clothings" => $clothings,
            "categories" => $categories,
            'link' => true,     //to determine whether to use <a> tag in template or not
        ];

        return view($this->viewPath."index")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => "required|string",
            'category' => "required|string",
            "picture" => "required|image|max:1999"
        ]);

        $name = $request->input("name");
        $category = $request->input("category");
        $fileNameToStore = "";

        if($request->hasFile("picture") && $request->file("picture")->isValid()) {
            $fileNameToStore = uniqid().".".$request->file("picture")->getClientOriginalExtension();
            $request->file("picture")->storeAs("public/clothing/",$fileNameToStore);
        }
        $newClothing = self::$database
            ->getReference(self::$reference)
            ->push([
                'name' => $name,
                'category_key' => $category,
                'image' => $fileNameToStore,
                'created_at' => time(),
                'likes' => 0,
                'comments' => 0
            ]);

        //id of stored clothing
        $id = $newClothing->getKey();

        return redirect()->route("clothing.show", $id)->with("success", "Clothing added");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $categories = (new CategoriesController)->getCategories();
        $result = self::$database->getReference(self::$reference."/".$id)->getValue();
        //return count($result);
        $clothing = $this->getClothing($result, $id, $categories);
        $data = [
            'title' => "Clothing",
            'clothing' => $clothing,
            'categories' => $categories,
        ];
        return view($this->viewPath."show")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => "required|string",
            'category' => "required|string",
            "picture" => "nullable|image|max:1999"
        ]);

        $arr = [
            'name' => $request->input("name"),
            'category_key' => $request->input("category")
        ];
        if($request->hasFile("picture") && $request->file("picture")->isValid()) {
            $fileNameToStore = uniqid().".".$request->file("picture")->getClientOriginalExtension();
            $request->file("picture")->storeAs("public/clothing/",$fileNameToStore);
            $arr['image'] = $fileNameToStore;
        }
        self::$database->getReference(self::$reference."/".$id)->update($arr);
        return redirect()->route("clothing.show", $id)->with("success", "Clothing updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::$database->getReference(self::$reference."/".$id)->remove();
        return redirect()->route("clothing.index")->with("success", "Clothing deleted");
    }


    public function getClothing($result, $id = false, $category = false)
    {
        $categories =  $category ? $category : (new CategoriesController)->getCategories();
        $clothings = [];
        if(is_array(array_values($result)[0])) {
            foreach ($result as $key => $value) {
                $clothing = new Clothing();
                $clothing->key = $key;
                $clothing->name = $value['name'];
                $clothing->category_key = $value['category_key'];
                $clothing->picture = $value['image'];
                $clothing->created_at = Carbon::createFromTimestamp($value['created_at']);
                $clothing->likes = $value['likes'];
                $clothing->comments = $value['comments'];
                foreach ($categories as $category) {
                    if($category['key'] == $clothing->category_key) $clothing->category_name = $category['name'];
                }
                array_push($clothings, $clothing);
            }
            return $clothings;
        } else {
            $clothing = new Clothing();
            $clothing->key = $id;
            $clothing->name = $result['name'];
            $clothing->category_key = $result['category_key'];
            $clothing->picture = $result['image'];
            $clothing->created_at = Carbon::createFromTimestamp($result['created_at']);
            $clothing->likes = $result['likes'];
            $clothing->comments = $result['comments'];
            foreach ($categories as $category) {
                if($category['key'] == $clothing->category_key) $clothing->category_name = $category['name'];
            }
            return $clothing;
        }
    }

    public static function storeImage($name,$fileName,$category)
    {
        $newClothing = self::$database
            ->getReference(self::$reference)
            ->push([
                'name' => $name,
                'category_key' => $category,
                'image' => $fileName,
                'created_at' => time(),
                'likes' => 0,
                'comments' => 0
            ]);
    }
}
