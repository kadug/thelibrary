<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>The Library</title>

	<!-- Styles -->
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/datatables.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/fontawesome.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- Main Navigation Bar -->
	<div class="p-3 mb-3 bg-dark border-bottom text-light shadow-sm">
		<div class="container d-flex flex-column flex-md-row align-items-center">
			<h5 class="my-0 mr-md-auto font-weight-normal">The Library</h5>
  		<nav class="my-md-0">
    		<a class="p-2 text-light" href="#" data-toggle="modal" data-target="#NewBookModal">Add Book</a>
  		</nav>
		</div> 
	</div>
	@yield('content')

	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/jquery-ui.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/datatables.min.js')}}"></script>
	<script src="{{asset('js/datatables.bootstrap.min.js')}}"></script>
	<script src="{{asset('js/jquery.validate.min.js')}}"></script>
	<script>
		$(function(){
			$('#BooksTable').DataTable();
			$(".DatePicker").datepicker();
			$("#UpdateBookForm").validate();
			$("#RegisterNewBook").validate();
			$("#CheckoutBookForm").validate();
			$("input[name=category]").autocomplete({source: $("input[name=category]").data('categories')});

			$("#SaveBook").click(function(){
				if($("#RegisterNewBook").valid()){
					var form = new FormData();
					form.append("name", $('#RegisterNewBook input[name=name]').val());
					form.append("_token", $('#RegisterNewBook input[name=_token]').val());
					form.append("author", $('#RegisterNewBook input[name=author]').val());
					form.append("category", $('#RegisterNewBook input[name=category]').val());
					form.append("published_date", $('#RegisterNewBook input[name=published_date]').val());

					$.ajax({url:$('#RegisterNewBook').attr('action'), type: 'POST', processData: false, contentType: false, data: form, success:function(data){
						$('#NewBookModal').modal('hide');
						$('.alert.alert-success').text(data.message); 
						$('.alert.alert-success').fadeIn().delay(2000).fadeOut('slow'); 
						setTimeout(function(){window.location.reload();}, 2000);
					}});
				}
			});

			$('.deleteBook').click(function(){
				var Bookid = $(this).data('id');
				if(confirm("Are you sure you want to delete?")){
					$.ajax({url:"{{route('DeleteBook')}}", type: 'GET', data: {id:Bookid}, success:function(data){
						$('.alert.alert-success').text(data.message);
						$('.alert.alert-success').fadeIn().delay(2000).fadeOut('slow'); 
						setTimeout(function(){window.location.reload();}, 2000);
					}});
				}				
			});

			$('.editBook').click(function(){
				var Bookid = $(this).data('id');
				$.ajax({url:"{{route('EditBook')}}", type: 'GET', data: {id:Bookid}, success:function(data){
					var book = data[0];
					var published_date = new Date(book.published_date);
					published_date.setDate(published_date.getDate() + 1, 1);
					$('#Editbook input[name=id]').val(book.id);
					$('#Editbook input[name=name]').val(book.bookname);
					$('#Editbook input[name=author]').val(book.author);
					$('#Editbook input[name=category]').val(book.categoryname);
					$('#Editbook input[name=published_date]').val(book.published_date);
					$("#Editbook .DatePicker").datepicker("setDate", published_date);
					$('#EditBookModal').modal('show');
				}});		
			});

			$("#UpdateBook").click(function(){
				if($("#Editbook").valid()){
					var form = new FormData();
					form.append("id", $('#Editbook input[name=id]').val());
					form.append("name", $('#Editbook input[name=name]').val());
					form.append("_token", $('#Editbook input[name=_token]').val());
					form.append("author", $('#Editbook input[name=author]').val());
					form.append("category", $('#Editbook input[name=category]').val());
					form.append("published_date", $('#Editbook input[name=published_date]').val());

					$.ajax({url:$('#Editbook').attr('action'), type: 'POST', processData: false, contentType: false, data: form, success:function(data){
						$('#EditBookModal').modal('hide');
						$('.alert.alert-success').text(data.message); 
						$('.alert.alert-success').fadeIn().delay(2000).fadeOut('slow'); 
						setTimeout(function(){window.location.reload();}, 2000);
					}});
				}
			});

			$('.checkout').click(function(){
				var BookId = $(this).data('id');
				$("#CheckoutBookForm")[0].reset();
				$('#CheckoutBookForm input[name=user]').attr('disabled', false);
				$.ajax({url:"{{route('GetCheckoutBook')}}", type: 'GET', data: {id:BookId}, success:function(data){
					var book = data[0];
					$('#CheckoutBookForm input[name=id]').val(BookId);
					if(book.user){
						$('#Checkoutbook')[0].checked = true;
						$('#CheckoutBookForm input[name=user]').val(book.user);
						$('#CheckoutBookForm input[name=user]').attr('disabled', true);
					}
					$('#CheckoutModal').modal('show');
				}});	
			});

			$('#CheckoutBook').click(function(){
				if($("#CheckoutBookForm").valid()){
					var form = new FormData();
					form.append("id", $('#CheckoutBookForm input[name=id]').val());
					form.append("_token", $('#CheckoutBookForm input[name=_token]').val());
					if($('#Checkoutbook:checked').length > 0){ form.append("user", $('#CheckoutBookForm input[name=user]').val()); }

					$.ajax({url:$('#CheckoutBookForm').attr('action'), type: 'POST', processData: false, contentType: false, data: form, success:function(data){
						$('#CheckoutModal').modal('hide');
						$('.alert.alert-success').text(data.message); 
						$('.alert.alert-success').fadeIn().delay(2000).fadeOut('slow'); 
						setTimeout(function(){window.location.reload();}, 2000);
					}});
				}
			});
		});
	</script>
</body>
</html>