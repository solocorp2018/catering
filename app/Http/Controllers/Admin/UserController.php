<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\CustomersExport;
use Validator;
use Auth;
use App\Models\User;
use App\Models\UserAddress;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = User::getQueriedResult();

        return view('admin.customers.list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = _getGlobalStatus();

        return view('admin.customers.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),$this->rules(),$this->messages(),$this->attributes());

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $input = [
                'name' => $request->name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'country_code' => '+91',
                'user_type_id' => 2,
                'status' => $request->status,
            ];


        $result = User::create($input);

        $userAddressData = [
            'user_id' => $result->id,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'state_id' => 1,
            'country_id' => 1,
            'is_current' => _active(),
            'created_by'=> Auth::user()->id,
            'status' => _active(),
        ];

        UserAddress::create($userAddressData);

        createdResponse("Customer Created Successfully");

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $result = $user;
        return view('admin.customers.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$result = User::find($id);
        $result = User::with(['userAddress'])->find($id);
        $statuses = _getGlobalStatus();
        return view('admin.customers.edit',compact('result','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),$this->rules($id),$this->messages(),$this->attributes());

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $user = User::find($id);

        $input = array();
        $input = [
                'name' => $request->name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'status' => $request->status,
            ];

        $result = $user->update($input);

        $userAddress = UserAddress::where('user_id',$id)->first();

        $addressInput = array();
        $addressInput = [
          'address_line_1' =>$request->address_line_1,
          'address_line_2' => $request->address_line_2,
          'city'=> $request->city,
          'pincode' => $request->pincode,
        ];

        $resultAddress = $userAddress->update($addressInput);

        updatedResponse("User Updated Successfully");

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function rules($id="") {

        $rules = array();

        if($id) {
            $rules['name'] = "required|unique:users,name,{$id},id|min:2|max:99";
            $rules['email'] = "sometimes|unique:users,email,{$id},id|min:25|max:99";
            $rules['contact_number'] = "required|unique:users,contact_number,{$id},id|min:10|max:10";

        } else {
            $rules['name'] = "required|unique:users,name|min:2|max:99";
            $rules['email'] = "sometimes|unique:users,email|min:25|max:99";
            $rules['contact_number'] = "required|unique:users,contact_number|min:2|max:99";
        }

        $rules['address_line_1'] = 'sometimes|min:15|max:1000';
        $rules['address_line_2'] = 'sometimes|min:15|max:1000';
        $rules['city'] = 'sometimes|min:3|max:1000';
        $rules['pincode'] = 'sometimes|min:5|max:1000';

        return $rules;
    }

    public function messages() {
        return [];
    }

    public function attributes() {
        return [];
    }

    public function export(){
    	$filename = 'customers-list-'.date('d-m-Y').'.csv';
    	return Excel::download(new CustomersExport, $filename);
    }
}
