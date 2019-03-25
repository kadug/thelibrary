

<div class="modal fade" id="EditBookModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('UpdateBook')}}" method="POST" id="Editbook">
					<input type="hidden" name="id">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
					<div class="form-group row">
						<label for="BookName" class="col-sm-4 col-form-label">Book Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" name="name" required>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="BookAuthor" class="col-sm-4 col-form-label">Book Author</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" name="author" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="BookCategory" class="col-sm-4 col-form-label">Book Category</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm" name="category" required data-categories="{{$bookCategories}}">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="BookDate" class="col-sm-4 col-form-label">Published Date</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm DatePicker" name="published_date" required>
						</div>
  				</div>

				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="UpdateBook">Update Book</button>
      </div>
    </div>
  </div>
</div>