<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\News;
use App\Models\User;
use App\Services\NewsService;

class NewsController extends Controller
{
    public function __construct(private NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index()
    {
        return view('admin.news.index');
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.news.create', [
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups
        ]);
    }

    public function store(NewsRequest $request)
    {
        $this->newsService->store($request);        

        return redirect()->route('admin.news.index')->with('success', 'The news added');
    }

    public function show(string $id)
    {
        $news = News::find($id);

        if (empty($news)) {
            return redirect()->route('admin.news.index')->with('alert', 'The news not found');
        }

        return view('admin.news.show', ['news' => $news]);
    }

    public function edit(string $id)
    {
        $news = News::find($id);

        if (empty($news)) {
            return redirect()->route('admin.news.index')->with('alert', 'The news not found');
        }

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.news.edit', [
            'news' => $news,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups
        ]);
    }

    public function update(NewsRequest $request, string $id)
    {
        $news = News::find($id);

        if (empty($news)) {
            return redirect()->route('admin.news.index')->with('alert', 'The news not found');
        }

        $news = $this->newsService->update($request, $news);

        return redirect()->route('admin.news.index')->with('success', 'The news updated');
    }

    public function destroy(string $id)
    {
        $news = News::find($id);

        if (empty($news)) {
            return redirect()->route('admin.news.index')->with('alert', 'The news not found');
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'The news deleted');
    }
}
