<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Exports\OrdersExport;
use App\Models\Payment;
use App\Models\SessionType;
use App\Models\SessionMenu;
use Auth;
use PDF;
use Validator;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    { 
        $results = Order::getQueriedResult();

        $sessionTypeModel = new SessionType();
        
        $sessionType = $sessionTypeModel->getActiveRecord();        
        $paymentStatus = paymentStatuses();
        $paymentMode = paymentModes();
        //dd($results);
        return view('admin.orders.list',compact('results','sessionType','paymentStatus','paymentMode'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Order::with(['processedBy','deliveredBy','orderItems','deliveredAddress','sessionMenu'])->find($id);
        
        return view('admin.orders.show',compact('result'));
    }

    public function orderSplitup() {

      $sessionTypeModel = new SessionType();
        
      $sessionType = $sessionTypeModel->getActiveRecord();   

      $results = SessionMenu::getOrderItemWiseCount();

      $results = $this->splitupPreparation($results);

      $activeSessionType = $sessionType->where('id',request('session'))->first();

      return view('admin.orders.splitup',compact('results','sessionType','activeSessionType'));
    }

    public function splitupPreparation(array $data) {      
      $splitupData = array();      
      
      foreach ($data as $key => $sessionData) {
          
          $sessionWiseData = array();
          $sessionWiseData['session_type_name'] = $sessionData['session_type']['type_name'] ?? '';
          $sessionWiseData['session_menu_id'] = $sessionData['id'] ?? '';
          $sessionWiseData['session_code'] = $sessionData['session_code'] ?? '';
          $sessionWiseData['menu_items'] = array();

          foreach ($sessionData['menu_item'] as $key => $menuItem) {

              $menuItemData = array();
              $menuItemData['menu_item_id'] = $menuItem['id'] ?? '';              
              $menuItemData['menu_quantity'] = $menuItem['quantity'] ?? '';
              $menuItemData['menu_quantity_type_name'] = $menuItem['quantity_type']['name'] ?? '';              
              $menuItemData['menu_price'] = $menuItem['price'] ?? '';

              $menuItemData['item_id'] = $menuItem['items']['id'] ?? '';
              $menuItemData['item_name'] = $menuItem['items']['name'] ?? '';
              $menuItemData['item_name_lang_1'] = $menuItem['items']['lang1_name'] ?? '';
              $menuItemData['item_unit_price'] = $menuItem['items']['price'] ?? '';
              $menuItemData['item_image'] = $menuItem['items']['image_path'] ?? '';
              $menuItemData['item_description'] = $menuItem['items']['description'] ?? '';
              $menuItemData['item_description_lang_1'] = $menuItem['items']['lang1_description'] ?? '';
              $menuItemData['item_quantity_type_name'] = $menuItem['quantity_type']['name'] ?? '';

              $complimentaries = array();
              if(!empty($menuItem['menu_complimentaries'])) {
                foreach ($menuItem['menu_complimentaries'] as $key => $menuComplimentary) {
                   $complimentaries[] = $menuComplimentary['complimentaries']['name'] ?? '';
                }
              }
              
              $menuItemData['complimentaries'] = implode(', ',$complimentaries);

              $orderItemCount = 0;

              if(!empty($sessionData['orders'])) {

                  foreach ($sessionData['orders'] as $key => $orderItems) {
                      $currentItemCount = 0;
                      $currentItemCount = collect($orderItems['order_items'])->where('menu_item_id',$menuItemData['item_id'])->sum('quantity');
                      $orderItemCount = $orderItemCount+$currentItemCount;                   
                  }
              }              
             
              $menuItemData['menu_item_order_quantity'] = $menuItemData['menu_quantity'] * $orderItemCount;

              $sessionWiseData['menu_items'][] = $menuItemData;
          }

          $splitupData[] = $sessionWiseData;
      }

      return $splitupData;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function export() 
    {   
        
        $fileName = 'orders-list-'.date('d-m-Y').'.csv';
        return Excel::download(new OrdersExport,$fileName);
    }
    
    public function updatePaymentStatuses(Request $request) {

    	$rules = [
    		'captureArray' => 'required|array'
    	];
    	$validator = Validator::make($request->all(),$rules);

		if($validator->fails()) {
			return response()->json(['message'=>'Validation Error !','errors'=>$validator->errors()]);
		}

	  	$orderIds = $request->get('captureArray');

	   $orders = Order::find($orderIds);    

		  $paymentModel = new Payment();     

		foreach ($orders as $key => $order) {
			
			$input = [
			  'order_id' => $order->id,
			  'payment_unique_id'=> $paymentModel->paymentUniqueid(),
			  'payment_date' => today(),
			  'amount' => $order->total_amount,
			  'payment_mode' => 5,
			  'transaction_id' => $request->transaction_id ?? '',
			  'comments' => $request->comments ?? '',
			  'recieved_by'=> Auth::user()->id,
			  'paid_by'=> $order->customer_id,
			  'payment_status'=> 2,
			];      

      updatedResponse("Payment Status Updated Successfully !");
			$createPayment = Payment::create($input); 
		}
		
		return sendResponse([],'Payment Status Captured Successfully !');		
    }

    public function updateStatus(Request $request, $id) {

      $order_id = $id;
      $orders = Order::find($id);    
      $paymentModel = new Payment();     

      $input = [
              'order_id' => $order_id,
              'payment_unique_id'=> $paymentModel->paymentUniqueid(),
              'payment_date' => $request->payment_date,
              'amount' => $orders->total_amount,
              'payment_mode' => $request->payment_mode,
              'transaction_id' => $request->transaction_id ?? '',
              'comments' => $request->comments ?? '',
              'recieved_by'=> Auth::user()->id,
              'paid_by'=> $orders->customer_id,
              'payment_status'=> 2,
      ];      

      $createPayment = Payment::create($input);    
      updatedResponse("Payment Status Updated Successfully !");
      return redirect()->back();
    }

    


    public function invoiceDownload($id) {      

      $result = Order::with(['processedBy','deliveredBy','orderItems.item','deliveredAddress'])->find($id);

      
      $html = view('admin.pdf.invoice1',compact('result'))->render();
      $pdf = \App::make('dompdf.wrapper'); 
      $pdf->setPaper('a4', 'horizontal');     
      $pdf->loadHTML($html);
      return $pdf->download($result->order_unique_id.'.pdf');     
    }

     public function bulkInvoiceDownload(Request $request) {

      $rules = [
        'invoiceIds' => 'required'
      ];
      $validator = Validator::make($request->all(),$rules);

      if($validator->fails()) {
        return redirect()->back()->withError($validator->errors());
      }

      $orderIds = json_decode($request->get('invoiceIds'),true);

      $orders = Order::with(['processedBy','deliveredBy','orderItems.item','deliveredAddress'])->find($orderIds);    

      $html = view('admin.pdf.invoice1bulk',compact('orders'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($html);
      $pdf->setPaper('a4', 'horizontal');
      return $pdf->download('Bulk-Invoice-'.date('d-m-Y').'.pdf');    
    }
    



}
