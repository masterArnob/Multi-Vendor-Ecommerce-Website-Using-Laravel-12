<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminFlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminFlashSaleItemDataTable $dataTable)
    {
        $flashSale = FlashSale::first();
        $products = Product::where(['status' => 1, 'is_approved' => 1])->get();
        return $dataTable->render('admin.flash-sale.index', compact('flashSale', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($id);
        return view('admin.flash-sale.edit', compact('flashSaleItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        if ($request->date === 'date') {
            $request->validate([
                'end_date' => ['required', 'date']
            ]);
            $flashSale = FlashSale::updateOrCreate(
                ['id' => $id],
                ['end_date' => $request->end_date]
            );
            notyf()->success('End Date Created Successfully!');
            return redirect()->back();
        } else if ($request->flash_products === 'flash_products') {
            //dd($request->all());
            $request->validate([
                'product_id' => ['required', 'array'], // Ensure product_id is an array
                'product_id.*' => ['required', 'exists:products,id'], // Each product_id must exist in the products table
                'status' => ['required', 'boolean']
            ], [
                'product_id.required' => 'Please select at least one product.',
                'product_id.*.required' => 'Each selected product is required.',
                'product_id.*.exists' => 'One or more selected products are invalid.',
            ]);


            $productIds = $request->product_id;
            $addedCount = 0;

            foreach ($productIds as $productId) {
                $exists = FlashSaleItem::where('product_id', $productId)
                    ->exists();

                if (!$exists) {
                    // Save new FlashSaleItem only if it doesn't exist
                    $flashSaleItem = new FlashSaleItem();
                    $flashSaleItem->product_id = $productId;
                    $flashSaleItem->flash_sale_id = 1;
                    $flashSaleItem->show_at_home = $request->show_at_home;
                    $flashSaleItem->status = $request->status;
                    $flashSaleItem->save();
                    $addedCount++;
                }
            }
            if ($addedCount > 0) {
                notyf()->success("$addedCount product(s) added successfully!");
                return redirect()->back();
            } else {
                notyf()->error('No new products were added as they already exist in the flash sale.');
                return redirect()->back();
            }
        }else if($request->item_edit === 'item_edit'){
            $request->validate([
                'show_at_home' => ['required', 'boolean'],
                'status' => ['required', 'boolean']
            ]);
            $flashSaleItem = FlashSaleItem::findOrFail($id);
            $flashSaleItem->show_at_home = $request->show_at_home;
            $flashSaleItem->status = $request->status;
            $flashSaleItem->save();
            notyf()->success("Flash sale product updated successfully!");
            return redirect()->route('admin.flash-sale.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($id);
         $flashSaleItem->delete();
        notyf()->success("Flash sale product deleted successfully!");
        return response(['status' => 'success']);
    }
}
