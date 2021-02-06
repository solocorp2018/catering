<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Models\SessionMenu;
use App\Models\SessionType;
use App\Models\MenuItem;
use App\Models\MenuItemComplimentary;
use App\Models\Item;
use App\Models\Complimentary;
use App\Models\QuantityType;
use Log;
use Illuminate\Support\Arr;

class MenuController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  protected $sessionTypeModel;
  protected $itemsModel;
  protected $complimentaryModel;
  protected $quantityTypeModel;


  public function __construct() {
      $this->quantityTypeModel = new QuantityType();
      $this->sessionTypeModel = new SessionType();
      $this->itemsModel = new Item();
      $this->complimentaryModel = new Complimentary();
  }

  public function index()
  {
      $results = SessionMenu::getQueriedResult();
      //dd($results);
      return view('admin.sessionMenus.list',compact('results'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $statuses = _getGlobalStatus();
      $allowedItemCount = config('catering.allowed_item_limit_for_menu');

      $sessionTypes = $this->sessionTypeModel->getActiveRecord();
      $menuItems = $this->itemsModel->getActiveRecord();
      $complimentaries = $this->complimentaryModel->getActiveRecord();
      $quantityTypes = $this->quantityTypeModel->getActiveRecord();

      //dd($sessionTypes);
      return view('admin.sessionMenus.create',compact('statuses','quantityTypes','sessionTypes','menuItems','complimentaries','allowedItemCount'));
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
    
      $input = array();
      $input = [
              'session_type_id' => $request->session_type,
              'session_date'=> $request->session_date,
              'opening_time' => $request->opening_time,
              'closing_time' => $request->closing_time,
              'session_date' => $request->session_date,
              'expected_delivery_time' => $request->delivery_time,
              'status' => $request->status,
              'created_by'=> Auth::user()->id
          ];

      $sessionMenu = SessionMenu::create($input);

      $menuItems = $request->menu_items ?? [];

      foreach ($menuItems as $key => $itemRow) {
          
          $itemRow['status'] = (isset($itemRow['status']) && $itemRow['status']==_active())?$itemRow['status']:_inactive();

          if($itemRow['item_id'] && $itemRow['quantity'] && $itemRow['quantity_type_id'] && $itemRow['price'] && $itemRow['status']) {

              $menuList = array();
              $menuList['session_menu_id'] = $sessionMenu->id;
              $menuList['item_id'] = $itemRow['item_id'];
              $menuList['quantity_type_id'] = $itemRow['quantity_type_id'];
              $menuList['quantity'] = $itemRow['quantity'];
              $menuList['price'] = $itemRow['price'];
              $menuList['status'] = $itemRow['status'];
              $menuItem = MenuItem::create($menuList);

              if(!empty($itemRow['complimentaries'])) {

                $itemRow['complimentaries'] = is_array($itemRow['complimentaries'])?$itemRow['complimentaries']:Arr::wrap($itemRow['complimentaries']);

                foreach ($itemRow['complimentaries'] as $key => $complimentaryId) {
                  
                    $menuComplimentaryArray = array();
                    $menuComplimentaryArray['session_menu_id'] = $sessionMenu->id;
                    $menuComplimentaryArray['menu_item_id'] = $menuItem->id;
                    $menuComplimentaryArray['complimentary_id'] = $complimentaryId;
                    $menuComplimentaryArray['quantity_type_id'] = 0;
                    $menuComplimentaryArray['quantity'] = 0;
                    $menuComplimentaryArray['status'] = _active();

                    MenuItemComplimentary::create($menuComplimentaryArray);
                }
              }
          }
      }
      
      createdResponse("Session Menu Created Successfully");

      return redirect()->route('sessionMenus.index');
  }


  /**
   * Display the specified resource.
   *
   * @param  \App\Models\SessionMenu  $item
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
       $result = SessionMenu::with(['menuItem','sessionType'])->find($id);
       //dd($result);
       return view('admin.sessionMenus.show',compact('result'));
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
      $allowedItemCount = config('catering.allowed_item_limit_for_menu');
      $sessionTypes = $this->sessionTypeModel->getActiveRecord();
      $menuItems = $this->itemsModel->getActiveRecord();
      $complimentaries = $this->complimentaryModel->getActiveRecord();
      $quantityTypes = $this->quantityTypeModel->getActiveRecord();
      return view('admin.items.edit',compact('result','quantityTypes','statuses','allowedItemCount'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Item  $item
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request,$id)
  {
      $validator = Validator::make($request->all(),$this->rules($id),$this->messages(),$this->attributes());

      if($validator->fails()) {
          return redirect()->back()->withErrors($validator)
                      ->withInput();
      }

      $item = Item::find($id);

      $input = array();
      $input = [
              'name' => $request->name,
              'lang1_name' => $request->lang1_name,
              'description' => $request->description,
              'lang1_description' => $request->lang1_description,
              'lang1_name' => $request->lang1_name,
              'quantity_type_id' => $request->quantity_type,
              'price' => $request->price,
              'status' => $request->status,
          ];

      if($request->hasFile('image') && $file = $request->file('image')) {
          if($file->isValid()) {
              $storedFileArray = FileService::updateAndStoreFile($file,'/',$item->image_path);
              $input['image_path'] = $storedFileArray['stored_file_path'] ?? '';
          }
      }

      $result = $item->update($input);

      updatedResponse("Item Updated Successfully");

      return redirect()->route('items.index');
  }


  public function rules($id="") {

      $rules = array();

      $rules['session_type'] = 'required|exists:session_types,id,status,'._active();
      $rules['opening_time'] = 'required|date_format:H:i';
      $rules['closing_time'] = 'required|date_format:H:i|after:opening_time';          
      $rules['delivery_time'] = 'required|date_format:H:i|after:opening_time|after:closing_time';          
      $rules['session_date'] = 'required|date|after:yesterday';      
      $rules['status'] = 'required|boolean';

      $rule['menu_items'] = 'required|array|min:1';
      $rule['menu_items.*.item_id'] = 'sometimes|exists:items,id,status,'._active();
      $rule['menu_items.*.quantity'] = 'sometimes|integer';
      $rule['menu_items.*.quantity_type_id'] = 'sometimes|exists:quantity_types,id,status,'._active();
      $rule['menu_items.*.complimentaries'] = 'sometimes|array';
      $rule['menu_items.*.price'] = 'sometimes|integer';
      $rule['menu_items.*.status'] = 'sometimes|boolean';

      return $rules;
  }

  public function messages() {
      return [];
  }

  public function attributes() {
      return [];
  }

}
