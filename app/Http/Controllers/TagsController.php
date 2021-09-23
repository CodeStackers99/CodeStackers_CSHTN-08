<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        $tags = Tag::latest('updated_at')->search()->paginate(20);
        return view('layouts.Tag.index', compact(['tags']));
    }
    public function create()
    {
        $this->authorize('create', Tag::class);
        return view('layouts.Tag.create');
    }

    public function store(CreateTagRequest $request)
    {
        $this->authorize('create', Tag::class);

        Tag::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);
        session()->flash('success', 'Tag created successfully.');
        return redirect(route('tags.index'));
    }

    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        return view('layouts.Tag.edit', compact(['tag']));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $this->authorize('update', $tag);
        $tag->name = $request->name;
        $tag->save();
        session()->flash('success', 'Tag updated Successfully.');
        return redirect(route('tags.index'));
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);
        

        if($tag->videos->count() > 0) {
            session()->flash('error', 'Tag cannot be deleted as it contains many videos.');
            return redirect(route('tags.index'));
        }
        $tag->delete();

        session()->flash('success', 'Tag has been deleted successfully.');
        return redirect(route('tags.index'));
    }
}
