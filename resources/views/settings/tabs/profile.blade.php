<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="card">
        <form method="post" action="/settings/profile/update">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="fname" value="{{ auth()->user()->fname }}" placeholder="First name" required>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lname" value="{{ auth()->user()->lname }}" placeholder="Last name" required>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Email Id</label>
                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" placeholder="Email address" required>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" readonly value="{{ auth()->user()->company_username }}" placeholder="Username">
                    </div>

                    <!-- <div class="col-sm-4 form-group">
                        <label>Estimated Monthly Sales</label>
                        <select type="text" class="form-control" name="estimated_monthly_sales" required>
                            <option selected disabled>-- Estimated Monthly Sales --</option>
                            <option value="0" {{ auth()->user()->estimated_monthly_sales == 0 ? 'selected' : '' }}>Less than 50k</option>
                            <option value="1" {{ auth()->user()->estimated_monthly_sales == 1 ? 'selected' : '' }}>50k to 2 lacs</option>
                            <option value="2" {{ auth()->user()->estimated_monthly_sales == 2 ? 'selected' : '' }}>2 lacs to 5 lacs</option>
                            <option value="3" {{ auth()->user()->estimated_monthly_sales == 3 ? 'selected' : '' }}>more than 5 lacs</option>
                        </select>
                    </div> -->
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>