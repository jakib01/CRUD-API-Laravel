<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function store(Request $request){

        $insert_item = new Products();
        $insert_item->title = $request->input('title');
        $insert_item->description = $request->input('description');
        $insert_item->price = $request->input('price');

        if ($request->hasFile('image')){
            $file =  $request->file('image');
            $filename = "http://127.0.0.1:8000/img/" . time() . '.' .$file->extension();
            $file->move('img', $filename);
            $insert_item->image =$filename;
        }else{
            $insert_item ->image = null;
        }

        $insert_item->save();

        if (Response()->json($insert_item)) {
            return ['status' => "Products has been inserted",'data'=>'200'];
        }

    }


    public function show()
    {
        $show_item = Products::all();
        return response()->json($show_item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,gif,svg|max:3072',
        ]);

        $file = $request->file('image');
        $filename = "http://127.0.0.1:8000/img/" . time() . '.' . $file->extension();
        $file->move('img', $filename);

        $update_data = Products::find($id);
        $update_data->title = $request->input('title');
        $update_data->description = $request->input('description');
        $update_data->price = $request->input('price');
        $update_data->image = $filename;

        $update_data->save();

        if (Response()->json($update_data)) {
            return ['status' => "Product has been updated",'data'=>'200'];
        }
//        return Response()->json($data);
    }

    public function delete($id)
    {
        $data = Products::find($id);
        $data->delete();

        if (Response()->json($data)) {
            return ['status' => "Product has been deleted",'data'=>'200'];
        }
        //        return Response()->json($delete_item);
    }

}
