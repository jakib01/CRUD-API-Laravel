<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    function show()
    {
        $show_item = Products::all();
//        $show_item= json_encode(array('item' => $show_item));
//        $array = json_decode($show_item, true);
//        usort($array['item'], function($a, $b) {
//            return $a['id'] < $b['id'];
//        });
//        return response()->json($array);
        return response()->json($show_item);
    }


    function update(Request $request, $id)
    {
        $data = Products::find($id);
        $data->title = $request->input('title');

        $data->save();

        if (Response()->json($data)) {
            return ['status' => "item has been updated",'data'=>'200'];
        }
//        return Response()->json($data);
    }

    function delete(Request $request, $id)
    {
        $data = Products::find($id);
        $data->delete();

        if (Response()->json($data)) {
            return ['status' => "item has been deleted",'data'=>'200'];
        }
        //        return Response()->json($delete_item);
    }

}
