<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="CheckoutModal" aria-modal="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="mySmallModalLabel">Checkout Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
				<form action="{{route('CheckoutBook')}}" method="POST" id="CheckoutBookForm">
					<input type="hidden" name="id">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-check">
  					<input class="form-check-input" type="checkbox" value="" id="Checkoutbook">
						<label class="form-check-label" for="Checkoutbook">
							Checkout Book
						</label>
					</div>
					<div class="form-group row">
						<label for="BookName" class="col-sm-5 col-form-label">User Name</label>
						<div class="col-sm-7">
							<input type="text" class="form-control form-control-sm" name="user" required>
						</div>
					</div>
				</form>
      </div>
			<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="CheckoutBook">Checkout Book</button>
      </div>
    </div>
  </div>
</div>