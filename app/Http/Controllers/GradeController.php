<?php


namespace App\Http\Controllers;


use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class GradeController
{
    public function addGrade(Request $request) {
        $grade = new Grade();

        $grade->subject_id = $request->input('subject');

        $grade->grade = $request->validate([
            'grade' => 'required|numeric|between:0.00,6.00'
        ]);

        $grade->grade = $request->input('grade');

        $grade->grade = Crypt::encrypt($grade->grade);

        $grade->save();


        if ($grade->save()) {
            Session::flash('message', 'Subject "' . $grade->grade . '" was successfully added to ' . $grade->subject['subject']);
            Session::flash('alert-class', 'bg-green-300');
            return redirect()->back();
        } else {
            Session::flash('message', 'Subject "' . $grade->grade . '" failed to be added ' . $grade->subject['subject']);
            Session::flash('alert-class', 'bg-red-300');
            return redirect()->back();
        }
    }
}
