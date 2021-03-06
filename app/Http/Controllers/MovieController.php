<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Language;
use App\Models\Category;
use App\Models\Actor;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::orderBy('movie_id', 'DESC')->get();
        return view('dashboard.movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        $categories = Category::all();
        $actors = Actor::all();
        return view('dashboard.movie.create', compact('languages', 'categories', 'actors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống',
            'title.string' => 'Tiêu đề phải là chuỗi kí tự',
            'title.max' => 'Tiêu đề không được lớn hơn 255 kí tự',
            'description.required' => 'Mô tả không được bỏ trống',
            'description.string' => 'Mô tả phải là chuỗi kí tự',
            'images.required' => 'Ảnh không được bỏ trống',
            'images.string' => 'Ảnh phải là chuỗi kí tự',
            'trailer.string' => 'Trailer không được bỏ trống',
            'trailer.string' => 'Trailer phải là chuỗi kí tự',
            'duaration.required' => 'Thời lượng không được bỏ trống',
            'duaration.string' => 'Thời lượng phải là chuỗi',
            'director.required' => 'Đạo diễn không được bỏ trống',
            'director.string' => 'Đạo diễn phải là chuỗi',
            'release_date.required' => 'Ngày phát hành không được bỏ trống',
            'release_date.date' => 'Ngày phát hành không hợp lệ',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $this->validate($request, [
            'title' => 'required|string|min:1|max:255',
            'description' => 'required|string',
            'images' => 'required|string',
            'trailer' => 'required|string',
            'duaration' => 'required|string',
            'release_date' => 'required|date',
            'director' => 'required|string',
            'category_ids' => 'required|exists:categories,category_id',
            'actor_ids' => 'required|exists:actors,actor_id',
            'language_id' => 'required|exists:languages,language_id',
            'status' => 'required:|in:active,inactive'
        ], $messages);

        $data = $request->all();
        $slug = Str::Slug($request->title);
        $count = Movie::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug. '-' . $count;
        }

        $data['slug'] = $slug;
        $createdMovie = Movie::create($data);

        if ($createdMovie) {
            $createdMovie->actors()->attach($data["actor_ids"]);
            $createdMovie->categories()->attach($data["category_ids"]);

            request()->session()->flash('success', 'Tạo phim thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return abort(404, 'Mã phim không tồn tại');
        }

        return view('dashboard.movie.detail', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return abort(404, 'Mã phim không tồn tại');
        }

        $languages = Language::all();
        $categories = Category::all();
        $actors = Actor::all();

        return view('dashboard.movie.edit', compact('movie', 'languages', 'categories', 'actors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return abort(404, 'Mã phim không tồn tại');
        }

        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống',
            'title.string' => 'Tiêu đề phải là chuỗi kí tự',
            'title.max' => 'Tiêu đề không được lớn hơn 255 kí tự',
            'description.required' => 'Mô tả không được bỏ trống',
            'description.string' => 'Mô tả phải là chuỗi kí tự',
            'images.required' => 'Ảnh không được bỏ trống',
            'images.string' => 'Ảnh phải là chuỗi kí tự',
            'trailer.string' => 'Trailer không được bỏ trống',
            'trailer.string' => 'Trailer phải là chuỗi kí tự',
            'duaration.required' => 'Thời lượng không được bỏ trống',
            'duaration.string' => 'Thời lượng phải là chuỗi',
            'director.required' => 'Đạo diễn không được bỏ trống',
            'director.string' => 'Đạo diễn phải là chuỗi',
            'release_date.required' => 'Ngày phát hành không được bỏ trống',
            'release_date.date' => 'Ngày phát hành không hợp lệ',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $this->validate($request, [
            'title' => 'required|string|min:1|max:255',
            'description' => 'required|string',
            'images' => 'required|string',
            'trailer' => 'required|string',
            'duaration' => 'required|string',
            'release_date' => 'required|date',
            'director' => 'required|string',
            'category_ids' => 'required|exists:categories,category_id',
            'actor_ids' => 'required|exists:actors,actor_id',
            'language_id' => 'required|exists:languages,language_id',
            'status' => 'required:|in:active,inactive'
        ], $messages);

        $data = $request->all();
        $updatedMovie = $movie->fill($data)->save();

        if ($updatedMovie) {
            $movie->actors()->sync($data["actor_ids"]);
            $movie->categories()->sync($data["category_ids"]);
            request()->session()->flash('success', 'Cập nhật phim thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return abort(404, 'Mã phim không tồn tại');
        }

        try {
            $movie->categories()->detach();
            $movie->actors()->detach();
            $status = $movie->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xoá phim thành công.');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ((int)$ex->errorInfo[0] === 23000) {
                request()->session()->flash('error', 'Không thể xoá vì tồn tại ràng buộc khoá ngoại!');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        }

        return redirect()->route('movie.index');
    }
}
