<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\StockLog;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = PurchaseOrder::with('supplier')->paginate(20);
        return view('dashboard.purchase_orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('dashboard.purchase_orders.create', compact('suppliers', 'products'));
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


        $total = 0;
        foreach ($data['items'] as $it) {
            $total += $it['quantity'] * $it['unit_price'];
        }


        DB::transaction(function() use ($data, $total, $request) {


            $order = PurchaseOrder::create([
                'order_number' => 'PO-'.time(),
                'supplier_id' => $data['supplier_id'],
                'status' => $request->input('status', 'received'),
                'total' => $total,
                'created_by' => auth()->id(),
            ]);


            foreach ($data['items'] as $it) {
                $lineTotal = $it['quantity'] * $it['unit_price'];

                PurchaseOrderItem::create([
                    'purchase_order_id' => $order->id,
                    'product_id' => $it['product_id'],
                    'quantity' => $it['quantity'],
                    'unit_price' => $it['unit_price'],
                    'line_total' => $lineTotal,
                ]);

                if ($order->status === 'received') {

                    Product::where('id', $it['product_id'])->increment('quantity', $it['quantity']);


                    StockLog::create([
                        'product_id' => $it['product_id'],
                        'change' => $it['quantity'],
                        'type' => 'purchase_in',
                        'reference_id' => $order->id,
                        'user_id' => auth()->id(),
                        'note' => 'Received via PO '. $order->order_number,
                    ]);
                }
            }
        });

        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order created.');
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
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load('items.proudct', 'supplier');
        $supplier = Supplier::all();

        return view('dashboard.purchase-orders.edit', compact('purchaseOrder', 'suppliers'));
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
