<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Institution;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class InstitutionController extends Controller {
    public function index() {
        $institutions = Institution::all();
        $subjects = Subject::all();
        return view('dashboard', compact('institutions', 'subjects'));
    }

    public function insert(Request $request) {

        $institution = new Institution();

        $institution->institution = $request->validate([
            'institution_name' => 'required|max:20'
        ]);

        $institution->institution = $request->input('institution_name');
        $institution->user_id = Auth()->user()->id;
        $institution->save();

        if ($institution->save()) {
            Session::flash('message', 'Institution "' . $institution->institution . '" was successfully added.');
            Session::flash('alert-class', 'bg-green-500');
            return redirect()->back();
        } else {
            Session::flash('message', 'Institution "' . $institution->institution . '" failed to be added.');
            Session::flash('alert-class', 'bg-red-500');
            return redirect()->back();
        }
    }
}
