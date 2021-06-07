@extends('layouts.app')

@section('content')
<!-- .modal -->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Staff Detail</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="image" class="control-label">Photo Profile</label>
                        <div class="col-sm-12">
                            <img id="profile-img" src="{{ asset('ProfileImg') }}/DefaultPPimg.jpg" width="100" height="100">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="u_username" class="control-label">Username</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-inputs no-border-light" id="u_username" name="u_username" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Details</h3>
                </div>
                <div class="box-body">
                    <div class="form-group" id="select-sc">
                        <label for="stf_sc_name" class="control-label">Staff Category</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_sc_name" name="stf_sc_name" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group" id="select-fks">
                        <label for="stf_fks_name" class="control-label">Faculty</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_fks_name" name="stf_fks_name" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group" id="select-ps">
                        <label for="stf_ps_name" class="control-label">Research</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_ps_name" name="stf_ps_name" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group" id="select-mk">
                        <label for="stf_mk_name" class="control-label">Course</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_mk_name" name="stf_mk_name" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_fullname" class="control-label">Fullname</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_fullname" name="stf_fullname" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_num_stat" class="control-label">Registered Number</label>
                        <div class="col-sm-12">
                            <select class="col-sm-3 form-multi-control form-inputs no-border-light" name="stf_num_stat" id="stf_num_stat" disabled>
                                <option value="stf_nidn">NIDN</option>
                                <option value="stf_nidk">NIDK</option>
                                <option value="stf_nip">NIP</option>
                                <option value="stf_nik">NIK</option>
                            </select>
                            <input type="tel" class="col-sm-9 form-multi-control form-inputs float-right lecture-num no-border-light" name="" id="" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_education" class="control-label">Education</label>
                        <div class="col-sm-12">
                            <textarea class="form-control form-inputs no-border-light" name="stf_education" id="stf_education" disabled></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_experience" class="control-label">Experiences</label>
                        <div class="col-sm-12">
                            <textarea class="form-control form-inputs no-border-light" name="stf_experience" id="stf_experience" disabled></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_address" class="control-label">Address</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_address" name="stf_address" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_province" class="control-label">Province</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_province" name="stf_province" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_city" class="control-label">City</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_city" name="stf_city" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_birthplace" class="control-label">Birthplace</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_birthplace" name="stf_birthplace" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_birthdate" class="control-label">Birthdate</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control form-inputs no-border-light" id="stf_birthdate" name="stf_birthdate" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_gender" class="control-label">Gender</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_gender" name="stf_gender" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_religion" class="control-label">Religion</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-inputs no-border-light" id="stf_religion" name="stf_religion" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_email" class="control-label">Email Address</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control form-inputs no-border-light" id="stf_email" name="stf_email" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_contact" class="control-label">Contact</label>
                        <div class="col-sm-12">
                            <input type="tel" class="form-control form-inputs no-border-light" id="stf_contact" name="stf_contact" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_state" class="control-label">Country of Origin</label>
                        <div class="col-sm-12">
                            <input type="tel" class="form-control form-inputs no-border-light" id="stf_state" name="stf_state" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stf_status" class="control-label">Staff Status</label>
                        <div class="col-sm-12">
                            <select class="form-control form-inputs no-border-light" name="stf_status" id="stf_status" disabled>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->
<div class="header bg-gradient-red pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <!-- Staff Category Table -->
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Staff Category</h3>
                        {{-- <div class="pull-right">
                            <a href="{{ route('') }}" class="btn btn-success" role="button">Add Category</a>
                        </div> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush" id="sc-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#
                                        <span class="sort" data-sort="name">&nbsp;&nbsp;&nbsp;&nbsp;Name</span>
                                    </th>
                                    <th scope="col" class="sort" data-sort="desc">Description</th>
                                    {{-- <th scope="col" class="sort" data-sort="action">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody class="list">
                                <tr>
                                    <td colspan="2">
                                        <div class="rotate-icon" id="icon-rotate" style="text-align: center;">
                                            <img src="{{ asset('argon') }}/img/brand/spinner.png" width="50px">
                                        </div>
                                        <h4 style="text-align: center; color: white;" id="process-message">Getting data ...</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Staff Table -->
        <div class="row mt-5">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Staff List</h3>
                        <div class="pull-right">
                            <a href="{{ route('Staff.create') }}" class="btn btn-success" role="button">Add Staff</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush" id="stf-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="photo">Photo
                                        <span class="sort" data-sort="name">&nbsp;&nbsp;&nbsp;&nbsp;Name</span>
                                    </th>
                                    <th scope="col" class="sort" data-sort="position">Position</th>
                                    <th scope="col" class="sort" data-sort="number">Number</th>
                                    <th scope="col" class="sort" data-sort="username">Username</th>
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                    <th scope="col" class="sort" data-sort="action">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($staff as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                    @if ($item->up_photo)
                                                        <img src="data:image/{{ pathinfo($item->up_filename, PATHINFO_EXTENSION) }};base64,{{ base64_encode($item->up_photo) }}" alt="img">
                                                    @else
                                                        <img src="{{ asset('ProfileImg') }}/DefaultPPimg.jpg" alt="img">
                                                    @endif
                                                </a>
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $item->stf_fullname }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="position">{{ $item->sc_name }}</td>
                                        <td class="number">{{ str_replace('stf_', '', $item->stf_num_stat) }} :
                                            @switch($item->stf_num_stat)
                                                @case("stf_nidn")
                                                    {{ $item->stf_nidn }}
                                                    @break
                                                @case("stf_nidk")
                                                    {{ $item->stf_nidk }}
                                                    @break
                                                @case("stf_nip")
                                                    {{ $item->stf_nip }}
                                                    @break
                                                @case("stf_nik")
                                                    {{ $item->stf_nik }}
                                                    @break
                                                @default
                                                    No Data
                                            @endswitch
                                        </td>
                                        <td class="username">{{ $item->u_username }}</td>
                                        <td>
                                            @if ($item->stf_status == 1)
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-success"></i>
                                                    <span class="status" title="{{ $item->u_username }} is Active {{ $item->sc_name }}">Active</span>
                                                </span>
                                            @else
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-danger"></i>
                                                    <span class="status" title="{{ $item->u_username }} is Inactive {{ $item->sc_name }}">Inactive</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="action">
                                            <button class="btn btn-sm btn-info btn-table" title="See All Data" type="button" data_id="{{ $item->stf_u_id }}" onclick="ShowDetails(this)">Details</button>
                                            <a href="{{ route('Staff.edit', $item->stf_u_id) }}" class="btn btn-sm btn-primary btn-table" title="Edit Data" role="button">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger btn-table btn-delete-inline" title="Delete Data" data_id="{{ $item->stf_u_id }}" onclick="DeleteStaff(this)">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
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
    <script src="{{ asset('Scripts') }}/Staff.js"></script>
@endpush