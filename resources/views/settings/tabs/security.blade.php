<div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab">
    <div class="card">
        <form method="POST" action="/settings/security/changepassword">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Old Password<sup class="error">*</sup> </label>
                            <input type="password" class="form-control" name="old_password" required placeholder="Enter old password">
                        </div>
                        <div class="form-group">
                            <label>New Password<sup class="error">*</sup></label>
                            <input id="password" type="password" pattern="^(?=.*?[A-Z])(?=.*?[0-9]).{8,}$" class="form-control" name="password" required placeholder="Enter new password">
                            <p class="m-0 text-muted"><small>The password must contain at least 8 characters with one uppercase and one number.</small></p>
                        </div>
                        <div>
                            <label>Confirm Password<sup class="error">*</sup></label>
                            <input type="password" class="form-control" pattern="^(?=.*?[A-Z])(?=.*?[0-9]).{8,}$" data-parsley-equalto="#password" name="password_confirmation" required placeholder="Enter confirm password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
</div>