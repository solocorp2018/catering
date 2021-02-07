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

      $sessionTypes = $this->sessionTypeModel->getActiveRecord();
      $menuItems = $this->itemsModel->getActiveRecord();
      $complimentaries = $this->complimentaryModel->getActiveRecord();
      $quantityTypes = $this->quantityTypeModel->getActiveRecord();

      //dd($sessionTypes);
      return view('admin.sessionMenus.create',compact('statuses','quantityTypes','sessionTypes','menuItems','complimentaries'));
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
              'session_type_id' => $request->session_type,
              'opening_time' => $request->opening_time,
              'closing_time' => $request->closing_time,
              'session_date' => $request->session_date,
              'delivery_time' => $request->delivery_time,

              'status' => $request->status,
              'created_by'=> Auth::user()->id
          ];

      $sessionMenu = SessionMenu::create($input);

      $quantities = $request->quantity;
      foreach ($quantities as $i => $quantity) {

          $menuItemsInput = [
            'session_menu_id' => $sessionMenu->id,
            'item_id' => $request->menu_items[$i],
            'quantity_type_id' => $request->quantity_type[$i],
            'quantity' => $request->quantity[$i],
            'price' => $request->price[$i],
            'status' => 1
          ];
          $menuItem = MenuItem::create($menuItemsInput);
          $complimentaryname = 'complimentaries_'.$i;

          if(isset($request->$complimentaryname)) {

            $complimentaris = $request->$complimentaryname;
            $explodeComplimentary = explode(',',$complimentaris[0]);

            foreach($explodeComplimentary as $j => $complimentary) {

              $menuComplimentary = [
                'menu_id' => $sessionMenu->id,
                'menu_item_id' => $menuItem->id,
                'complimentary_id' => $complimentary,
                'status' => 1
              ];

              MenuItemComplimentary::create($menuComplimentary);
            }
          }
        }

      createdResponse("Menus Created Successfully");

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
       return view('admin.sessionMenus.show',compact('result'));
   }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Item  $item
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $result = SessionMenu::with(['menuItem','sessionType'])->find($id);
      $statuses = _getGlobalStatus();

      $sessionTypes = $this->sessionTypeModel->getActiveRecord();
      $menuItems = $this->itemsModel->getActiveRecord();
      $complimentaries = $this->complimentaryModel->getActiveRecord();
      $quantityTypes = $this->quantityTypeModel->getActiveRecord();
      return view('admin.sessionMenus.edit',compact('result','sessionTypes','menuItems','complimentaries','quantityTypes','statuses'));
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

      $sessionMenu = SessionMenu::find($id);

      $input = array();
      $input = [
              'session_type_id' => $request->session_type,
              'opening_time' => $request->opening_time,
              'closing_time' => $request->closing_time,
              'session_date' => $request->session_date,
              'delivery_time' => $request->delivery_time,
              'status' => $request->status
          ];

      $result = $sessionMenu->update($input);

      updatedResponse("Session Menus Updated Successfully");

      return redirect()->route('sessionMenus.index');
  }


  public function rules($id="") {

      $rules = array();

      $rules['session_type'] = 'required|exists:session_types,id,status,'._active();
      $rules['closing_time'] = 'required|date_format:hh:mm:ss';
      //$rules['opening_time'] = 'required|min:2|max:200';
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

  public function updateItems(Request $request,$id) {

    $input = array();
    //dd($request);
    $menuItemsInput = [
      'session_menu_id' => $request->session_menu_id,
      'item_id' => $request->modal_menu_item,
      'quantity_type_id' => $request->modal_quantity_type,
      'quantity' => $request->modalQuantity,
      'price' => $request->modalprice,
      'status' => 1
    ];

    if($id != 0) {
      $menuItem = MenuItem::find($id);
      $menuItem->update($menuItemsInput);
      $deleteRows = MenuItemComplimentary::where('menu_item_id',$menuItem->id)->delete();
    } else {
      $menuItem = MenuItem::create($menuItemsInput);
    }

    if(isset($request->modalcomplimentaries)) {

      $complimentaris = $request->modalcomplimentaries;
      //$explodeComplimentary = explode(',',$complimentaris);

      foreach($complimentaris as $j => $complimentary) {

        $menuComplimentary = [
          'menu_id' => $request->session_menu_id,
          'menu_item_id' => $menuItem->id,
          'complimentary_id' => $complimentary,
          'status' => 1
        ];

        MenuItemComplimentary::create($menuComplimentary);
      }
    }

    return back();
  }

}
