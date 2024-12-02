<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\OfferRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyOffer;
use App\Services\OfferService;

class OfferController extends BaseAdminController
{
    public function __construct(private OfferService $offerService)
    {
        parent::__construct();
        $this->offerService = $offerService;
    }

    public function index()
    {
        return view('admin.offer.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $companies = Company::all();
        $categories = Category::offer()->active()->get();

        return view('admin.offer.create', ['companies' => $companies, 'categories' => $categories, 'menu' => $this->menu]);
    }

    public function store(OfferRequest $request)
    {
        $this->offerService->store($request);

        return redirect()->route('admin.offer.index')->with('success', 'Предложение добавлено');
    }

    public function show(string $id)
    {
        $offer = CompanyOffer::with('company', 'category')->find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        return view('admin.offer.edit', ['offer' => $offer, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $offer = CompanyOffer::with('company', 'category')->find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        $categories = Category::offer()->active()->get();
        $companies = Company::all();
        $company = $offer->company;
        $category = $offer->category;

        return view('admin.offer.edit', [
            'offer' => $offer,
            'company' => $company,
            'category' => $category,
            'categories' => $categories,
            'companies' => $companies,
            'menu' => $this->menu
        ]);
    }

    public function update(OfferRequest $request, string $id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        $offer = $this->offerService->update($request, $offer);

        return redirect()->route('admin.offer.edit', ['offer' => $offer->id])
            ->with('success', 'Предожение сохранено');
    }

    public function destroy(string $id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        $this->offerService->destroy($offer);

        return redirect()->route('admin.offer.index')->with('success', 'Предложение удалено');
    }
}
