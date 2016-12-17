@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3>@lang('xblog.edit')</h3>
                </div>
                <div class="widget-body">
                    <form role="form" class="form-horizontal" action="{{ route('category.update',$category->id) }}"
                          method="post">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">@lang('xblog.name')</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ $category->name }}"
                                       autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('xblog.form_article_save')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection