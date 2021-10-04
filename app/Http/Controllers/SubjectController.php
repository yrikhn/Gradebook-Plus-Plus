<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('dashboard', compact('subjects'));
    }

    public function addSubject(Request $request)
    {
        $subject = new Subject();

        $subject->institution_id = $request->input('institution');
        $subject->subject = $request->input('subject');

        $subject->save();

        if ($subject->save()) {
            Session::flash('message', 'Subject "' . $subject->subject . '" was successfully added.');
            Session::flash('alert-class', 'bg-green-500');
            return redirect()->back();
        } else {
            Session::flash('message', 'Subject "' . $subject->subject . '" failed to be added.');
            Session::flash('alert-class', 'bg-red-500');
            return redirect()->back();
        }
    }
}
