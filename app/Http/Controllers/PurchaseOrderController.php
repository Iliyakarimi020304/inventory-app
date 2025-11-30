<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\StockLog;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'status' => 'sometimes|in:pending,received,cancelled',
        ]);

        // Compute totals
        $total = 0;
        foreach ($data['items'] as $it) {
            $total += $it['quantity'] * $it['unit_price'];
        }

        $order = PurchaseOrder::create([
            'order_number' => 'PO-'.time(),
            'supplier_id' => $data['supplier_id'],
            'status' => $request->input('status','received'),
            'total' => $total,
            'created_by' => auth()->id()
        ]);

        foreach ($data['items'] as $it) {
            $lineTotal = $it['quantity'] * $it['unit_price'];

            $poi = PurchaseOrderItem::create([
                'purchase_order_id' => $order->id,
                'product_id' => $it['product_id'],
                'quantity' => $it['quantity'],
                'unit_price' => $it['unit_price'],
                'line_total' => $lineTotal,
            ]);

            // If status received, increase stock and create log
            if ($order->status === 'received') {
                $product = Product::find($it['product_id']);
                $product->quantity += $it['quantity'];
                $product->save();

                StockLog::create([
                    'product_id' => $product->id,
                    'change' => $it['quantity'],
                    'type' => 'purchase_in',
                    'reference_id' => $order->id,
                    'user_id' => auth()->id(),
                    'note' => 'Received via PO '. $order->order_number,
                ]);
            }
        }

        return redirect()->route('purchase-orders.show', $order->id)
            ->with('success', 'Purchase order created.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
