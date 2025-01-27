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

    public function companies(Request $request, $regionCode = null)
    {
        $region = $this->getRegion($request, $regionCode);

        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Компании';
        $entity = 'companies';

        $type = 1;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }
    public function groups(Request $request, $regionCode = null)
    {
        $region = $this->getRegion($request, $regionCode);

        $secondPositionUrl = 'groups.index';
        $secondPositionName = 'Группы';
        $entity = 'groups';

        $type = 2;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function places(Request $request, $regionCode = null)
    {
        $region = $this->getRegion($request, $regionCode);

        $secondPositionUrl = 'places.index';
        $secondPositionName = 'Места и церкви';
        $entity = 'places';

        $type = 3;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function communities(Request $request, $regionCode = null)
    {
        $region = $this->getRegion($request, $regionCode);

        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entity = 'communities';

        $type = 4;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function show(Request $request, Entity $entity)
    {
        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entityName = 'communities';

        return view('pages.entity.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
        ]);
    }
}
