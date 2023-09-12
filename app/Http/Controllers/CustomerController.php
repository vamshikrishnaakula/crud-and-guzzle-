<?php

namespace App\Http\Controllers;
use App\Models\Customer;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query();

        if ($request->has('filter_date')) {
            $customers->whereDate('created_at', $request->filter_date);
        }

        $customers = $customers->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers,email',
           //'email' => ['required', 'email', Rule::unique('customers', 'email')],
            //'phone' => 'required|string|size:10|unique:customers,phonenumber',
            'phone' => [
                'required', 'string', 'size:10', 'unique:customers,phonenumber',
                'regex:/^(?:(?:\+|0{0,2})91(\s*[\ -]\s*)?|[0]?)?[6789]\d{9}$/',
            ],
            'date_of_birth' => 'required|date',
        ]);
       //    return $request->date_of_birth;

            $customer = new Customer;
            $customer->name = $request->first_name . ' ' . $request->last_name;
            //return $request->email;
            $customer->email = $request->email;
            $customer->phonenumber = $request->phone;
            $customer->date_of_birth = $request->date_of_birth;
            $customer->save();

        return redirect()->route('customers.index')->with('success', 'USER CREATED SUCCESSFULLY');
    }
    //
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }
    //
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' =>  'required|email|unique:customers,email,'.$id,
        ]);

        $customer = Customer::find($id);
        $customer->name = $request->first_name . ' ' . $request->last_name;
        $customer->email = $request->email;
        $customer->save();


        return redirect()->route('customers.index')->with('success', 'USER Updated SUCCESSFULLY');
    }
}