@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="fas fa-bullhorn me-1"></span>
    {{session('success')}}
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="fas fa-bullhorn me-1"></span>
    {{session('error')}}
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif