@extends('layouts.app')
@section('title','Tag')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('post.index') }}">Blog</a></li>
            <li><a href="{{ route('tag.index') }}">Tag</a></li>
            <li class="active">{{ $name }}</li>
        </ol>
        <div class="row">
            <div class="col-md-8">
                @if($posts->isEmpty())
                    @include('partials.empty')
                @else
                    @each('post.item',$posts,'post')
                    @if($posts->lastPage() > 1)
                        {{ $posts->links() }}
                    @endif
                @endif
            </div>
            <div class="col-md-4">
                @include('layouts.widgets')
            </div>
        </div>
    </div>
@endsection