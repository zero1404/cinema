<a href="{{ route($edit, $id) }}" class="btn btn-success text-white"><i class="fas fa-edit"></i>
    Sửa</a>
<form class="ml-2" method="POST" action="{{ route($delete, [$id]) }}">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-danger mx-2 btnDelete" data-id="{{ $id }}" data-toggle="tooltip"
        data-placement="bottom" title="Xoá"><i class="fas fa-trash-alt"></i>
        {{__('Xoá')}}</button>
</form>