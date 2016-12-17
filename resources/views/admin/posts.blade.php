@extends('admin.layouts.app')
@section('title','Articles')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h6><i class="fa fa-sticky-note fa-fw"></i>@lang('xblog.articles')</h6>
                </div>
                <div class="widget-body">
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>@lang('xblog.title')</th>
                            <th>@lang('xblog.state')</th>
                            <th>@lang('xblog.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <?php
                            $class = '';
                            $status = trans('xblog.not_published');
                            if ($post->trashed()) {
                                $class = 'danger';
                                $status = 'Deleted';
                            } else if ($post->isPublished()) {
                                $class = 'success';
                                $status = trans('xblog.published');
                            }
                            ?>
                            <tr class="{{ $class }}">
                                <td>{{ $post->title }}</td>
                                <td>{{ $status }}</td>
                                <td>
                                    <div>
                                        <a {{ $post->trashed()?'disabled':'' }} href="{{ $post->trashed()?'javascript:void(0)':route('post.edit',$post->id) }}"
                                           data-toggle="tooltip" data-placement="top" title="@lang('xblog.edit')"
                                           class="btn btn-info">
                                            <i class="fa fa-pencil fa-fw"></i>
                                        </a>
                                        @if($post->trashed())
                                            <form style="display: inline" method="post"
                                                  action="{{ route('post.restore',$post->id) }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('xblog.restore')">
                                                    <i class="fa fa-repeat fa-fw"></i>
                                                </button>
                                            </form>

                                        @elseif($post->isPublished())
                                            <a href="{{ route('post.show',$post->slug) }}"
                                               data-toggle="tooltip" data-placement="top" title="@lang('xblog.view')"
                                               class="btn btn-success">
                                                <i class="fa fa-eye fa-fw"></i>
                                            </a>
                                            <form style="display: inline" method="post"
                                                  action="{{ route('post.publish',$post->id) }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('xblog.published')">
                                                    <i class="fa fa-undo fa-fw"></i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('post.preview',$post->slug) }}" data-toggle="tooltip"
                                               data-placement="top" title="@lang('xblog.preview')"
                                               class="btn btn-default">
                                                <i class="fa fa-eye fa-fw"></i>
                                            </a>
                                            <form style="display: inline" method="post"
                                                  action="{{ route('post.publish',$post->id) }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-default" data-toggle="tooltip"
                                                        data-placement="top" title="@lang('xblog.published')">
                                                    <i class="fa fa-send-o fa-fw"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <button class="btn btn-danger"
                                                data-title="{{ $post->title }}"
                                                data-toggle="tooltip" data-placement="top" title="@lang('xblog.delete')"
                                                data-url="{{ route('post.destroy',$post->id) }}"
                                                data-force="{{ $post->trashed() }}"
                                                data-target="#delete-post-modal">
                                            <i class="fa fa-trash-o  fa-fw"></i>
                                        </button>
                                        <a class="btn btn-default" href="{{ route('post.download',$post->id) }}">
                                            <i class="fa fa-cloud-download fa-fw"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="delete-post-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">@lang('xblog.delete')</h4>
                </div>
                <div class="modal-body">
                    @lang('xblog.delete')<span id="span-title"></span> ?
                </div>
                <div class="modal-footer">
                    <form id="delete-form" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="redirect" value="/admin/posts">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">@lang('xblog.cancel')</button>
                        <button id="confirm-btn" type="submit" class="btn btn-primary">@lang('xblog.confirm')</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
    <script>
        $('#delete-post-modal').on('show.bs.modal', function (e) {
            var url = $(e.relatedTarget).data('url');
            var title = $(e.relatedTarget).data('title');
            var force = $(e.relatedTarget).data('force');
            if (force == '1') {
                $('#confirm-btn').text('OK');
                $('#confirm-btn').attr('class', 'btn btn-danger');
            }
            $('#span-title').text(title);
            $('#delete-form').attr('action', url);
        });
    </script>
@endsection