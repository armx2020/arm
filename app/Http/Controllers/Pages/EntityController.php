<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function companies(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Компании';

        $type = 1;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'type' => $type,
        ]);
    }
    public function groups(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'groups.index';
        $secondPositionName = 'Группы';
        $entity = 'groups';

        $type = 2;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function places(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'places.index';
        $secondPositionName = 'Места и церкви';
        $entity = 'places';

        $type = 3;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function communities(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entity = 'communities';

        $type = 4;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function company(Request $request, $idOrTranscript)
    {
        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Бизнес - справочник';
        $entityName = 'companies';

        $entity = Entity::query()->active();

        if(is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if(!$entity) {
            return redirect()->route('home');
        }

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }

    public function group(Request $request, $idOrTranscript)
    {
        $secondPositionUrl = 'groups.index';
        $secondPositionName = 'Общины и консульства';
        $entityName = 'groups';

        $entity = Entity::query()->active();

        if(is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if(!$entity) {
            return redirect()->route('home');
        }

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }

    public function place(Request $request, $idOrTranscript)
    {
        $secondPositionUrl = 'places.index';
        $secondPositionName = 'Места и церкви';
        $entityName = 'places';

        $entity = Entity::query()->active();

        if(is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if(!$entity) {
            return redirect()->route('home');
        }

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }

    public function community(Request $request, $idOrTranscript)
    {
        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entityName = 'communities';

        $entity = Entity::query()->active();

        if(is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if(!$entity) {
            return redirect()->route('home');
        }

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }
}
