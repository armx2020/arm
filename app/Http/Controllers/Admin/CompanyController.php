<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\User;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        return view('admin.company.index');
    }

    public function create()
    {
        $users = User::all();

        return view('admin.company.create', ['users' => $users]);
    }

    public function store(CompanyRequest $request)
    {
        $this->companyService->store($request);

        return redirect()->route('admin.company.index')->with('success', 'The company added');
    }

    public function show(string $id)
    {
        $company = Company::with('user')->find($id);

        if (empty($company)) {
            return redirect()->route('admin.company.index')->with('alert', 'The company not found');
        }
        return view('admin.company.show', ['company' => $company]);
    }

    public function edit(string $id)
    {
        $company = Company::find($id);

        if (empty($company)) {
            return redirect()->route('admin.company.index')->with('alert', 'The company not found');
        }

        $users = User::all();

        return view('admin.company.edit', ['company' => $company, 'users' => $users]);
    }

    public function update(CompanyRequest $request, string $id)
    {
        $company = Company::find($id);

        if (empty($company)) {
            return redirect()->route('admin.company.index')->with('alert', 'The company not found');
        }

        $company = $this->companyService->update($request, $company);

        return redirect()->route('admin.company.show', ['company' => $company->id])
            ->with('success', "The company saved");
    }

    public function destroy(string $id)
    {
        $company = Company::find($id);

        if (empty($company)) {
            return redirect()->route('admin.company.index')->with('alert', 'The company not found');
        }

        if (count($company->offers) > 0) {
            return redirect()->route('admin.company.index')->with('alert', 'The company has products, you need to delete them first');
        }

        foreach ($company->events as $event) {
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }
            $event->delete();
        }

        foreach ($company->news as $news) {
            if ($news->image) {
                Storage::delete('public/' . $news->image);
            }
            $news->delete();
        }

        foreach ($company->projects as $project) {
            if ($project->image !== null) {
                Storage::delete('public/' . $project->image);
            }
           $project->delete();
        }

        foreach ($company->vacancies as $vacancy) {
            $vacancy->delete();
        }

        if ($company->image !== null) {
            Storage::delete('public/' . $company->image);
        }

        $company->delete();

        return redirect()->route('admin.company.index')->with('success', 'The company deleted');
    }
}
