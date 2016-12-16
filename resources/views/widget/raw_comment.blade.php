<div class="comment">
    <div class="comment-body">
        <div id="comments-container"
             data-api-url="{{ route('comment.show',[$commentable->id,
             'commentable_type'=>$commentable_type,
             'redirect'=>(isset($redirect) && $redirect ? $redirect:'')]) }}">
        </div>
        <form id="comment-form" method="post" action="{{ route('comment.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
            <input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
            @if(!auth()->check())
                <div class="form-group">
                    <label for="username">@lang('xblog.username')<span class="required">*</span></label>
                    <input class="form-control" id="username" type="text" name="username" placeholder="@lang('xblog.username')">
                </div>
                <div class="form-group">
                    <label for="email">@lang('xblog.email')<span class="required">*</span></label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="@lang('xblog.email')">
                </div>
                <div class="form-group">
                    <label for="site">@lang('xblog.website')</label>
                    <input class="form-control" id="site" type="text" name="site" placeholder="">
                </div>
            @endif
            <div class="form-group">
                <label for="comment-content">@lang('xblog.form_article_comment')<span class="required">*</span></label>
                <textarea placeholder="@lang('xblog.support_markdown')" style="resize: vertical" id="comment-content" name="content"
                          rows="5" spellcheck="false" class="form-control markdown-content autosize-target"></textarea>
                <span class="help-block required">
                    <strong id="comment_error_msg"></strong>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" id="comment-submit" class="btn btn-primary"
                       value="@lang('xblog.comment')"/>
            </div>
        </form>
    </div>
</div>