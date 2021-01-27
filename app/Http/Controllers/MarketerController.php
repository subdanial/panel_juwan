<?php
namespace App\Http\Controllers;
use App\Marketer;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class MarketerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request){
        // 1 maali 
        // 3 foroosh
        // 2 anbar
        $marketers = User::where('role','1')->orWhere('role','3')->orWhere('role','2')->get();
        if($request->ajax())
        {
            return DataTables::of($marketers)
            ->addColumn('actions', function($data){
                $content ='
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-dark btn-sm btn-marketer-modal" data-action="delete" id="'.$data->id.'" data-user-role="'.$data->role.'"><i class="fas fa-trash"></i></button>
                <button type="button" class="btn btn-dark btn-sm btn-marketer-modal" data-action="edit" id="'.$data->id.'" data-user-role="'.$data->role.'"><i class="fas fa-edit"></i></button>
                </div>';
                        return $content;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('marketers',compact('marketers'));
    }
    public function index()
    {
        $user =  auth()->user()->first();
        return view('marketers',compact('user'));
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
       
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'min:8',
        ]);

        $access = json_encode(array(
            "view_user"=> 1,
            "view_clients"=> 0,
            "view_category"=> 0,
            "view_products"=> 0,
            "view_orders"=> 0,
        ));

        $marketer = new User([
                'username'=>$request->get('username'),
                'name'=>$request->get('name'),
                'lastname'=>$request->get('lastname'),
                'phone'=>$request->get('phone'),
                'role'=>$request->get('role'),
                'password'=>Hash::make($request->get('password')),
                'no_access'=>$access,
        ]);

            $marketer->save();
            $msg = "کاربر جدید با موفقیت ثبت شد";
            $request->session()->flash('msg', $msg);
            return redirect()->route('marketers.index');
      
 
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function show(Marketer $marketer)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function edit(User $marketer)
    {
            $data = User::where('id','=',$marketer->id)->get();
            return response()->json(['result' => $data]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marketer $marketer)
    {
        if(empty($request->password))
        {
            
            $request->validate([
                'username' => 'required',
                'name' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'role' => 'required',
            ]);
            $form_data = array(
                'name'     =>  $request->name,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'phone' => $request->phone,
            );

        }else{
            $request->validate([
                'username' => 'required',
                'name' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'role' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'min:8',
            ]);
            $form_data = array(
                'name'     =>  $request->name,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'phone' => $request->phone,
                'password' => Hash::make($request->get('password')),
            );
        }

        
        User::whereId($request->marketer_hidden_id)->update($form_data);


        //access manager
 



     
        $access = array(
            "view_user"=> $request->view_user ? $request->view_user : 1 ,
            "view_clients"=> $request->view_clients ? $request->view_clients : 0 ,
            "view_category"=> $request->view_category ? $request->view_category : 0 ,
            "view_products"=> $request->view_products ? $request->view_products : 0 ,
            "view_orders"=> $request->view_orders ? $request->view_orders : 0 ,
        );
        $no_access = array(
            'no_access'=>$access
        );
        User::whereId($request->marketer_hidden_id)->update($no_access);


        $msg = "کاربر به روزرسانی شد";
        $request->session()->flash('msg', $msg);
        return redirect()->route('marketers.index'); 

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         User::where('id','=',$request->hidden_delete_id)->delete();
         $msg = "کاربر حذف ";
         $request->session()->flash('msg', $msg);
         return redirect()->route('marketers.index'); 
    }
}
