<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function get_item_values(Request $request)
    {
        $id = $request->get('id');
        $item = new Item();
        $result =     $item->where('id', $id)->first();
        return ($result);
    }

    public function get_box(Request $request)
    {
        $id = $request->get('id');
        $item = new Item();
        $result = $item->where('id', $id)->first();
        $box_id = $result->box_id;
        $box = new Box;
        $selected_box = $box->where('id', $box_id)->first();
        return ($selected_box);
    }


    public function update_item(Request $request)
    {
        $item = new Item();
        $selected_item  = $item->where('id', $request->id)->first();
        $new_count = $request->new_count;

        $selected_item->update([

            'product_price' => $selected_item->product_price,
            'product_price_total' =>  $selected_item->product_price * $selected_item->box_name * $new_count,
            'product_price_financial' => $selected_item->product_price_financial,
            'product_price_total_financial' => $selected_item->product_price_financial * $selected_item->box_name * $new_count,
            'count' => $new_count,
            'count_total' => $new_count * intval($selected_item->box_name),

        ]);
    }
}
