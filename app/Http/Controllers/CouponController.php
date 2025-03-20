<?php
namespace App\Http\Controllers;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // Display a listing of coupons
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    // Show the form for creating a new coupon
    public function create()
    {
        return view('coupons.create');
    }

    // Store a newly created coupon in the database
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'discount' => 'required|numeric|min:0',
            'expiration_date' => 'required|date'
        ]);

        Coupon::create($request->all());
        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    // Show the form for editing the specified coupon
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupons.edit', compact('coupon'));
    }

    // Update the specified coupon in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $id,
            'discount' => 'required|numeric|min:0',
            'expiration_date' => 'required|date'
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    // Remove the specified coupon from the database
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
