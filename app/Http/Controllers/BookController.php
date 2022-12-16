<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
	public function showAllBooks()
	{
		return view('books.index');
	}

	public function getAllBooks()
	{
		$books = Book::with(['author'])->get();
		return response()->json(['books' => $books], 200);
	}

	public function showHomeWithBooks()
	{
		$books = $this->getAllBooks()->original['books'];
		return view('index', compact('books'));
	}
}
