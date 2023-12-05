<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'page_name' => 'required|string',
            'page_no' => 'required|integer',
            'page_schema' => 'required|json',
            'page_content' => 'nullable|json',
        ]);

        Page::create($data);

        return redirect()->route('pages.create')->with('success', 'Page created successfully');
    }

    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }
}
