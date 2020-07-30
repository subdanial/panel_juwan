<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class ClientController extends Controller
{

 

    public function table(Request $request)
    {
        $clients = Client::get();
        if ($request->ajax()) {
            return DataTables::of($clients)
            
            ->addColumn('creator',function($data){
                if(isset($data->user->username))
                return($data->user->name." ".$data->user->lastname);
                else
                return "-";
            })
            
            ->addColumn('actions', function ($data) {
                $content = '
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-dark btn-sm btn-client-modal" data-action="delete" id="' . $data->id . '"><i class="fas fa-trash"></i></button>
                <button type="button" class="btn btn-dark btn-sm btn-client-modal" data-action="edit" id="' . $data->id . '"><i class="fas fa-edit"></i></button>
                </div>';
                return $content;
            })
                ->rawColumns(['actions'])->make(true);
        }
        return view('clients', compact('clients'));
    }

    public function table_marketer(Request $request)
    {
        $clients = Client::get();
        if ($request->ajax()) {
            return DataTables::of($clients)
            
            ->addColumn('creator',function($data){
                if(isset($data->user->username))
                return($data->user->name." ".$data->user->lastname);
                else
                return "-";
            })
            
            ->addColumn('actions', function ($data) {
                $content ="<div class='btn-group btn-group-sm' role='group' aria-label='Basic example'>";
                if($data->user_id == auth()->user()->id){
                    $content .="<button disabled type='button' class='btn btn-dark btn-sm btn-client-modal' data-action='delete' id='$data->id'><i class='fas fa-trash'></i></button>";
                    $content .="<button type='button' class='btn btn-dark btn-sm btn-client-modal' data-action='edit' id='$data->id'><i class='fas fa-edit'></i></button>";
                }else{
                    $content .="<button type='button' class='btn btn-dark btn-sm btn-client-modal' disabled data-action='delete' id='$data->id'><i class='fas fa-trash'></i></button>";
                    $content .="<button type='button' class='btn btn-dark btn-sm btn-client-modal' disabled data-action='edit' id='$data->id'><i class='fas fa-edit'></i></button>";
                }
                $content .="</div>";
                return $content;
            })
            ->rawColumns(['actions'])->make(true);
        }
    }


    public function index()
    {
        return view('clients');

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'balance' => 'required',
            'phone' => 'required|unique:clients',
        ]);
        $client = new Client([
                'user_id'=>auth()->user()->id,
                'name'=>$request->get('name'),
                'lastname'=>$request->get('lastname'),
                'phone'=>$request->get('phone'),
                'city'=>$request->get('city'),
                'address'=>$request->get('address'),
                'balance'=>$request->get('balance'),
        ]);

            $client->save();
            $msg = "مشتری جدید با موفقیت ثبت شد";
            $request->session()->flash('msg', $msg);
            return redirect()->route('clients.index');
      
    }


    public function edit(Request $request, Client $client)
    {
        $data = Client::where('id','=',$client->id)->get();
        return response()->json(['result' => $data]);
    }


    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'balance' => 'required',
            'phone' => 'required',
        ]);
       
        $city = $request->city;
        $address = $request->address;
        if(empty($request->city))
        $city="خالی";
        if(empty($request->address))
        $address="خالی";


        $form_data = array(
            'name'     =>  $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'city' => $city,
            'address' => $address,
            'balance' => $request->balance,
        );

        Client::whereId($request->client_hidden_id)->update($form_data);

        $msg = "فروشنده به روزرسانی شد";
        $request->session()->flash('msg', $msg);
        return redirect()->route('clients.index'); 
    }

    public function destroy(Request $request,Client $client)
    {
        Client::where('id','=',$request->hidden_delete_id)->delete();
        $msg = "فروشنده حذف ";
        $request->session()->flash('msg', $msg);
        return redirect()->route('clients.index'); 
    }
}
