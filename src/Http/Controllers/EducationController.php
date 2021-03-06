<?php

namespace Escuccim\Resume\Http\Controllers;

use Illuminate\Http\Request;
use Escuccim\Resume\Models\Education;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    public function __construct(){
        $this->middleware(config('cv.admin_middleware'));
    }

    public function index(){
        $educations = Education::get();
        return view('cv::education.index', compact('educations'));
    }

    public function create(){
        $education = new Education();
        return view('cv::education.create', compact('education'));
    }

    public function store(Request $request){
        // validate the form
        $this->validate($request,[
           'school' => 'required',
            'location' => 'required',
            'major' => 'required',
            'end_date' => 'required',
            'lang' => 'required',
            'type' => 'required',
        ]);
        // store the data
        $education = Education::create($request->all());
        // redirect
        return redirect('/education');
    }

    public function edit($id){
        $education = Education::where('id', $id)->first();
        return view('cv::education.edit', compact('education'));
    }

    public function update($id, Request $request){
        // validate the form
        $this->validate($request,[
            'school' => 'required',
            'location' => 'required',
            'major' => 'required',
            'end_date' => 'required',
            'lang' => 'required',
            'type' => 'required'
        ]);
        $education = Education::find($id);
        $education->update($request->all());
        return redirect('/education');
    }

    public function destroy($id){
        Education::destroy($id);
        return redirect('/education');
    }
}
