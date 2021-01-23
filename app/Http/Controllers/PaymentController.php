<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
//use DataTables;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }


    public function create()
    {
        return view('payment.create');
    }


    public function store(PaymentRequest $request)
    {
        session()->flash('success','berhasil menambahkan data');
        return Payment::create($request->all());

    }


    public function get()
    {
        return Payment::get();
    }

    public function delete($id)
    {
        Payment::findOrFail($id)->delete();
        //session()->flash('success', 'berhasil delete data!');
        return true;
    }
}
