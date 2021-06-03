@extends('layouts.app')

@section('content')
<!-- .modal -->
<div class="modal fade" id="AddEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="" method="" id="form">
              @csrf
              <div class="box-body">
                  <div class="form-group">
                      <div class="col-sm-12">
                          <img id="profile-img" src="" width="100" height="100" data-id="">
                          <div>
                              <label for="u_file" class="control-label">Photo Profile</label>
                              <input type="file" class="form-control-file" id="u_file" accept="image/*">
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-12">
                          <input type="text" class="form-control form-inputs" placeholder="Username" id="u_username">
                          <div hidden id="username-alrt" class="alert alert-danger" role="alert">
                              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                              <span class="sr-only">Error:</span>
                              Username must have value!
                          </div>
                      </div>
                  </div>
                  <div class="form-group" id="pass-txtbox">
                      <div class="col-sm-12">
                          <input type="password" class="form-control form-inputs" placeholder="Password" id="u_password">
                          <div hidden id="password-alrt" class="alert alert-danger" role="alert">
                              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                              <span class="sr-only">Error:</span>
                              Password must have value!
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-12">
                          <input type="text" class="form-control form-inputs" placeholder="Fullname" id="c_name">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-12">
                          <input type="text" class="form-control form-inputs" placeholder="Position" id="c_remark">
                      </div>
                  </div>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" id="btn-add-client">Save</button>
          <button type="button" class="btn btn-success" id="btn-edit-client">Edit</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->
<div class="header bg-gradient-red pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Directors</h3>
                        <div class="pull-right">
                            <a href="#" class="btn btn-success" role="button" data-toggle="modal" data-target="#AddEditModal" id="Add-btn">Add Directors</a>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col" class="sort" data-sort="photo">Photo
                                <span class="sort" data-sort="name">&nbsp;&nbsp;&nbsp;&nbsp;Name</span>
                            </th>
                            <th scope="col" class="sort" data-sort="code">Code</th>
                            <th scope="col" class="sort" data-sort="username">Username</th>
                            <th scope="col" class="sort" data-sort="position">Position</th>
                            <th scope="col" class="sort" data-sort="action">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($client as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="#" class="avatar rounded-circle mr-3">
                                                @if ($item->up_photo != null)
                                                    <img src="data:image/{{ pathinfo($item->up_filename, PATHINFO_EXTENSION) }};base64,{{ base64_encode($item->up_photo) }}" alt="img">
                                                @else
                                                    <img src="{{ asset('ProfileImg') }}/DefaultPPimg.jpg" alt="img">
                                                @endif
                                            </a>
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $item->c_name }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="code">{{ $item->c_code }}</td>
                                    <td class="username">{{ $item->u_username }}</td>
                                    <td class="position">{{ $item->c_remark }}</td>
                                    <td class="action">
                                        <a class="btn btn-sm btn-info btn-table" data-toggle="tooltip" data-html="true" title="See All Data" id="btndetail{{ $loop->index }}" role="button" data_id="{{ $item->c_u_id }}" onclick="ShowDetails(this)">Details</a>
                                        <a class="btn btn-sm btn-primary btn-table" data-toggle="tooltip" data-html="true" title="Edit Data" id="btnedit{{ $loop->index }}" role="button" data_id="{{ $item->c_u_id }}" onclick="ShowEditModals(this)">Edit</a>
                                        <a class="btn btn-sm btn-danger btn-table" data-toggle="tooltip" data-html="true" title="Delete Data" id="btndelete{{ $loop->index }}" role="button" data_id="{{ $item->c_u_id }}" onclick="DeleteClient(this)">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <h4 style="text-align: center; color: white;">There is no data</h4>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('Scripts') }}/Client.js"></script>
@endpush