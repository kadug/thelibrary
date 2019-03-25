<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BookController extends Controller{
	public function index(){ 
        $books = Book::get();
        $bookCategories = array();
        $bookCategoriesRAW = BookCategory::select('name')->get();
        foreach($bookCategoriesRAW as $c){$bookCategories[] = $c->name;}
		return view('index')->with('books', $books)->with('bookCategories', json_encode($bookCategories));
	}

	public function create(Request $request){
		$CategoryId = '';
		$CategoryName = $request->category;

		if(!BookCategory::where('name', '=', $CategoryName)->exists()){
				$bookcat = new BookCategory;
				$bookcat->name = $request->category;
				$bookcat->save();
				$CategoryId = $bookcat->id;
		}else{
				$bookcat = BookCategory::where('name', '=', $CategoryName)->first();
				$CategoryId = $bookcat->id;
		}
		$book = new Book;
		$book->name = $request->name;
		$book->author = $request->author;
		$book->category_id = $CategoryId;
		$book->published_date = Carbon::parse($request->published_date);
		$book->save();

		update_manybooks();

		return Response::json(array('success' => true, 'message' => 'Book created!'), 200);
	}

	public function edit(Request $request){
		$book = Book::select('books.id', 'books.name as bookname', 'books.author', 'books.published_date', 'book_categories.name as categoryname')
			->join('book_categories', 'books.category_id', '=', 'book_categories.id')->where('books.id', '=', $request->id)->get();
		return $book;
	}

	public function update(Request $request){
		$CategoryId = '';
		$CategoryName = $request->category;

		if(!BookCategory::where('name', '=', $CategoryName)->exists()){
				$bookcat = new BookCategory;
				$bookcat->name = $request->category;
				$bookcat->save();
				$CategoryId = $bookcat->id;
		}else{
				$bookcat = BookCategory::where('name', '=', $CategoryName)->first();
				$CategoryId = $bookcat->id;
		}
		$book = Book::find($request->id);
		$book->name = $request->name;
		$book->author = $request->author;
		$book->category_id = $CategoryId;
		$book->published_date = Carbon::parse($request->published_date);
		$book->save();

		update_manybooks();

		return Response::json(array('success' => true, 'message' => 'Book updated!'), 200);
	}
    
	public function destroy(Request $request){
		Book::destroy($request->id);
		return Response::json(array('success' => true, 'message' => 'Book deleted!'), 200);
	}

	public function getcheckout(Request $request){
		$book = Book::select('books.user')->where('books.id', '=', $request->id)->get();
		return $book;
	}

	public function checkout(Request $request){
		$message = '';
		$book = Book::find($request->id);
		if($request->user){
			$message = 'Book Checkout!';
			$book->user = $request->user;
		}else{
			$book->user = null;
			$message = 'Book Checkin!';
		}
		
		$book->save();
		return Response::json(array('success' => true, 'message' => $message), 200);
	}    
}

function update_manybooks(){
	$categories = BookCategory::all();
	foreach($categories as $cat){
		$countBooks = Book::where('category_id', '=', $cat->id)->count();
		$manybooks = BookCategory::find($cat->id);
		$manybooks->books = $countBooks;
		$manybooks->save();
	}
}
