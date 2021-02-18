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
use DB;
use Carbon\Carbon;


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
              'opening_time' => $request->opening_time,
              'closing_time' => $request->closing_time,
              'session_code' => SessionMenu::sessionUniqueId(),
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


        $allowToClone = Carbon::parse($result->session_date)->timezone("+05:30")->isPast();

       return view('admin.sessionMenus.show',compact('result','allowToClone'));
   }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\SessionMenu  $sessionMenu
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $result = SessionMenu::with(['menuItem','sessionType'])->find($id);
      
      $statuses = _getGlobalStatus();
      $allowedItemCount = config('catering.allowed_item_limit_for_menu');

      $sessionTypes = $this->sessionTypeModel->getActiveRecord();
      $menuItems = $this->itemsModel->getActiveRecord();
      $complimentaries = $this->complimentaryModel->getActiveRecord();
      $quantityTypes = $this->quantityTypeModel->getActiveRecord();

      

      return view('admin.sessionMenus.edit',compact('result','statuses','quantityTypes','sessionTypes','menuItems','complimentaries','allowedItemCount'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\SessionMenu  $sessionMenu
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request,$id)
  {

      $validator = Validator::make($request->all(),$this->rules($id),$this->messages(),$this->attributes());

      if($validator->fails()) {
          return redirect()->back()->withErrors($validator)
                      ->withInput();
      }

      $sessionMenu = SessionMenu::find($id);


      $input = array();
      $input = [
            'session_type_id' => $request->session_type,           
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'session_date' => $request->session_date,
            'expected_delivery_time' => $request->delivery_time,
            'status' => $request->status,
          ];
          dd($input);
      $result = $sessionMenu->update($input);      

      $menuItems = $request->menu_items ?? [];

      foreach ($menuItems as $key => $itemRow) {

          $itemRow['status'] = (isset($itemRow['status']) && $itemRow['status']==_active())?$itemRow['status']:_inactive();

          if($itemRow['item_id'] && $itemRow['quantity'] && $itemRow['quantity_type_id'] && $itemRow['price']) {

              $whereArray = $menuList = array();

              $whereArray['session_menu_id'] = $id;
              $whereArray['item_id'] = $itemRow['item_id'];

              $menuList['session_menu_id'] = $id;
              $menuList['item_id'] = $itemRow['item_id'];
              $menuList['quantity_type_id'] = $itemRow['quantity_type_id'];
              $menuList['quantity'] = $itemRow['quantity'];
              $menuList['price'] = $itemRow['price'];
              $menuList['status'] = $itemRow['status'] ?? _inactive();
              $menuItem = MenuItem::updateOrCreate($whereArray,$menuList);
              
              if(!empty($itemRow['complimentaries'])) {

                $itemRow['complimentaries'] = is_array($itemRow['complimentaries'])?$itemRow['complimentaries']:Arr::wrap($itemRow['complimentaries']);               

                foreach ($itemRow['complimentaries'] as $key => $complimentaryId) {

                    $whereArray1 = $menuComplimentaryArray = array();

                    $whereArray1['session_menu_id'] = $id;
                    $whereArray1['menu_item_id'] = $menuItem->id;
                    $whereArray1['complimentary_id'] = $complimentaryId;

                    $menuComplimentaryArray['session_menu_id'] = $id;
                    $menuComplimentaryArray['menu_item_id'] = $menuItem->id;
                    $menuComplimentaryArray['complimentary_id'] = $complimentaryId;
                    $menuComplimentaryArray['quantity_type_id'] = 0;
                    $menuComplimentaryArray['quantity'] = 0;
                    $menuComplimentaryArray['status'] = _active();

                    MenuItemComplimentary::updateOrCreate($whereArray1,$menuComplimentaryArray);
                }

                MenuItemComplimentary::whereNotIn('complimentary_id',$itemRow['complimentaries'])
                                        ->where('session_menu_id',$id)
                                        ->where('menu_item_id',$menuItem->id)
                                        ->delete();                
              }
          }
      }

      updatedResponse("Session Menus Updated Successfully");

      return redirect()->route('sessionMenus.index');
  }


  public function rules($id="") {

      $rules = array();

      $rules['session_type'] = 'required|exists:session_types,id,status,'._active();
      if($id) {
        $rules['opening_time'] = 'required|date:d/m/Y H:i A';
        $rules['closing_time'] = 'required|date:d/m/Y H:i A';
        $rules['delivery_time'] = 'required|date:d/m/Y H:i A';
      } else {
        $rules['opening_time'] = 'required|date:d/m/Y H:i A';
        $rules['closing_time'] = 'required|date:d/m/Y H:i A';
        $rules['delivery_time'] = 'required|date:d/m/Y H:i A';
      }

      //$rules['session_date'] = 'required|date|after:yesterday';
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

  public function cloneSession($id) {

    $sessionMenu = SessionMenu::with(['menuItem','sessionType'])->find($id);

    $menuItemsInput = [
      'session_type_id' => $sessionMenu->session_type_id,
      //'session_date'=> now("+05:30"),
      'opening_time' => $sessionMenu->opening_time,
      'closing_time' => $sessionMenu->closing_time,
      'expected_delivery_time' => $sessionMenu->expected_delivery_time,
      'status' => $sessionMenu->status,
      'created_by'=> Auth::user()->id
    ];
    $new_sessionMenu = SessionMenu::create($menuItemsInput);


    foreach($sessionMenu->menuItem as $menuItem) {

      $menuItemsInput = [
        'session_menu_id' => $new_sessionMenu->id,
        'item_id' => $menuItem->item_id,
        'quantity_type_id' => $menuItem->quantity_type_id,
        'quantity' => $menuItem->quantity,
        'price' => $menuItem->price,
        'status' => 1
      ];
      $new_menuItem = MenuItem::create($menuItemsInput);

      foreach($menuItem->menuComplimentaries as $menuComplimentary) {

        $menuComplimentaryInput = [
          'session_menu_id' => $new_sessionMenu->id,
          'menu_item_id' => $new_menuItem->id,
          'complimentary_id' => $menuComplimentary->complimentaries->id,
          'quantity_type_id' => 0,
          'quantity' => 0,
          'status' => $menuComplimentary->status,
        ];
        MenuItemComplimentary::create($menuComplimentaryInput);

      }
    }

    return redirect()->route('sessionMenus.index');
  }

}
