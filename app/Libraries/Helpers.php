<?php

use App\Models\Cart;
use App\Models\Movie;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

  public static function getListMenuCategory()
  {
    return Category::getParentCategories();
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

  public static function getStatusOrder($status)
  {
    switch ($status) {
      case 'new':
        return 'Đang chờ xác nhận';
      case 'accepted':
        return 'Chấp nhận';
      case 'delivering':
        return 'Đang vận chuyển';
      case 'cancel':
        return 'Đã huỷ';
      case 'done':
        return 'Hoàn thành';
      default:
        return '';
    }
  }

  public function displayStatusOrder(string $status): string
  {
    switch ($status) {
      case 'new':
        return '<span class="badge badge-sm bg-secondary ms-1">Mới</span>';
      case 'accepted':
        return '<span class="badge badge-sm bg-primary ms-1">Đã xác nhận</span>';
      case 'delivering':
        return '<span class="badge badge-sm bg-info ms-1">Đang vận chuyển</span>';
      case 'cancel':
        return '<span class="badge badge-sm bg-danger ms-1">Đã huỷ</span>';
      default:
        return '<span class="badge badge-sm bg-success ms-1">Hoàn thành</span>';
    }
  }

  public function displayStatusProgress(string $status, int $position): string
  {
    $dataStatus = ['new', 'accepted', 'delivering', 'cancel', 'done'];
    if ($status == 'cancel') return 'step-cancel';
    return array_search($status, $dataStatus) >= $position ? 'active' : '';
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

  public function formatTimeNotify($time)
  {
    Carbon::setLocale('vi');
    $data = Carbon::create($time);
    $now = Carbon::now();
    return $data->diffForHumans($now);
  }
}
