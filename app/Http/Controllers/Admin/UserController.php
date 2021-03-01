<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\CustomersExport;
use Validator;
use Auth;
use App\Services\TextLocalSmsGateway;
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

        if($request->address_line_1) {

             $addressInput = [
              'address_line_1' =>$request->address_line_1,
              'address_line_2' => $request->address_line_2,
              'city'=> $request->city,
              'pincode' => $request->pincode,
            ];

            $resultAddress = $userAddress->update($addressInput);
        }
       

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
            $rules['name'] = "required|min:2|max:99";
            $rules['email'] = "sometimes|nullable|email|unique:users,email,{$id},id|max:99";
            $rules['contact_number'] = "required|unique:users,contact_number,{$id},id|min:8|max:15";

        } else {
            $rules['name'] = "required|unique:users,name|min:2|max:99";
            $rules['email'] = "sometimes|nullable|email|unique:users,email|max:99";
            $rules['contact_number'] = "required|unique:users,contact_number|min:8|max:15";
             $rules['address_line_1'] = 'required|min:15|max:200';
        $rules['address_line_2'] = 'sometimes|nullable|min:15|max:200';
        $rules['city'] = 'required|min:3|max:100';
        $rules['pincode'] = 'required|min:5|max:10';

        }

       
        return $rules;
    }

    public function messages() {
        return [];
    }

    public function attributes() {
        return [];
    }


    public function export(Request $request){
    	$filename = 'customers-list-'.date('d-m-Y').'.xlsx';
    	return Excel::download(new CustomersExport, $filename);
    	
    }
    
    public function updateAddress(Request $request,$id) {

      $input = array();
      $input = [
              'user_id' => $request->user_id,
              'address_line_1' => $request->address_line_1,
              'address_line_2' => $request->address_line_2,
              'city' => $request->city,
              'pincode' => $request->pincode,
              'status' => $request->status ?? 0,
              'state_id' => 1,
              'country_id' => 1,
              'is_current' => _active(),
              'created_by'=> Auth::user()->id,
              
          ];
      if($id != 0) {
        $address = UserAddress::find($id);
        $resultAddress = $address->update($input);
      } else {
        UserAddress::create($input);
      }
      return back();
    }

    public function sendInvitation(Request $request) {

        $validator = Validator::make($request->all(),['invite_numbers'=>'required']);

        if($validator->fails()) {
            session()->flash('error','Send Invitation Request Failured !');
            return redirect()->back();
        }

        $concatedMobileNumbers = $request->get('invite_numbers');

        $explodedMobileNumbers = explode(',', $concatedMobileNumbers);

        $validMobileNumbers = array();

        foreach ($explodedMobileNumbers as $key => $mobileNumber) {
            
            if(validateMobile($mobileNumber)) {

                $validMobileNumbers[] = trim($mobileNumber);
            }
        }

        $existingMobileNumbers = User::whereNotNull('contact_number')->pluck('contact_number')->toArray();

        $validMobileNumbers = array_diff($validMobileNumbers, $existingMobileNumbers);

        if(!empty($validMobileNumbers)) {

            $message = "Greetings ! You are invited to MR Grandson Caters, do register, order and get delivered at doorstep. Registration Link : ".url('create-account')." .";

            TextLocalSmsGateway::sendSms($validMobileNumbers,$message);

            createdResponse("Invitation SMS Sent Successfully !");
        }

        return redirect()->back();
    }
}
