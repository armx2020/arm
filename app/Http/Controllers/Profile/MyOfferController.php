<?php

namespace App\Http\Controllers\Profile;

use App\Entity\Actions\OfferAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOfferController extends BaseController
{
    public function __construct(private OfferAction $offerAction)
    {
        parent::__construct();
        $this->offerAction = $offerAction;
    }

    public function index(Request $request)
    {
        $entitiesName = 'myoffers';
        $entityName = 'myoffer';

        $offers = Auth::user()->offers()->with('primaryImage')->orderByDesc('updated_at')->paginate(10);

        return view('profile.pages.offer.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
            'entities' => $offers,
            'entitiesName' => $entitiesName,
            'entityName' => $entityName,
        ]);
    }

    public function create(Request $request)
    {
        $companies = Entity::companies()->with('offers')->where('user_id', '=', Auth::user()->id)->get();

        if (count($companies) == 0) {
            return redirect()->route('mycompanies.index')->with('alert', 'У вас нет компаний! Сначала добавьте компанию.');
        }

        $categories = Category::query()->companies()->active()->where('category_id', null)->with('categories')->get();

        return view('profile.pages.offer.create', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'companies' => $companies,
            'categories' => $categories,
            'regions' => $this->regions,
            'countries' => $this->countries,
        ]);
    }

    public function store(StoreOfferRequest $request)
    {
        $offer = $this->offerAction->store($request, Auth::user()->id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        return redirect()->route('myoffers.index')->with('success', 'Товар "' . $offer->name . '" добавлен');
    }

    public function show(Request $request, $id)
    {
        $offer = Offer::with('entity')->find($id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        if (!$offer->entity->user_id == Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        return view('profile.pages.offer.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
            'entity' => $offer,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $offer = Offer::with('entity')->find($id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        if (!$offer->user_id == Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        $companies = Entity::companies()->with('offers')->where('user_id', '=', Auth::user()->id)->get();

        if (count($companies) == 0) {
            return redirect()->route('mycompanies.index')->with('alert', 'У вас нет компаний! Сначала добавьте компанию.');
        }

        $categories = Category::query()->companies()->active()->where('category_id', null)->with('categories')->get();

        return view('profile.pages.offer.edit', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'countries' => $this->countries,
            'offer' => $offer,
            'categories' => $categories,
            'companies' => $companies,
        ]);
    }

    public function update(UpdateOfferRequest $request, $id)
    {
        $offer = Offer::find($id);

        if (empty($offer) || $offer->entity->user_id !== Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        $offer = $this->offerAction->update($request, $offer, Auth::user()->id);

        if (empty($offer)) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        return redirect()->route('myoffers.show', ['myoffer' => $offer->id])->with('success', 'Товар "' . $offer->name . '" обнавлен');
    }

    public function destroy($id)
    {
        $offer = Offer::find($id);

        if (empty($offer) || $offer->user_id !== Auth::user()->id) {
            return redirect()->route('myoffers.index')->with('alert', 'Товар не найден');
        }

        $this->offerAction->destroy($offer);

        return redirect()->route('myoffers.index')->with('success', 'Товар удалён');
    }
}
