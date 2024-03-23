<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Khai báo  class Products
use App\MyCustomClass\Products;
use DB;

class ProductsController extends Controller
{
    // Tạo biến $model(Là 1 biến của ProductsController)
    public $model;
    // Hàm tạo object của class Products, sau đó gán váo biến $model(để từ biến model có thể gọi bất cứ hàm nào của class products)
    public function __construct(){
        // Khởi tạo
        $this->model = new Products();
    }
    public function read(Request $request){
        $categoryId = $request->input('category');
        $categories = DB::table("categories")->get();
        $query = DB::table("products");

        // Nếu có id danh mục được chọn, thêm điều kiện lọc vào truy vấn
        if($categoryId !== null){
            $query->where("category_id", $categoryId);
        }
        $data = $query->paginate(15);
        return view("admin.products.read", ["data"=>$data, "categories" => $categories]);
    }
    public function update($id){
        $record = $this->model->modelGetRow($id);
        // Tạo biến $action để đưa vào thuộc tính action của thẻ form
        $action = url("backend/products/update-post/$id");
        return view("admin.products.create_update",["record"=>$record, "action"=>$action]);
    }

    public function updatePost($id){
        $this->model->modelUpdate($id);
        return redirect(url("backend/products"));
    }

    public function create(){
        //tạo biến $action để đưa vào thuộc tính action của thẻ form
        $action = url("backend/products/create-post/");
        return view("admin.products.create_update",["action"=>$action]);
    }

    public function createPost(){
        $this->model->modelCreate();
        return redirect(url("backend/products"));
    }

    public function delete($id){
        $this->model->modelDelete($id);
        return redirect(url("backend/products"));
    }
}
