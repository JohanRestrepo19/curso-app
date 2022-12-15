<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
	private function getAllBooks()
	{
		$books = Book::all();
		return response()->json(['books' => $books], 200);
	}

	public function showHomeWithBooks()
	{
		$books = $this->getAllBooks()->original['books'];
		return view('index', compact('books'));
	}
}
