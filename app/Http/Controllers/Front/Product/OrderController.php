<?php


namespace App\Http\Controllers\Front\Product;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     */
    public function get(Request $request, Order $order): JsonResponse
    {
        return response()->json($order);
    }

    public function vendorUpdate(Request $request, Vendor $vendor)
    {
        if(!$vendor->active)
            return response(['status' => false, 'message' => __('Your account is not activated')]);

        $request->validate([
            'payment_status' => 'required|in:pending,refunded,completed',
            'order_status' => 'required|in:pending,shipping,refused,completed',
            'refused_notes' => 'required_if:order_status,refused|max:191',
            'order_id' => 'required|numeric'
        ]);

        /**
         * TODO: Secure the update (Make sure $vendor really have that order)
         */

        $order = Order::findOrFail($request->order_id);

        $order->payment_status = $request->payment_status;
        $order->order_status = $request->order_status;

        if($request->order_status == 'refused')
            $order->refused_notes = $request->refused_notes;

        //Finally, save the order.
        $order->save();

        return back()->with(['message' => __('Order has been updated')]);
    }
}
