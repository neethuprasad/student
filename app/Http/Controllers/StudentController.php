<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentMark;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function studentForm()
    {
        $teachers = Teacher::where('status', '=', 1)->get();
        return view('add-student', ['teachers' => $teachers]);
    }

    public function addStudent(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'age' => 'required',
            'gender' => 'required',
            'teacher' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('add-student')
                ->withInput()
                ->withErrors($validator);
        } else {
            try {
                $student = new Student();
                $student->name = $request->name;
                $student->age = $request->age;
                $student->gender = $request->gender;
                $student->teacher_id = $request->teacher;
                $student->save();
                return redirect('students')->with('status', "Student added successfully");
            } catch (Exception $ex) {
                return redirect('add-student')->with('failed', "An error occured");
            }
        }
    }

    public function updateStudent(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'age' => 'required',
            'gender' => 'required',
            'teacher' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('edit-student/' . $id)
                ->withInput()
                ->withErrors($validator);
        } else {
            try {
                $student = Student::find($id);
                if ($student != null) {
                    $student->name = $request->name;
                    $student->age = $request->age;
                    $student->gender = $request->gender;
                    $student->teacher_id = $request->teacher;
                    $student->save();
                    return redirect('students')->with('status', "Student updated successfully");
                } else {
                    return redirect('edit-student/' . $id)->with('failed', "An error occured");
                }
            } catch (Exception $ex) {
                return redirect('edit-student/' . $id)->with('failed', "An error occured");
            }
        }
    }

    public function deleteStudent($id)
    {
        try {
            Student::find($id)->delete();
            StudentMark::where('student_id', '=', $id)->delete();
            return redirect('students')->with('status', "Student deleted successfully");
        } catch (Exception $ex) {
            return redirect('students')->with('failed', "An error occured");
        }
    }

    public function viewStudents()
    {
        $students = DB::table('students')
            ->leftJoin('teachers', 'students.teacher_id', '=', 'teachers.id')
            ->select('students.id', 'students.name', 'students.age', 'students.gender', 'teachers.name as teacher_name')
            ->get();
        return view('students', ['students' => $students]);
    }


    public function editStudent($id)
    {
        $student = DB::table('students')
            ->leftJoin('teachers', 'students.teacher_id', '=', 'teachers.id')
            ->select('students.id', 'students.name', 'students.age', 'students.gender', 'teachers.id as teacher_id')
            ->where('students.id', '=', $id)
            ->first();
        if ($student != null) {
            $teachers = Teacher::where('status', '=', 1)->get();
            return view('edit-student', ['student' => $student, 'teachers' => $teachers]);
        } else {
            return redirect('students')->with('failed', "An error occured");
        }
    }

    public function marksForm()
    {
        $students = Student::all();
        return view('add-marks', ['students' => $students]);
    }

    public function addMarks(Request $request)
    {
        $rules = [
            'student' => 'required',
            'maths' => 'required',
            'history' => 'required',
            'science' => 'required',
            'term' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('add-marks')
                ->withInput()
                ->withErrors($validator);
        } else {
            try {
                $mark = new StudentMark();
                $mark->student_id = $request->student;
                $mark->maths = $request->maths;
                $mark->history = $request->history;
                $mark->science = $request->science;
                $mark->term = $request->term;
                $mark->save();
                return redirect('marks')->with('status', "Mark added successfully");
            } catch (Exception $ex) {
                return redirect('add-marks')->with('failed', "An error occured");
            }
        }
    }

    public function viewMarks()
    {
        $marks = DB::table('students')
            ->join('student_marks', 'students.id', '=', 'student_marks.student_id')
            ->select('students.name', 'student_marks.*', DB::raw('maths+science+history as total_marks'))
            ->get();

        return view('marks', ['marks' => $marks]);
    }

    public function editMark($id)
    {
        $mark = DB::table('students')
            ->join('student_marks', 'students.id', '=', 'student_marks.student_id')
            ->select('students.name', 'student_marks.*', DB::raw('maths+science+history as total_marks'))
            ->where('student_marks.id', '=', $id)
            ->first();
        if ($mark != null) {
            $students = Student::all();
            return view('edit-mark', ['mark' => $mark, 'students' => $students]);
        } else {
            return redirect('marks')->with('failed', "An error occured");
        }
    }

    public function updateMark(Request $request, $id)
    {
        $rules = [
            'student' => 'required',
            'maths' => 'required',
            'history' => 'required',
            'science' => 'required',
            'term' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('add-marks')
                ->withInput()
                ->withErrors($validator);
        } else {
            try {
                $mark = StudentMark::find($id);
                if ($mark != null) {
                    $mark->student_id = $request->student;
                    $mark->maths = $request->maths;
                    $mark->history = $request->history;
                    $mark->science = $request->science;
                    $mark->term = $request->term;
                    $mark->save();
                    return redirect('marks')->with('status', "Mark added successfully");
                } else {
                    return redirect('edit-marks')->with('failed', "An error occured");
                }
            } catch (Exception $ex) {
                return redirect('edit-marks')->with('failed', "An error occured");
            }
        }
    }

    public function deleteMark($id)
    {
        try {
            StudentMark::find($id)->delete();
            return redirect('marks')->with('status', "Mark deleted successfully");
        } catch (Exception $ex) {
            return redirect('marks')->with('failed', "An error occured");
        }
    }
}
