<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('dashboard.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.order.create');
    }

    /**
     * Store a ewly ncreated resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('dashboard.order.detail', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('dashboard.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $messages = [
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'note' => 'Ghi chú phải là chuỗi kí tự'
        ];

        $this->validate($request, [
            'status' => 'required|in:new,accepted,delivering,cancel,done',
            'note' => 'nullable|string',
        ], $messages);

        $data = $request->all();

        if ($request->status == 'accepted') {
            foreach ($order->items as $item) {
                $product = $item->product;
                $product->quantity -= $item->quantity;
                $product->save();
            }
        }

        if (($order->status == 'accepted' || $order->status == 'delivering') && $request->status == 'cancel') {
            foreach ($order->items as $item) {
                $product = $item->product;
                $product->quantity += $item->quantity;
                $product->save();
            }
        }

        $status = $order->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật đơn hàng thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $status = $order->delete();
            if ($status) {
                request()->session()->flash('success', 'Xoá thành công đơn đặt hàng');
            } else {
                request()->session()->flash('error', 'Không thể xoá đơn đặt hàng');
            }
            return redirect()->route('order.index');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            return redirect()->back();
        }
    }

    public function incomeChart(Request $request)
    {
        if ($request->ajax()) {
            $year = Carbon::now()->year;
            $items = Order::with(['items'])->whereYear('created_at', $year)->where('status', 'done')->get()
                ->groupBy(function ($d) {
                    return Carbon::parse($d->created_at)->format('m');
                });

            $result = [];
            foreach ($items as $month => $item_collections) {
                foreach ($item_collections as $item) {
                    $amount = $item->items->sum('price');
                    $m = intval($month);
                    isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
                }
            }
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthName = date('F', mktime(0, 0, 0, $i, 1));
                $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
            }
            return $data;
        }
    }
}
