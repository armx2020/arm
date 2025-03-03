<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\EntityAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Entity\UpdateEntityRequest;
use App\Models\Entity;
use App\Models\Image;
use App\Models\Scopes\CheckedScope;
use App\Models\Scopes\SortAscScope;

class ImageController extends BaseAdminController
{
    public function __construct(private EntityAction $entityAction)
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.image.index', ['menu' => $this->menu]);
    }

    public function edit()
    {
        return view('admin.image.index', ['menu' => $this->menu]);
    }

 
    public function destroy(Image $image)
    {
        $entity = Image::withOutGlobalScopes([SortAscScope::class, CheckedScope::class])->find($image->id);

        $entity->delete();

        return redirect()->back()->with('success', 'Изображение удалено');
    }


}
