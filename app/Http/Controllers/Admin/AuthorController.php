<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('articles')->paginate(15);
        return view('dashboard.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('dashboard.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'bio.en' => 'nullable|string',
            'bio.ar' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $author = new Author();
        $author->setTranslations('name', $request->input('name'));
        $author->setTranslations('bio', $request->input('bio', []));
        $author->slug = Str::slug($request->input('name.en'));
        $author->email = $request->input('email');
        $author->phone = $request->input('phone');
        $author->location = $request->input('location');
        $author->is_active = $request->boolean('is_active');

        if ($request->hasFile('avatar')) {
            $author->avatar = $request->file('avatar')->store('authors', 'public');
        }

        $author->save();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author created successfully.');
    }

    public function show(Author $author)
    {
        $author->load('articles');
        return view('dashboard.authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('dashboard.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'bio.en' => 'nullable|string',
            'bio.ar' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $author->setTranslations('name', $request->input('name'));
        $author->setTranslations('bio', $request->input('bio', []));
        $author->slug = Str::slug($request->input('name.en'));
        $author->email = $request->input('email');
        $author->phone = $request->input('phone');
        $author->location = $request->input('location');
        $author->is_active = $request->boolean('is_active');

        if ($request->hasFile('avatar')) {
            $author->avatar = $request->file('avatar')->store('authors', 'public');
        }

        $author->save();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author deleted successfully.');
    }
}
