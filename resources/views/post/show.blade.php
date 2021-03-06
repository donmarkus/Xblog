@extends('layouts.app')
@section('description',$post->description)
@section('keywords',$post->category->name)
@section('title',$post->title)
@section('content')
    <div class="container">
        <div id="post-detail-wrap" class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12 phone-no-padding">
                <div class="post-detail">
                    <div class="center-block">
                        <div class="post-detail-title">{{ $post->title }}</div>
                        <div class="post-meta">
                            <span class="post-category">
                           <i class="fa fa-folder-o fa-fw"></i>
                           <a href="{{ route('category.show',$post->category->name) }}">
                           {{ $post->category->name }}
                           </a>
                           </span>
                            <span class="post-comments-count">
                           &nbsp;|&nbsp;
                           <i class="fa fa-comments-o fa-fw" aria-hidden="true"></i>
                           <span>{{ $post->comments_count }}</span>
                           </span>
                            <span>
                           &nbsp;|&nbsp;
                           <i class="fa fa-eye"></i>
                           <span>{{ $post->view_count }}</span>
                           </span>
                            @can('update',$post)
                                <span>
                                    &nbsp;|&nbsp;
                                    <a href="{{ route('post.edit',$post->id) }}">
                                        <i class="fa fa-pencil fa-fw"></i>
                                    </a>
                                </span>
                                <span>
                                    &nbsp;|&nbsp;
                                    <a role="button"
                                       data-method="delete"
                                       data-url="{{ route('post.destroy',$post->id) }}"
                                       data-modal-target="{{ $post->title }}">
                                    <i class="fa fa-trash-o fa-fw"></i>
                                    </a>
                                </span>
                            @endcan
                        </div>
                    </div>
                    <br>
                    <div class="post-detail-content">
                        {!! $post->html_content !!}
                        <br>
                        <p>
                            -- @lang('xblog.end')
                        </p>
                    </div>
                    <div class="post-info-panel">
                        {{--<p class="info">--}}
                            {{--<label class="info-title">Copyright :</label><i class="fa fa-fw fa-creative-commons"></i>自由转载-非商用-非衍生-保持署名（<a--}}
                                    {{--href="https://creativecommons.org/licenses/by-nc-nd/3.0/deed.zh">Creative Commons 3.0 License</a>）--}}
                        {{--</p>--}}
                        <p class="info">
                            <label class="info-title">@lang('xblog.created_date') :</label>{{ $post->created_at }}
                        </p>
                        @if(isset($post->published_at) && $post->published_at)
                            <p class="info">
                                <label class="info-title">@lang('xblog.published_date') :</label>{{ $post->published_at }}
                            </p>
                        @endif
                        <p class="info">
                            <label class="info-title">@lang('xblog.form_article_tags') :</label>
                            @foreach($post->tags as $tag)
                                <a class="tag" href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if(!(isset($preview) && $preview) && $post->isShownComment())
            <div class="row">
                <div id="comment-wrap" class="col-md-8 col-md-offset-2 col-sm-12 phone-no-padding">
                    @include('widget.comment',[
                    'comment_key'=>$post->slug,
                    'comment_title'=>$post->title,
                    'comment_url'=>route('post.show',$post->slug),
                    'commentable'=>$post,
                    'redirect'=>request()->fullUrl(),
                     'commentable_type'=>'App\Post'])
                </div>
            </div>
        @endif
    </div>
@endsection