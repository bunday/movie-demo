<?php

namespace App\Http\Controllers;

use App\Comment;
use Auth;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Movie as AppMovie;
use Illuminate\Support\Str;

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
        return AppMovie::collection(Movie::all());
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
            $location = '/images/default.png';
            if(!is_null($image)){
                $filename =  $tag. '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/images/films/'), $filename);
                $location = url('/').'/images/films/' . $filename;
            }

            //Add User ID and the image to the data
            $data['user_id'] = 1;//Auth::id();
            $data['image'] = $location;
            $data['slug'] = Str::slug($data['title'],'_');
            //Save to DB
            Movie::create($data);
            //return success
            return $this->successCreationWithoutData('Movie created succeessfully');
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
        return $this->successCreationWithData("Movie Fetched", new AppMovie($movie));
    }
    public function commentOnMovie(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::id();
        dd(Auth::user());
        Comment::create($data);
        return $this->successCreationWithoutData('Comment added succeessfully');
    }


    public function formError($message){
        return response()->json(['status'=>'fail','message'=>'Oops! looks like there is an error in the Uploaded form','data'=>$message],400);
    }
    public function successCreationWithoutData($message){
        return response()->json(['status'=>'success','message'=>$message],201);
    }
    public function successCreationWithData($message,$data){
        return response()->json(['status'=>'success','message'=>$message,'data'=>$data],201);
    }
}
