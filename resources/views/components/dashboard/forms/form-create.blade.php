<div class="row">
    <div class="col-12 mb-4 mx-auto">
        <div class="card">
            <h5 class="card-header">Tạo {{ $name }}</h5>
            <div class="card-body">
                <form method="POST" action=" {{ route($route) }}">
                    @csrf

                    {{ $slot }}
                    <div class="form-group my-3">
                        <button class="btn btn-success text-white" type="submit">Tạo</button>
                        <button type="reset" class="btn btn-warning text-white">Xoá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>