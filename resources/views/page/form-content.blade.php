<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="control-label">@lang('xblog.page_uri')*</label>

    <input id="name" type="text" class="form-control" name="name"
           value="{{ isset($page) ? $page->name : old('name') }}"
           autofocus>

    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>


<div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
    <label for="display_name" class="control-label">@lang('xblog.page_name')*</label>

    <input id="display_name" type="text" class="form-control" name="display_name"
           value="{{ isset($page) ? $page->display_name : old('display_name') }}">

    @if ($errors->has('display_name'))
        <span class="help-block">
            <strong>{{ $errors->first('display_name') }}</strong>
        </span>
    @endif
</div>
{{ csrf_field() }}

<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="content" class="control-label">@lang('xblog.form_article_content')*</label>

    <textarea spellcheck="false" id="content" type="text" class="form-control" name="content"
              rows="25"
              style="line-height: 1.85em; resize: vertical">{{ isset($page) ? $page->content : old('content') }}</textarea>
    @if ($errors->has('content'))
        <span class="help-block">
            <strong>{{ $errors->first('content') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="comment_info" class="control-label">@lang('xblog.comments')</label>
    <select style="margin-top: 5px" id="comment_info" name="comment_info" class="form-control">
        <?php $comment_info = isset($page) && $page->configuration ? $page->configuration->config['comment_info'] : ''?>
        <option value="default" {{ $comment_info=='default'?' selected' : '' }}>@lang('xblog.form_article_comment_system_default')</option>
        <option value="force_disable" {{ $comment_info=='force_disable'?' selected' : '' }}>@lang('xblog.form_article_comment_system_open')</option>
        <option value="force_enable" {{ $comment_info=='force_enable'?' selected' : '' }}>@lang('xblog.form_article_comment_system_close')</option>
    </select>
</div>
<div class="form-group">
    <label for="comment_type" class="control-label">@lang('xblog.form_article_comment_system')</label>
    <select id="comment_type" name="comment_type" class="form-control">
        <?php $comment_type = isset($page) && $page->configuration ? $page->configuration->config['comment_type'] : ''?>
        <option value="default" {{ $comment_type=='default'?' selected' : '' }}>@lang('xblog.form_article_comment_system_default')</option>
        <option value="raw" {{ $comment_type=='raw'?' selected' : '' }}>@lang('xblog.form_article_comment_system_default')</option>
        <option value="disqus" {{ $comment_type=='disqus'?' selected' : '' }}>Disqus</option>
        <option value="duoshuo" {{ $comment_type=='duoshuo'?' selected' : '' }}>Duoshuo</option>
    </select>
</div>

<div class="form-group">
    <?php $display = isset($page) && $page->configuration ? $page->configuration->config['display'] : 'false'?>
    <div class="radio radio-inline">
        <label>
            <input type="radio"
                   {{ (isset($page)) && $display == 'true' ? ' checked ':'' }}
                   name="display"
                   value="true">@lang('xblog.display_on_homepage')
        </label>
    </div>
    <div class="radio radio-inline">
        <label>
            <input type="radio"
                   {{ (!isset($page)) || $display == 'false' ? ' checked ':'' }}
                   name="display"
                   value="false">@lang('xblog.dont_display_on_homepage')
        </label>
    </div>
</div>

<div class="form-group">
    <?php $sort_order = isset($page) && $page->configuration ? $page->configuration->config['sort_order'] : '1'?>
    <label for="sort_order" class="control-label">@lang('xblog.order')</label>
    <input id="sort_order" type="number" class="form-control" name="sort_order"
           value="{{ $sort_order }}">
</div>
