@extends('admin.layouts.app')

@section('title')
    @lang('xblog.settings')
@endsection

@section('content')
    <div class="row">
        <form role="form" id="setting-form" class="form-horizontal" action="{{ route('admin.save-settings') }}"
              method="post">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h6>
                        <i class="fa fa-cog fa-fw"></i>@lang('xblog.settings')
                    </h6>
                </div>
                <div class="widget-body">
                    <div class="form-group">
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ isset($google_analytics) && $google_analytics == 'true' ? ' checked ':'' }}
                                       name="google_analytics"
                                       value="true">@lang('xblog.enable_google_analytics')
                            </label>
                        </div>
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ isset($google_analytics) && $google_analytics == 'true' ? '':' checked ' }}
                                       name="google_analytics"
                                       value="false">@lang('xblog.disable_google_analytics')
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ isset($enable_mail_notification) && $enable_mail_notification == 'true' ? ' checked ':'' }}
                                       name="enable_mail_notification"
                                       value="true">@lang('xblog.enable_mail_notifications')
                            </label>
                        </div>
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ isset($enable_mail_notification) && $enable_mail_notification == 'true' ? '':' checked ' }}
                                       name="enable_mail_notification"
                                       value="false">@lang('xblog.disable_mail_notifications')
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ (isset($comment_type) && $comment_type == 'none') ? ' checked ':'' }}
                                       name="comment_type"
                                       value="none">@lang('xblog.form_article_comment_system_default')
                            </label>
                        </div>
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ (!isset($comment_type) || $comment_type == 'raw') ? ' checked ':'' }}
                                       name="comment_type"
                                       value="raw">@lang('xblog.form_article_comment_system_raw')
                            </label>
                        </div>
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ isset($comment_type) && $comment_type == 'disqus' ? ' checked':'' }}
                                       name="comment_type"
                                       value="disqus">Disqus
                            </label>
                        </div>
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ isset($comment_type) && $comment_type == 'duoshuo' ? ' checked':'' }}
                                       name="comment_type"
                                       value="duoshuo">@lang('xblog.form_article_comment_system_duoshuo')
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ isset($enable_hot_posts) && $enable_hot_posts == 'true' ? ' checked ':'' }}
                                       name="enable_hot_posts"
                                       value="true">@lang('xblog.enable_popular_posts')
                            </label>
                        </div>
                        <div class="radio">
                            <label class="col-sm-offset-2">
                                <input type="radio"
                                       {{ isset($enable_hot_posts) && $enable_hot_posts == 'true' ? '':' checked ' }}
                                       name="enable_hot_posts"
                                       value="false">@lang('xblog.disable_popular_posts')
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="google_trace_id"
                               class="col-sm-2 control-label">@lang('xblog.google_tracking_id')</label>
                        <div class="col-sm-8">
                            <input type="text" name="google_trace_id" class="form-control" id="google_trace_id"
                                   placeholder="@lang('xblog.google_tracking_id')"
                                   value="{{ $google_trace_id or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="author" class="col-sm-2 control-label">@lang('xblog.author')</label>
                        <div class="col-sm-8">
                            <input type="text" name="author" class="form-control" id="author"
                                   value="{{ $author or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description"
                               class="col-sm-2 control-label">@lang('xblog.form_article_description')</label>
                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description"
                                   value="{{ $description or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 control-label">@lang('xblog.avatar')</label>
                        <div class="col-sm-8">
                            <input type="text" name="avatar" class="form-control" id="avatar"
                                   value="{{ $avatar or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 control-label">Disqus ID</label>
                        <div class="col-sm-8">
                            <input type="text" name="disqus_shortname" class="form-control" id="avatar"
                                   value="{{ $disqus_shortname or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 control-label">Duoshuo ID</label>
                        <div class="col-sm-8">
                            <input type="text" name="duoshuo_shortname" class="form-control" id="avatar"
                                   value="{{ $duoshuo_shortname or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 control-label">@lang('xblog.github_username')</label>
                        <div class="col-sm-8">
                            <input type="text" name="github_username" class="form-control" id="avatar"
                                   value="{{ $github_username or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Js</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="site_js"
                                   value="{{ $site_js or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Css</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="site_css"
                                   value="{{ $site_css or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('xblog.site_title')</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="@lang('xblog.site_title')"
                                   value="{{ $site_title or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('xblog.site_keywords')</label>
                        <div class="col-sm-8">
                            <input placeholder="@lang('xblog.site_keywords')" class="form-control" type="text"
                                   name="site_keywords"
                                   value="{{ $site_keywords or ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('xblog.site_description')</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="site_description"
                                   value="{{ $site_description or '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('xblog.page_size')</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="page_size"
                                   value="{{ $page_size or 7 }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('xblog.hot_posts_count')</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="hot_posts_count"
                                   value="{{ $hot_posts_count or 5 }}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('xblog.profile_image')</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="profile_image"
                                   value="{{ $profile_image or ''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('xblog.background_image')</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="background_image"
                                   value="{{ $background_image or ''}}">
                        </div>
                    </div>

                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button type="submit" class="btn bg-primary">
                                @lang('xblog.save')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

