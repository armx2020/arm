<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\OfferAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Models\Category;
use App\Models\CompanyOffer;
use App\Models\Entity;
use App\Models\Offer;

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
        return view('admin.offer.create', ['menu' => $this->menu]);
    }

    public function store(StoreOfferRequest $request)
    {
        $this->offerAction->store($request);

        return redirect()->route('admin.offer.index')->with('success', 'Предложение добавлено');
    }

    public function edit(string $id)
    {
        $offer = Offer::with('entity', 'category')->find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        return view('admin.offer.edit', [
            'offer' => $offer,
            'menu' => $this->menu
        ]);
    }

    public function update(UpdateOfferRequest $request, string $id)
    {
        $offer = Offer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        $this->offerAction->update($request, $offer);

        return redirect()->route('admin.offer.edit', ['offer' => $offer->id])
            ->with('success', 'Предложение сохранено');
    }

    public function destroy(string $id)
    {
        $offer = Offer::find($id);

        if (empty($offer)) {
            return redirect()->route('admin.offer.index')->with('alert', 'Предложение не найдено');
        }

        $this->offerAction->destroy($offer);

        return redirect()->route('admin.offer.index')->with('success', 'Предложение удалено');
    }
}
