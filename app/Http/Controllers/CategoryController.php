<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function table(Request $request){
        $categories = Category::orderBy('id','asc');
        if($request->ajax())
        {
            return DataTables::of($categories)
                    ->addColumn('parent', function($data){
                        if(isset($data->parent->name))
                        return($data->parent->name);
                        else
                        return "-";
                    })
                    ->addColumn('action', function($data){
                        $content = '
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-dark cat_delete" id="'.$data->id.'"><i class="fas fa-trash"></i></button>
                        <button type="button" class="btn btn-sm btn-dark cat_edit" id="'.$data->id.'"><i class="fas fa-edit"></i></button>
                        </div>';
                                return $content;
                    })
                    ->make(true);
        }

        
    }
    public function index()
    {   
        $categories = Category::get();
        return  view('categories',compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category([
            'name'=> $request->get('name'),
            'parent_id'=> $request->get('parent'),
        ]);

        $category->save();
        $msg = "دسته مورد نظر اضافه شد";
        $request->session()->flash('msg', $msg);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(request()->ajax()){
            $data = Category::where('id','=',$category->id)->get();
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $form_data = array(
            'name'     =>  $request->category_name,
            'parent_id' => $request->parent_edit
        );

        Category::whereId($request->category_hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $childs = Category::where('parent_id' , '=' , $category->id);

        $childs->update([
            'parent_id' => 0,
        ]);
    }
}
