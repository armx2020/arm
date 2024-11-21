<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\NewsRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\News;
use App\Models\User;
use App\Services\NewsService;

class NewsController extends BaseAdminController
{
    public function __construct(private NewsService $newsService)
    {
        parent::__construct();
        $this->newsService = $newsService;
    }

    public function index()
    {
        return view('admin.news.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.news.create', [
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function store(NewsRequest $request)
    {
        $this->newsService->store($request);        

        return redirect()->route('admin.new.index')->with('success', 'Новость сохранена');
    }

    public function show(string $id)
    {
        $news = News::find($id);

        if (empty($news)) {
            return redirect()->route('admin.news.index')->with('alert', 'Новость не найдена');
        }

        return view('admin.news.edit', ['news' => $news, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $news = News::find($id);

        if (empty($news)) {
            return redirect()->route('admin.new.index')->with('alert', 'Новость не найдена');
        }

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.news.edit', [
            'news' => $news,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function update(NewsRequest $request, string $id)
    {
        $news = News::find($id);

        if (empty($news)) {
            return redirect()->route('admin.new.index')->with('alert', 'Новость не найдена');
        }

        $news = $this->newsService->update($request, $news);

        return redirect()->route('admin.new.edit', ['new' => $news->id])->with('success', 'Новость сохранена');
    }

    public function destroy(string $id)
    {
        $news = News::find($id);

        if (empty($news)) {
            return redirect()->route('admin.new.index')->with('alert', 'Новость не найдена');
        }

        $news->delete();

        return redirect()->route('admin.new.index')->with('success', 'Новость удалена');
    }
}
