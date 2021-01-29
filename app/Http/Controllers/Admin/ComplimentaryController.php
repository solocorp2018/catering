<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complimentary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Services\FileService;
use App\Models\Item;
use App\Models\QuantityType;

class ComplimentaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $quantityTypeModel;

     public function __construct() {
         $this->quantityTypeModel = new QuantityType();
     }

    public function index()
    {
      $results = Complimentary::getQueriedResult();

      return view('admin.complimentary.list',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         $statuses = _getGlobalStatus();

         $quantityTypes = $this->quantityTypeModel->getActiveRecord();

         return view('admin.complimentary.create',compact('statuses','quantityTypes'));
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
                 'description' => $request->description,
                 'quantity_type_id' => $request->quantity_type,
                 'status' => $request->status,
                 'created_by'=> Auth::user()->id
             ];

         if($request->has('image') && $file = $request->file('image')) {
             $storedFileArray = FileService::storeFile($file);
             $input['image_path'] = $storedFileArray['path'] ?? '';
         }

         $result = Complimentary::create($input);

         createdResponse("Complimentary Created Successfully");

         return redirect()->route('complimentary.index');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complimentary  $complimentary
     * @return \Illuminate\Http\Response
     */
     public function show(Complimentary $complimentary)
     {
         $result = $complimentary;
         return view('admin.complimentary.show',compact('result'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complimentary  $complimentary
     * @return \Illuminate\Http\Response
     */
     public function edit(Complimentary $complimentary)
     {
         $result = $complimentary;
         $statuses = _getGlobalStatus();
         $quantityTypes = $this->quantityTypeModel->getActiveRecord();
         return view('admin.complimentary.edit',compact('result'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complimentary  $complimentary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complimentary $complimentary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complimentary  $complimentary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complimentary $complimentary)
    {
        //
    }

    public function rules($id="") {

        $rules = array();

        if($id) {
            $rules['name'] = "required|unique:items,name,{$id},id|min:2|max:99";
        } else {
            $rules['name'] = "required|unique:items,name|min:2|max:99";
        }

        $rules['description'] = 'sometimes|min:2|max:200';
        $rules['image'] = 'sometimes|file|mimes:png,jpeg,jpg|max:5026';
        $rules['quantity_type'] = 'required|exists:quantity_types,id,status,'._active();
        $rules['status'] = 'required|boolean';

        return $rules;
    }

    public function messages() {
        return [];
    }

    public function attributes() {
        return [];
    }
}
