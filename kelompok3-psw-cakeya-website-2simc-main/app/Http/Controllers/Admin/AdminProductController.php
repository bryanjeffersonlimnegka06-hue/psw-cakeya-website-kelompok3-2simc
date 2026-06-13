<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Show all products
     */
    public function index()
    {
        try {
            $cakes = DB::table('cake')
                ->select('cake_id as id', 'cake_name', 'cost', 'description', 'pic', 'penjualan', 'created_at', 'updated_at')
                ->orderBy('cake_id', 'desc')
                ->paginate(10);

            return view('admin-dashboard-page.admin.products', compact('cakes'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch products: ' . $e->getMessage());
        }
    }

    /**
     * Show create product form
     */
    public function create()
    {
        return view('admin-dashboard-page.admin.create-product');
    }

    /**
     * Store product in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cake_name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('pic')) {
                $image = $request->file('pic');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('product-image'), $imageName);
                $validated['pic'] = $imageName;
            }

            $validated['penjualan'] = 0;
            DB::table('cake')->insert($validated);

            return redirect()->route('admin.products')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add product: ' . $e->getMessage());
        }
    }

    /**
     * Show edit product form
     */
    public function edit($id)
    {
        try {
            $cake = DB::table('cake')
                ->select('cake_id as id', 'cake_name', 'cost', 'description', 'pic', 'penjualan', 'created_at', 'updated_at')
                ->where('cake_id', $id)
                ->first();

            if (!$cake) {
                return redirect()->route('admin.products')->with('error', 'Product not found.');
            }
            return view('admin-dashboard-page.admin.edit-product', compact('cake'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch product: ' . $e->getMessage());
        }
    }

    /**
     * Update product in database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'cake_name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $cake = DB::table('cake')->where('cake_id', $id)->first();
            if (!$cake) {
                return redirect()->route('admin.products')->with('error', 'Product not found.');
            }

            if ($request->hasFile('pic')) {
                // Delete old image if exists
                if ($cake->pic && file_exists(public_path('product-image/' . $cake->pic))) {
                    unlink(public_path('product-image/' . $cake->pic));
                }

                $image = $request->file('pic');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('product-image'), $imageName);
                $validated['pic'] = $imageName;
            }

            DB::table('cake')->where('cake_id', $id)->update($validated);

            return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        try {
            $cake = DB::table('cake')->where('cake_id', $id)->first();
            if (!$cake) {
                return redirect()->route('admin.products')->with('error', 'Product not found.');
            }

            // Delete image if exists
            if ($cake->pic && file_exists(public_path('product-image/' . $cake->pic))) {
                unlink(public_path('product-image/' . $cake->pic));
            }

            DB::table('cake')->where('cake_id', $id)->delete();

            return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
