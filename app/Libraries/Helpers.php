<?php

use App\Models\Movie;
use App\Models\Booking;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class Helpers
{

  public static function formatDate($date)
  {
    return Carbon::parse($date)->format('d/m/Y');
  }

  public static function formatCurrency($currency)
  {
    return number_format($currency, 0, ',', '.') . 'đ';
  }

  public static function getListCategory()
  {
    return Category::all();
  }

  public static function getRandomMovie()
  {
    if (Movie::count() > 4) {
      return Movie::all()->random(4);
    }
    return Movie::all();
  }

  public static function generateOrderNumber($last_id)
  {
    return '#' . str_pad($last_id + 1, 10, "0", STR_PAD_LEFT);
  }

  public static function getStatusBooking($status)
  {
    switch ($status) {
      case 'paid':
        return 'Đã thanh toán';
      case 'unpaid':
        return 'Chưa thanh toán';
      case 'canceled':
        return 'Đã huỷ';
      default:
        return '';
    }
  }

  public static function displayStatusBooking(string $status): string
  {
    switch ($status) {
      case 'paid':
        return '<span class="badge badge-sm bg-success ms-1">Đã thanh toán</span>';
      case 'unpaid':
        return '<span class="badge badge-sm bg-primary ms-1">Chưa thanh toán</span>';
      case 'canceled':
        return '<span class="badge badge-sm bg-danger ms-1">Đã huỷ</span>';
      default:
        return '';
    }
  }


  public static function getPaginateList()
  {
    return [4, 8, 12, 16, 20, 24, 28];
  }

  public static function getUserAvatar($path)
  {
    if( File::exists($path)) {
      return  asset($path);
    }

    if($path) return $path;
    return  env('DEFAULT_AVATAR_URL');
  }

  public static function getMovieImage($path)
  {
    if( File::exists($path)) {
      return  asset($path);
    }

    if($path) return $path;
    return env('DEFAULT_MOVIE_URL');
  }

  public static function formatTimeNotify($time)
  {
    Carbon::setLocale('vi');
    $data = Carbon::create($time);
    $now = Carbon::now();
    return $data->diffForHumans($now);
  }

  public static function getAmountBooking($show, $seats) {
    $total = $show->price ?? 0;
    
    foreach($seats as $seat) {
      $total += $seat->typeSeat->price;
    }

    return $total;
  }

  public static function getNowTime() {
    return \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('H:i');
  }

  public static function disableUnpaidSeat() {
    $booking_unpaid = Booking::where('status', 'unpaid')->where('created_at', '<=', Carbon::now('Asia/Ho_Chi_Minh')->subMinute(15))->get();
    foreach($booking_unpaid as $booking) {
        $booking->update([
            'status' => 'canceled',
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        foreach($booking->tickets as $ticket) {
            $ticket->fill(['status' => 'canceled'])->save();
        }
    }
  }
}
