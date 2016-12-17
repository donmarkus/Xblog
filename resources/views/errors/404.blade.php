@extends('layouts.plain')
@section('content')
    <div class="error">
        <div class="title">404</div>
        <p class="links">
            <a href="{{ route('post.index') }}" aria-label="Blog">Blog</a><span aria-hidden="true">/</span>
            <a href="{{ route('projects') }}" aria-label="@lang('xblog.projects')">@lang('xblog.projects')</a><span
                    aria-hidden="true">/</span>
            <a href="{{ route('page.show','about') }}" aria-label="@lang('xblog.about')">@lang('xblog.about')</a>
        </p>
    </div>
@endsection
