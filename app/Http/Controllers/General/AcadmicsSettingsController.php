<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AcadmicsSettingsController extends Controller
{
    public function academicList(): View
    {
        return view('general-settings.academic-settings');
    }
}
