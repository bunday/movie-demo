<?php

namespace App\Http\Controllers;

use Auth;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ResponseController;

class MovieController extends Controller
{
    private function validateData(){
        $status = true;
        $validator = Validator::make(request()->all(),[
            'title' => 'required',
            'description' => 'required',
            'release_date' => 'required',
            'rating' => 'required|integer|between:1,5',
            'price' => 'required|min:0',
            'country' => 'required',
            'genre' => 'required',
            'image' => 'required'
        ]);
        if ($validator->fails()) {
            $status = $validator->messages();
        }
        return $status;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::collection();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validity = $this->validateData();
        if ($validity=="true"){
            $data = $request->all();

            //Move the image somewhere if it exist
            $image = $request->image;
            $tag = time();
            $location = '/images/films/default.png';
            if(!is_null($image)){
                $filename =  $tag. '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/images/films/'), $filename);
                $location = url('/').'/images/films/' . $filename;
            }

            //Add User ID and the image to the data
            $data['user_id'] = Auth::id();
            $data['image'] = $location;
            //Save to DB
            Movie::create($data);
            //return success
        }
        //return error response
        return $this->formError($validity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    public function formError($message){
        return response()->json(['status'=>'fail','message'=>'Oops! looks like there is an error in the Uploaded form','data'=>$message],400);
    }
}
