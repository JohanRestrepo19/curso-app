<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

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

	public function getAllBooksForDataTable()
	{
		$books = Book::with('author');
		return DataTables::of($books)
			->addColumn('action', function ($row) {
				return "<a
				href='#'
				onclick='event.preventDefault();'
				data-id='{$row->id}'
				role='edit'
				class='btn btn-warning btn-sm'>Edit</a>
				<a
				href='#'
				onclick='event.preventDefault();'
				data-id='{$row->id}'
				role='delete'
				class='btn btn-danger btn-sm'>Delete</a>";
			})
			->rawColumns(['action'])
			->make();
	}

	public function showHomeWithBooks()
	{
		$books = $this->getAllBooks()->original['books'];
		return view('index', compact('books'));
	}

	public function saveBook(Request $request)
	{
		$book = new Book($request->all());
		$this->uploadImage($request, $book);
		$book->save();
		return response()->json(['created' => $book], 201);
	}

	public function updateBook(Book $book, Request $request)
	{
		$requestAll = $request->all();
		$this->uploadImage($request, $book);
		$requestAll['image'] = $book->image;
		$book->update($requestAll);
		return response()->json(['book' => $book->refresh()->load('author', 'category')], 201);
	}

	public function getBook(Book $book)
	{
		$book->load(['author', 'category']);
		return response()->json(['book' => $book], 200);
	}

	public function deleteBook(Book $book)
	{
		$status = $book->delete();
		return response()->json(['response' => $status], 200);
	}

	private function uploadImage($request, &$book)
	{
		if (!isset($request->image)) return;
		$random = Str::random(20);
		$imageName = "{$random}.{$request->image->clientExtension()}";
		$request->image->move(storage_path('app/public/images'), $imageName);
		$book->image = $imageName;
	}
}
