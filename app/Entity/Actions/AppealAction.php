<?php

namespace App\Entity\Actions;

use App\Models\Appeal;

class AppealAction
{
    public function store($request): Appeal
    {
        $appeal = new Appeal();

        $appeal->name = $request->name;
        $appeal->phone = $request->phone;
        $appeal->message = $request->message;

        $appeal->save();

        return $appeal;
    }
}
