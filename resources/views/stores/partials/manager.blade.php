<div class="card mb-4">
    <div class="card-body">
        
        <h3 class="d-inline-block ">Managers</h3>
        <a href="#addManagerModal" data-toggle="modal" class="btn btn-primary float-right"><i class="fa fa-plus-circle"></i> Add Manager</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th width="160px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($managers))
                    @foreach($managers as $key => $manager)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$manager->fullname}}</td>
                        <td>{{$manager->email}}</td>
                        <td>{{$manager->phone}}</td>
                        <td>
                            <a href="#editManagerModal{{$key}}" data-toggle="modal" class="btn btn-primary btn-sm product-edit-btn"><i class="fas fa-pencil-alt"></i> Edit </a>
                            <form method="post" action="/stores/{{$store->id}}/manager/{{$manager->id}}/delete" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure, You want to delete this manager?');"><i class="fa fa-trash"></i> Delete</button>
                            </form>

                            <div class="modal fade in editManagerModal{{$key}}" id="editManagerModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Manager</h5>
                                            <button type="button" class="close btn-close-modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="/stores/{{$store->id}}/manager/{{$manager->id}}/update">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <label>First Name<sup class="error">*</sup></label>
                                                        <input type="text" name="fname" value="{{isset($manager->fname) ? $manager->fname : ''}}" class="form-control" placeholder="First name" required>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Last Name<sup class="error">*</sup></label>
                                                        <input type="text" name="lname" value="{{isset($manager->lname) ? $manager->lname : ''}}" class="form-control" placeholder="Last name" required>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <label>Email ID</label>
                                                        <input type="email" name="email" value="{{isset($manager->email) ? $manager->email : ''}}" class="form-control" placeholder="Manager email" required>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Phone<sup class="error">*</sup></label>
                                                        <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" value="{{isset($manager->phone) ? $manager->phone : ''}}" class="form-control" placeholder="Phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        {{ $managers->links() }}
    </div>
</div>

<div class="modal fade in addManagerModal" id="addManagerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Manager</h5>
                <button type="button" class="close btn-close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/stores/{{$store->id}}/manager">
                @csrf
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>First Name<sup class="error">*</sup></label>
                            <input type="text" name="fname" class="form-control" placeholder="First name" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Last Name<sup class="error">*</sup></label>
                            <input type="text" name="lname" class="form-control" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Email ID<sup class="error">*</sup></label>
                            <input type="email" name="email" class="form-control" placeholder="Manager email" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Phone<sup class="error">*</sup></label>
                            <input type="text" maxlength="10" minlength="10" pattern="\d*" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label>Password<sup class="error">*</sup></label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>