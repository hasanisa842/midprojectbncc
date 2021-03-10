<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Books;
use Redirect,Response;

class BooksController extends Controller
{

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/

	public function index()
	{
		$books = Books::latest()->paginate(4);
		return view('books.index',compact('books'))->with('i', (request()->input('page', 1) - 1) * 4);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/

	public function create()
	{
		return view('books.create');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response
	*/

	public function store(Request $request)
	{

		$r=$request->validate([
		'title' => 'required',
		'author' => 'required',
		'pages' => 'required',
        'year' => 'required',
		]);

		$employeeId = $request->employee_id;
		Books::updateOrCreate(['id' => $employeeId],
        ['title' => $request->title, 
        'author' => $request->author,
        'pages'=>$request->pages,
        'year'=>$request->year,
        ]);

		if(empty($request->employee_id))
			$msg = 'Book entry created successfully.';

		else
			$msg = 'Book data is updated successfully';

		return redirect()->route('books.index')->with('success',$msg);
	}

	/**
	* Display the specified resource.
	*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/

	public function show(Books $books)
	{
		return view('books.show',compact('books'));
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	
	public function edit($id)
	{
		$where = array('id' => $id);
		$books = Books::where($where)->first();
		return Response::json($books);
	}

	/**
	* Update the specified resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @param int $id
	* @return \Illuminate\Http\Response
	*/

	public function update(Request $request)
	{

	}

	/**
	* Remove the specified resource from storage.
	*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/

	public function destroy($id)
	{
		$books = Books::where('id',$id)->delete();
		return Response::json($books);
	}
}