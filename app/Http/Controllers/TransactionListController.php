<?php

namespace App\Http\Controllers;

use App\Models\TransactionList;
use Illuminate\Http\Request;

class TransactionListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TransactionList =  TransactionList::all();
        return view('Transaction.index',compact('TransactionList'));
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
     * @param  \App\Models\TransactionList  $transactionList
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionList $transactionList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionList  $transactionList
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionList $transactionList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionList  $transactionList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionList $transactionList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionList  $transactionList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionList $transactionList)
    {
        //
    }
}
