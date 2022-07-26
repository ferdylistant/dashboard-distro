<!-- Modal -->
<div class="modal fade" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        <h4 class="modal-title" id="exampleModalCenterTitle"></h4>
      </div>

      <form method="post" id="vendorForm" name="vendorform" action="{{ route('vendor.add') }}">
          @csrf
      <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name Vendor" value="{{ old('name')}}" required>
                </div>
                <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com" value="{{ old('email')}}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="0888xxxxxxx" value="{{ old('phone')}}" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="1" placeholder="Address" required>{{ old('address')}}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="provinsi">Province</label>
                    <select name="province" id="provinsi" class="js-states form-control" data-placeholder="Select a province" data-allow-clear="1" data-required="1" required>
                    <option></option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="kota">City</label>
                    <select name="city" id="kota" class="js-states form-control" data-placeholder="Select a city" data-allow-clear="1" data-required="1" required>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirmation Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-primary">Add vendor</button>
        </div>
    </form>
    </div>
  </div>
</div>
