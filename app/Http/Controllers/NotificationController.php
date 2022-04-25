<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        return view('dashboard.notification.index');
    }

    public function markAsRead(Request $request)
    {
        if ($request->ajax()) {
            $ids = (array) $request->input('ids');
            $notifications = Auth::user()->notifications->find($ids);
            if (is_array($notifications) || ($notifications instanceof \Traversable)) {
                foreach ($notifications as $notification) {
                    $notification->markAsRead();
                }
            } else {
                $notifications->markAsRead();
            }
            return response()->json(['data' => $notifications->pluck('id')]);
        }
        return abort(404);
    }

    public function show(Request $request)
    {
        $notification = Auth::user()->notifications->where('id', $request->id)->first();

        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['actionURL']);
        }
    }


    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $ids = (array) $request->input('ids');
            $notifications = Auth::user()->notifications->find($ids);
            try {
                if (is_array($notifications) || ($notifications instanceof \Traversable)) {
                    foreach ($notifications as $notification) {
                        $notification->delete();
                    }
                } else {
                    $notifications->delete();
                }
                return response()->json([], 204);
            } catch (\Exception $e) {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
                return response()->json(['message' => 'Có lỗi xảy ra'], 400);
            }
        }
        return abort(404);
    }

    public function delete($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $status = $notification->delete();

            if ($status) {
                request()->session()->flash('success', 'Xoá thông báo thành công');
                return back();
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
                return back();
            }
        } else {
            request()->session()->flash('error', 'Thông báo không tồn tại');
            return back();
        }
    }
}
