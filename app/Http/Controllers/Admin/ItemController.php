<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Services\FileService;
use App\Models\Item;
use App\Models\QuantityType;

class ItemController extends Controller
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
        $results = Item::getQueriedResult();
        
        return view('admin.items.list',compact('results'));   
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

        return view('admin.items.create',compact('statuses','quantityTypes'));
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
                'lang1_name' => $request->lang1_name,
                'description' => $request->description,
                'lang1_name' => $request->lang1_name,
                'quantity_type_id' => $request->quantity_type,

                'price' => $request->price,
                'status' => $request->status,
                'created_by'=> Auth::user()->id
            ];

        if($request->has('image') && $file = $request->file('image')) {
            $storedFileArray = FileService::storeFile($file);                
            $input['image_path'] = $storedFileArray['path'] ?? '';            
        }

        $result = Item::create($input);

        createdResponse("Item Created Successfully");

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $result = $item;
        return view('admin.items.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $result = $item;
        $statuses = _getGlobalStatus();
        $quantityTypes = $this->quantityTypeModel->getActiveRecord();
        return view('admin.items.edit',compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function rules($id="") {

        $rules = array();

        if($id) {
            $rules['name'] = "required|unique:items,name,{$id},id|min:2|max:99"; 
            $rules['lang1_name'] = "required|unique:items,lang1_name,{$id},id|min:2|max:99";     

        } else {
            $rules['name'] = "required|unique:items,name|min:2|max:99"; 
            $rules['lang1_name'] = "required|unique:items,lang1_name|min:2|max:99";     
        }
        
        $rules['description'] = 'sometimes|min:2|max:200';
        $rules['lang1_description'] = 'sometimes|min:2|max:200';
        $rules['image'] = 'sometimes|file|mimes:png,jpeg,jpg|max:5026';
        $rules['quantity_type'] = 'required|exists:quantity_types,id,status,'._active();
        $rules['price'] = 'required';
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
