<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\AppealAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Appeal\UpdateAppealRequest;
use App\Models\Appeal;

class AppealController extends BaseAdminController
{
    public function __construct(private AppealAction $appealAction)
    {
        parent::__construct();
        $this->appealAction = $appealAction;
    }

    public function index()
    {
        return view('admin.appeal.index', ['menu' => $this->menu]);
    }

    public function edit(Appeal $appeal)
    {
        return view('admin.appeal.edit', ['menu' => $this->menu, 'appeal' => $appeal]);
    }

    public function update(UpdateAppealRequest $request, Appeal $appeal)
    {
        $appeal = $this->appealAction->update($request, $appeal);

        return redirect()->route('admin.appeal.edit', ['appeal' => $appeal->id])
            ->with('success', 'Сообщение сохранена');
    }

    public function destroy(Appeal $appeal)
    {
        $appeal->delete();

        return redirect()->route('admin.appeal.index')->with('success', 'Сообщение удалена');
    }
}
