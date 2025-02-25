<?php

namespace App\Http\Controllers\Pages;

use App\Entity\Actions\AppealAction;
use App\Http\Controllers\BaseController;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;

class EntityController extends BaseController
{
    public function __construct(private AppealAction $appealAction)
    {
        parent::__construct();
        $this->appealAction = $appealAction;
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
            'categoryUri' => null,
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
            'categoryUri' => null,
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
            'categoryUri' => null,
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
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
            'type' => $type
        ]);
    }

    public function jobs(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        if (!$region) {
            return redirect()->route('home');
        }

        $secondPositionUrl = 'jobs.index';
        $secondPositionName = 'Работа и вакансии';
        $entity = 'jobs';

        $type = 7;

        return view('pages.entity.index', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
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
        $entityShowRout = 'company.show';

        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $otherEntities = $entity->getSimilarEntities();

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
            'otherEntities' => $otherEntities,
            'entityShowRout' => $entityShowRout
        ]);
    }

    public function group(Request $request, $idOrTranscript)
    {
        $secondPositionUrl = 'groups.index';
        $secondPositionName = 'Общины и консульства';
        $entityName = 'groups';
        $entityShowRout = 'group.show';

        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $otherEntities = $entity->getSimilarEntities();

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
            'otherEntities' => $otherEntities,
            'entityShowRout' => $entityShowRout
        ]);
    }

    public function place(Request $request, $idOrTranscript)
    {
        $secondPositionUrl = 'places.index';
        $secondPositionName = 'Места и церкви';
        $entityName = 'places';
        $entityShowRout = 'place.show';

        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $otherEntities = $entity->getSimilarEntities();

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
            'otherEntities' => $otherEntities,
            'entityShowRout' => $entityShowRout
        ]);
    }

    public function community(Request $request, $idOrTranscript)
    {
        $secondPositionUrl = 'communities.index';
        $secondPositionName = 'Общины и консульства';
        $entityName = 'communities';
        $entityShowRout = 'community.show';

        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $otherEntities = $entity->getSimilarEntities();

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
            'otherEntities' => $otherEntities,
            'entityShowRout' => $entityShowRout
        ]);
    }

    public function job(Request $request, $idOrTranscript)
    {
        $secondPositionUrl = 'jobs.index';
        $secondPositionName = 'Работа, вакансии';
        $entityName = 'jobs';
        $entityShowRout = 'job.show';

        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $otherEntities = $entity->getSimilarEntities();

        return view('pages.entity.show', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entityName' => $entityName,
            'entity' => $entity,
            'otherEntities' => $otherEntities,
            'entityShowRout' => $entityShowRout
        ]);
    }

    public function edit(Request $request, $idOrTranscript)
    {
        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $secondPositionUrl = "home";
        $secondPositionName = 'Исправить неточность';

        return view('pages.entity.edit', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
        ]);
    }

    public function update(Request $request, $idOrTranscript)
    {
        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $appeal = $this->appealAction->store($request, $entity->id, Auth::user()?->id);

        if (!$appeal) {
            switch ($entity->entity_type_id) {
                case 4:
                    return redirect()->route('community.show', ['idOrTranscript' => $entity->id])->with('warning', 'Не удалось, попробуйте позднее');
                    break;
                case 3:
                    return redirect()->route('place.show', ['idOrTranscript' => $entity->id])->with('warning', 'Не удалось, попробуйте позднее');
                    break;
                case 2:
                    return redirect()->route('group.show', ['idOrTranscript' => $entity->id])->with('warning', 'Не удалось, попробуйте позднее');
                    break;
                default:
                    return redirect()->route('company.show', ['idOrTranscript' => $entity->id])->with('warning', 'Не удалось, попробуйте позднее');
                    break;
            }
        }

        switch ($entity->entity_type_id) {
            case 4:
                return redirect()->route('community.show', ['idOrTranscript' => $entity->id])->with('success', "Спасибо за ваш вклад в наше сообщество! Ваша информация поможет многим найти надежные компании и услуги. Мы ценим вашу активность и заботу о наших земляках!");
                break;
            case 3:
                return redirect()->route('place.show', ['idOrTranscript' => $entity->id])->with('success', "Спасибо за ваш вклад в наше сообщество! Ваша информация поможет многим найти надежные компании и услуги. Мы ценим вашу активность и заботу о наших земляках!");
                break;
            case 2:
                return redirect()->route('group.show', ['idOrTranscript' => $entity->id])->with('success', "Спасибо за ваш вклад в наше сообщество! Ваша информация поможет многим найти надежные компании и услуги. Мы ценим вашу активность и заботу о наших земляках!");
                break;
            default:
                return redirect()->route('company.show', ['idOrTranscript' => $entity->id])->with('success', "Спасибо за ваш вклад в наше сообщество! Ваша информация поможет многим найти надежные компании и услуги. Мы ценим вашу активность и заботу о наших земляках!");
                break;
        }
    }

    public function editPhoto(Request $request, $idOrTranscript)
    {
        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $secondPositionUrl = "home";
        $secondPositionName = 'Добавить фото';

        return view('pages.entity.photo', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'categoryUri' => null,
            'regions' => $this->regions,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
        ]);
    }

    public function updatePhoto(Request $request, $idOrTranscript)
    {
        $entity = Entity::query()->active();

        if (is_numeric($idOrTranscript)) {
            $entity = $entity->where('id', $idOrTranscript)->First();
            if ($entity != null){
                if ($request->hasFile('images')) {
                    $images = $entity->images(false);
                    $lastImage = $images->orderBy('sort_id', 'DESC')->first()->sort_id;
                    $imagesCount = $images->count();
                    if ((count($request->images) + $imagesCount) > 20){
                        return redirect()->back()->with('error', 'Количество изображений превысило лимит');
                    }
                    foreach ($request->file('images') as $sortId => $file) {
                        $sortId += ($lastImage + 1);
                        $path = $file->store('uploaded', 'public');

                        $imageEntity = $entity->images()->create([
                            'path' => $path,
                            'sort_id' => $sortId,
                            'checked' => 0,
                        ]);

                        Image::make('storage/' . $imageEntity->path)
                            ->resize(400, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })
                            ->save();
                    }
                }
            }
        } else {
            $entity = $entity->where('transcription', $idOrTranscript)->First();
        }

        if (!$entity) {
            return redirect()->route('home');
        }

        $entity = $this->appealAction->storePhotoToEntity($request, $entity);

        switch ($entity->entity_type_id) {
            case 4:
                return redirect()->route('community.show', ['idOrTranscript' => $entity->id])->with('success', 'Ваша заявка успешно принята, изменения будут доступны после модерации');
                break;
            case 3:
                return redirect()->route('place.show', ['idOrTranscript' => $entity->id])->with('success', 'Ваша заявка успешно принята, изменения будут доступны после модерации');
                break;
            case 2:
                return redirect()->route('group.show', ['idOrTranscript' => $entity->id])->with('success', 'Ваша заявка успешно принята, изменения будут доступны после модерации');
                break;
            default:
                return redirect()->route('company.show', ['idOrTranscript' => $entity->id])->with('success', 'Ваша заявка успешно принята, изменения будут доступны после модерации');
                break;
        }
    }
}
