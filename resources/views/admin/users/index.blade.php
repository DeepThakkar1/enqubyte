@extends('admin.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents border-bottom-0 headline-contents-height">
        <h2 class="d-inline-block headline-content"><span><a href="/admin/dashboard"> Dashboard  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Users</h2>
    </div>
    <div class="table-responsive-sm">
        <table class="table dataTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td><img src="{{ Avatar::create($user->fullname)->toBase64() }}" style="width: 32px; height: 32px; margin-right: 7px;">
                        {{$user->fullname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="#changePlanModal{{$key}}" data-toggle="modal" class="btn btn-outline-primary">Change Plan</a>

                            <div class="modal fade in changePlanModal{{$key}} pr-md-0" id="changePlanModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Plan</h5>
                                            <button type="button" class="close btn-close-modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Plan<sup class="error">*</sup></label>
                                                    <select name="plan" class="form-control" required>
                                                        <option disabled selected>-- Select Plan --</option>
                                                        @foreach($plans as $plan)
                                                        <option value="{{$plan->id}}" {{$plan->id == $user->plan ? 'selected' : ''}}>{{$plan->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-close-modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary"> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>

    @endsection
