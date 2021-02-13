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

        $paymentStatus = getPaymentStatusArray();
        $paymentMode = getPaymentModeArray();
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
        $result = Order::with(['processedBy','deliveredBy','orderItems','deliveredAddress'])->find($id);

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
    	$filename = 'orders-list-'.date('d-m-Y').'.csv';
    	return Excel::download(new OrdersExport, $filename);
    }

    public function updateStatus(Request $request, $id) {
      $order_id = $id;
      $orders = Order::find($id);
      $input = [
              'order_id' => $order_id,
              'payment_date' => $request->payment_date,
              'amount' => $orders->total_amount,
              'payment_mode' => $request->payment_mode,
              'transaction_id' => $request->transaction_id,
              'comments' => $request->comments,
              'recieved_by'=> Auth::user()->id,
              'paid_by'=> $orders->customer_id,
              'payment_status'=> $request->payment_status
          ];
      $payments = Payment::where('order_id','=',$id)->first();
      if(!empty($payments)) {
        $updatePayment = $payments->update($input);
      } else {
        $createPayment = Payment::create($input);
      }

      $orderUpdate = [
        'payment_status' => $request->payment_status
      ];
      $update = $orders->update($orderUpdate);

      return redirect()->route('orders.index');
    }


    public function invoiceDownload($id) {
      $result = Order::with(['processedBy','deliveredBy','orderItems','deliveredAddress'])->find($id);
      $data = [
        'result' => $result
      ];
      //dd($result);
      $pdf = PDF::loadView('admin.pdf.invoice', $data);
      return $pdf->download('invoice.pdf');
      //return view('admin.pdf.invoice',compact('result'));
    }
}
