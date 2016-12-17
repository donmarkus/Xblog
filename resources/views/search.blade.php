@extends('layouts.app')

@section('title')
    @lang('xblog.search')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if($posts->count() == 0)
                    <div class="widget widget-default">
                        <div class="widget-header">
                            <h3>@lang('xblog.search') "{{ request('q') }}"</h3>
                        </div>
                        <div class="widget-body">
                            <h4>@lang('xblog.nothing_found')...</h4>
                        </div>
                    </div>
                @else
                    <div class="widget widget-default">
                        <div class="widget-header">
                            <h3>Search for "{{ request('q') }}"</h3>
                        </div>
                    </div>
                    @each('post.item',$posts,'post')
                @endif
            </div>
            <div class="col-md-4">
                <div class="slide">
                    @include('layouts.widgets')
                </div>
            </div>
        </div>
    </div>
@endsection
