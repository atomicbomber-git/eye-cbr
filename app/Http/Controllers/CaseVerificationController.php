<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseRecord;

class CaseVerificationController extends Controller
{
    public function create(CaseRecord $case_record)
    {
        $case_record->verified = 1;
        $case_record->save();
        
        return redirect()
            ->route('verified_case.index')
            ->with([
                'message' => __('messages.update.success'),
                'message_state' => 'success'
            ]);
    }
}
