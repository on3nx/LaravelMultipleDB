<div class="row">
    @if (session('success'))
        <div class="alert alert-success">
                {{ trans('auth.'.Session::get('success'))}}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
                {{ trans('auth.'.Session::get('warning'))}}
        </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
            {{ trans('auth.'.Session::get('error'))}}
    </div>
    @endif
</div>