<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kasus;

class CaseVerificationController extends Controller
{
    public function create(Kasus $case_record)
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

    public function delete(Kasus $case_record)
    {
        $case_record->verified = 0;
        $case_record->save();

        return redirect()
            ->route('unverified_case.index')
            ->with([
                'message' => __('messages.update.success'),
                'message_state' => 'success'
            ]);
    }
}
