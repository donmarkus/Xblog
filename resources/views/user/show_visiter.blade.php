<div>
    <div class="form-group">
        <label>@lang('xblog.name')：</label>
        <span>{{ $user->name }}</span>
    </div>
    <div class="form-group">
        <label>@lang('xblog.site_description')：</label>
        <span>{{ $user->description }}</span>
    </div>
    <div class="form-group">
        <label>@lang('xblog.website')：</label>
        <a href="{{ $user->website }}">{{ $user->website }}</a>
    </div>
    @if($user->meta)
        @foreach($user->meta as $key=>$value)
            <div class="form-group">
                <label>{{ ucfirst($key) }}：</label>
                <a href="{{ $value }}">{{ $value }}</a>
            </div>
        @endforeach
    @endif
</div>