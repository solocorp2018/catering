<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Exports\OrdersExport;
use App\Models\Payment;
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
        
        $paymentStatus = paymentStatuses();
        $paymentMode = paymentModes();
        //dd($results);
        return view('admin.orders.list',compact('results','paymentStatus','paymentMode'));
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

    public function export(){

      $orders = Order::getExportQueriedResult();
      // dd($orders->toArray());
    	$filename = 'orders-list-'.date('d-m-Y').'.csv';

    	return Excel::download(new OrdersExport($orders), $filename);
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

      return redirect()->route('orders.index');
    }

    


    public function invoiceDownload($id) {      

      $result = Order::with(['processedBy','deliveredBy','orderItems.item','deliveredAddress'])->find($id);

      
      $data = [
        'result' => $result
      ];
      //dd($result);
      $pdf = PDF::loadView('admin.pdf.invoice1', $data);
      return $pdf->download($result->order_unique_id.'.pdf');
      //return view('admin.pdf.invoice',compact('result'));
    }

     public function bulkInvoiceDownload(Request $request) {

      $rules = [
        'captureArray' => 'required|array'
      ];
      $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
          return response()->json(['message'=>'Validation Error !','errors'=>$validator->errors()]);
        }

      $orderIds = $request->get('captureArray');

      $orders = Order::with(['processedBy','deliveredBy','orderItems.item','deliveredAddress'])->find($orderIds);    

      $data = [
        'results' => $orders
      ];

      $pdf = PDF::loadView('admin.pdf.invoice1bulk', $data);
      return $pdf->stream();
      // return $pdf->download('Bulk-Invoice-'.date('d-m-Y').'.pdf');      
    }
    



}
