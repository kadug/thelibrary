@extends('master')
@section('content')
	<div class="container">
		<div class="alert alert-success" role="alert"></div>
		<table class="table text-center table-striped table-bordered" id="BooksTable">
			<thead>
				<th>Book Name</th>
				<th>Book Author</th>
				<th>Book Publication Date</th>
				<th>Category</th>
				<th>Availability</th>
				<th>Options</th>
			</thead>
			<tbody>
				@foreach($books as $b)
					<tr>
						<td>{{$b->name}}</td>
						<td>{{$b->author}}</td>
						<td>{{\Carbon\Carbon::parse($b->published_date)->toFormattedDateString()}}</td>
						<td>{{$b->category->name}}</td>
						<td>@if(empty($b->user)) Available @else {{$b->user}} @endif</td>
						<td>
							<button type="button" class="btn btn-success btn-sm checkout" data-id="{{$b->id}}"><span class="fas fa-file-export" title="Checkout Book"></span></button>
							<button type="button" class="btn btn-primary btn-sm editBook" data-id="{{$b->id}}"><span class="fas fa-edit" title="Edit Book"></span></button>
							<button type="button" class="btn btn-danger btn-sm deleteBook" data-id="{{$b->id}}"><span class="fas fa-trash" title="Delete Book"></span></button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@include('modals.newbook')
	@include('modals.editbook')
	@include('modals.checkout')
@endsection
