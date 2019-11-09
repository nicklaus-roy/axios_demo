<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index()
    {
    	//get all categories
    	$categories = DB::table('question_categories')
    		->get();
    	//return view
    	return view('welcome')->with('categories', $categories);
    }

    public function filter()
    {
    	//SELECT * FROM questions INNER JOIN question_categories
    	//ON questions.id = question_choices.question_id
    	$questions = DB::table('questions')
    		->join('question_choices', 'questions.id', '=', 'question_choices.question_id')
            ->select('questions.*', 'question_choices.*')
    		->where('category_id', request()->category_id)
    		->get();
        //return result to axios 
    	return $questions;
    }
}
