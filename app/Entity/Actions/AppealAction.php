<?php

namespace App\Entity\Actions;

use App\Models\Appeal;

class AppealAction
{
    public function store($request, $entityId = null, $userId = null): Appeal
    {
        $appeal = new Appeal();

        $appeal->name = $request->name;
        $appeal->phone = $request->phone;
        $appeal->message = $request->message;
        $appeal->entity_id = $entityId;
        $appeal->user_id = $userId;
 
        $appeal->save();

        return $appeal;
    }

    public function update($request, $appeal): Appeal
    {
        $appeal->message = $request->message;
        $appeal->activity = $request->activity ? 1 : 0;
        
        $appeal->update();

        return $appeal;
    }
}
