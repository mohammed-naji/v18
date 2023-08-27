<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $courses = Course::all();

        $col = 'id';
        $type = 'asc';

        if($request->has('column')) {

            $col = $request->column;
            if(!in_array($col, ['id', 'name', 'price', 'created_at'])) {
                $col = 'id';
            }
            $type = $request->type;
        }

        // where name like et%

        // $result = DB::select("SELECT * FROM courses WHERE name like '%?%'", [$request->q, $request->q]);

        // dd($result);

        if($request->has('q') && !empty($request->q)) {
            $courses = Course::orderBy($col, $type)
            ->where('name', 'like', '%'.$request->q.'%')
            ->orWhere('price', 'like', '%'.$request->q.'%')
            ->paginate(10);
        }else {
            $courses = Course::orderBy($col, $type)->paginate(10);
        }
        // dd($courses);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // validation
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg',
            'content' => 'required',
            'price' => 'required|numeric',
            'hours' => 'required|numeric',
        ]);

        // upload files
        $img_name = time().rand().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $img_name);
        // abc.png => 655465465717982797abc.png

        // store in database
        // 1. Using Model Object
        // $course = new Course();
        // $course->name    = $request->name;
        // $course->image   = $img_name;
        // $course->content = $request->content;
        // $course->price   = $request->price;
        // $course->hours   = $request->hours;
        // $course->save();
        // INSERT INTO courses (name, image) VALUES ('', '')

        // 2. Using Model Method
        Course::create([
            'name' => $request->name,
            'image' => $img_name,
            'content' => $request->content,
            'price' => $request->price,
            'hours' => $request->hours,
        ]);

        // redirect to another route
        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'Showwww Delete Post ' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // DELETE FROM courses WHERE id = $id
        Course::destroy($id);

        return redirect()->route('courses.index');
    }

    function trash() {
        $courses = Course::onlyTrashed()->latest('deleted_at')->paginate(10);

        return view('courses.trash', compact('courses'));
    }

    function restore($id) {
        $course = Course::onlyTrashed()->find($id)->restore(); // Select * from courses where id = $id

        // return redirect()->back();
        return redirect()->route('courses.index');
    }

    function forcedelete($id) {
        $course = Course::onlyTrashed()->find($id)->forcedelete(); // Select * from courses where id = $id

        // return redirect()->back();
        return redirect()->route('courses.index');
    }
}


//
