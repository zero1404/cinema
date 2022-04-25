<div class="row">
    <div class="col-12 mb-4 mx-auto">
        <div class="card">
            <h5 class="card-header">Sửa {{ $name }}</h5>
            <div class="card-body">
                <form method="POST" action="{{ route($route, $id) }}">
                    @csrf
                    @method('PATCH')

                    {{ $slot }}
                    <div class="form-group my-3">
                        <button class="btn btn-success text-white" type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>