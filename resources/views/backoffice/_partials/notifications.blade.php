@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">
            ×
        </span>
    </button>
    @foreach($errors->all() as $val)
    <p>
        {{ $val }}
    </p>
    @endforeach
</div>
@endif

@if (Session::get('danger'))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">
            ×
        </span>
    </button>
    <p>
        {{ Session::get('danger') }}
    </p>
</div>
@endif

@if (Session::get('success'))
<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">
            ×
        </span>
    </button>
    <p>
        {{ Session::get('success') }}
    </p>
</div>
@endif
