<?php

namespace App\Http\Controllers;

use App\Http\Repositories\TagRepository;
use App\Tag;
use Illuminate\Http\Request;
use XblogConfig;

class TagController extends Controller
{
    public $tagRepository;

    /**
     * TagController constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->middleware(['auth', 'admin'], ['except' => ['show','index']]);
    }

    public function index()
    {
        return view('tag.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags',
        ]);

        if ($this->tagRepository->create($request)) {
            $this->tagRepository->clearCache();
            return back()->with('success', trans('xblog.saved'));
        } else
            return back()->with('error', trans('xblog.not_saved'));
    }

    public function show($name)
    {
        $tag = $this->tagRepository->get($name);
        $page_size = $page_size = XblogConfig::getValue('page_size', 7);

        $posts = $this->tagRepository->pagedPostsByTag($tag, $page_size);
        return view('tag.show', compact('posts', 'name'));
    }

    public function destroy(Tag $tag)
    {
        if ($tag->posts()->withoutGlobalScopes()->count() > 0) {
            return redirect()->route('admin.tags')->withErrors(trans('xblog.not_saved'));
        }
        if ($tag->delete()) {
            $this->tagRepository->clearCache();
            return back()->with('success', trans('xblog.saved'));
        }
        return back()->withErrors(trans('xblog.not_saved'));
    }
}
