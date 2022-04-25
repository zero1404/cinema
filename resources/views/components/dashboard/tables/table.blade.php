<x-Dashboard.Shared.FlashMessage />

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="mt-2 font-weight-bold text-primary float-left">Danh Sách {{ ucwords($name) }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{-- @if (count($value) > 0) --}}
            <table class="table table-bordered" width="100%" cellspacing="0" id="datatable">
                <thead class="thead-light">
                    <tr>
                        @foreach ($columns as $column)
                        <th>{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
            {{-- @else
            <h6 class="text-center">Danh sách {{ $name }} trống.</h6>
            @endif --}}
        </div>

    </div>
</div>