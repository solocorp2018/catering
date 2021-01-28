<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\ContactUs;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $results = ContactUs::getQueriedResult();
        
        return view('admin.leads.list',compact('results'));   

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contactUs = new ContactUs();
        $result = $contactUs->find($id);

        if($result->status != 1) {
            $result->update(['status'=>1]);    
        }
        

        return view('admin.leads.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }

    private function rules() {
        $rules = array();
        $rules['name'] = 'required|string|min:2|max:100';
        $rules['email'] = 'required|email|string|min:5|max:100';
        $rules['phone'] = 'required|string|min:10|max:15';
        $rules['message'] = 'required|string|min:10|max:500';
        return $rules;
    }
}
