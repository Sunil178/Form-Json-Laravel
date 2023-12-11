<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.schema_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'number' => 'required|integer',
            'schema' => 'required|json',
            'content' => 'nullable|json',
        ]);

        Page::create($data);

        return redirect()->route('pages.index')->with('success', 'Page created successfully');
    }

    public function schemaEdit(Page $page)
    {
        return view('pages.schema_edit', compact('page'));
    }

    public function schemaUpdate(Request $request, Page $page)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'number' => 'required|integer',
            'schema' => 'required|json',
            'content' => 'nullable|json',
        ]);

        $page->update($data);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully');
    }

    public function contentEdit(Page $page)
    {
        return view('pages.content_edit', compact('page'));
    }

    public function contentUpdate(Request $request, Page $page)
    {
        $data = $request->validate([
            'content' => 'nullable|json',
        ]);

        $page->update($data);

        return redirect()->route('pages.index')->with('success', 'Page content updated successfully');
    }

}
