<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\OfferAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyOffer;

class OfferController extends BaseAdminController
{
    public function __construct(private OfferAction $offerAction)
    {
        parent::__construct();
        $this->offerAction = $offerAction;
    }

    public function index()
    {
        return view('admin.offer.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $companies = Company::all();
        $categories = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();

        return view('admin.offer.create', ['companies' => $companies, 'categories' => $categories, 'menu' => $this->menu]);
    }

    public function store(StoreOfferRequest $request)
    {
        $this->offerAction->store($request);

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

        $categories = Category::query()->offer()->active()->where('category_id', null)->with('categories')->orderBy('sort_id')->get();
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

    public function update(UpdateOfferRequest $request, string $id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        $offer = $this->offerAction->update($request, $offer);

        return redirect()->route('admin.offer.edit', ['offer' => $offer->id])
            ->with('success', 'Предложение сохранено');
    }

    public function destroy(string $id)
    {
        $offer = CompanyOffer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        $this->offerAction->destroy($offer);

        return redirect()->route('admin.offer.index')->with('success', 'Предложение удалено');
    }
}
