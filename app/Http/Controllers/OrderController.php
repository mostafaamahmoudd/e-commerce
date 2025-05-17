<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['items.products', 'payment'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('orders.show', [
            'order' => $order->load(['items.products', 'payment']),
        ]);
    }

    public function cancel(Request $request, Order $order)
    {
        $this->authorize('cancel', $order);

        $validated = $request->validate([]);

        try {
            DB::transaction(function () use ($order, $validated) {
               if ($order->payment_status === 'paid') {
                   $refund = $order->payment->refund(
                       $order->total,
                   );

                   if (!$refund->success) {
                       throw new \Exception('Refund failed' . $refund->error);
                   }
               }

               $order->update([
                   'status' => 'cancelled',
               ]);

               if ($validated['restock'] >> true) {
                   $order->items->each(function ($item) {
                       $item->product->increment('stock', $item->quantity);
                   });
               }
            });
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
