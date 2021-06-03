@extends('layouts.app')

@section('content')
<div class="header bg-gradient-red pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Add Staff</h3>
                    </div>
                    {{-- Error Handling --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong> An Error has occured with your input
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" action="{{ route('Staff.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <img id="profile-img" src="{{ asset('ProfileImg') }}/DefaultPPimg.jpg" width="100" height="100">
                                    <div>
                                        <label for="image" class="control-label text-white">Photo Profile</label>
                                        <input type="file" class="form-control-file text-white" id="image" name="image" placeholder="image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="u_username" class="control-label text-white">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: John_123" id="u_username" name="u_username">
                                </div>
                            </div>
                            <div class="form-group" id="pass-txtbox">
                                <label for="u_password" class="control-label text-white">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control form-inputs" placeholder="Ex: pass1234" id="u_password" name="u_password">
                                </div>
                            </div>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title text-white">Details</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group" id="select-sc">
                                <label for="stf_sc_id" class="control-label text-white">Staff Category</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-inputs" name="stf_sc_id" id="stf_sc_id"></select>
                                </div>
                            </div>
                            <div class="form-group" id="select-fks">
                                <label for="stf_fks_id" class="control-label text-white">Faculty</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-inputs" name="stf_fks_id" id="stf_fks_id"></select>
                                </div>
                            </div>
                            <div class="form-group" id="select-ps">
                                <label for="stf_ps_id" class="control-label text-white">Research</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-inputs" name="stf_ps_id" id="stf_ps_id">
                                        <option selected value="null">Please Select Faculty</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="select-mk">
                                <label for="stf_mk_id" class="control-label text-white">Course</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-inputs" name="stf_mk_id" id="stf_mk_id">
                                        <option selected value="null">Please Select Faculty & Research</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_fullname" class="control-label text-white">Fullname</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: John Doe" id="stf_fullname" name="stf_fullname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_num_stat" class="control-label text-white">Registered Number</label>
                                <div class="col-sm-12">
                                    <select class="col-sm-2 form-multi-control form-inputs" name="stf_num_stat" id="stf_num_stat" onchange="setNumberType(this)">
                                        <option value="stf_nidn">NIDN</option>
                                        <option value="stf_nidk">NIDK</option>
                                        <option value="stf_nip">NIP</option>
                                        <option value="stf_nik">NIK</option>
                                    </select>
                                    <input type="tel" class="col-sm-10 form-multi-control form-inputs float-right lecture-num" placeholder="Lecturer NIDN Number" name="stf_nidn" id="stf_nidn">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_education" class="control-label text-white">Education</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control form-inputs" placeholder="Ex: Harvard University 2012-2016" name="stf_education" id="stf_education"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_experience" class="control-label text-white">Experiences</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control form-inputs" placeholder="Ex: 1 Year Lecturer in Harvard" name="stf_experience" id="stf_experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_address" class="control-label text-white">Address</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Silicon Valley Street No 76th" id="stf_address" name="stf_address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_province" class="control-label text-white">Province</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Brooklyn" id="stf_province" name="stf_province">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_city" class="control-label text-white">City</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: New York City" id="stf_city" name="stf_city">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_birthplace" class="control-label text-white">Birthplace</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Huston" id="stf_birthplace" name="stf_birthplace">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_birthdate" class="control-label text-white">Birthdate</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control form-inputs" placeholder="Birthdate" id="stf_birthdate" name="stf_birthdate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_gender" class="control-label text-white">Gender</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="stf_gender" id="stf_gender">
                                        <option value="Laki-laki">Men</option>
                                        <option value="Perempuan">Woman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_religion" class="control-label text-white">Religion</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="stf_religion" id="stf_religion">
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_email" class="control-label text-white">Email Address</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control form-inputs" placeholder="Ex: john@gmail.com" id="stf_email" name="stf_email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_contact" class="control-label text-white">Contact</label>
                                <div class="col-sm-12">
                                    <input type="tel" class="form-control form-inputs" placeholder="Ex: +628902192xxxx" id="stf_contact" name="stf_contact">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_state" class="control-label text-white">Country of Origin</label>
                                <div class="col-sm-12">
                                    <input type="tel" class="form-control form-inputs" placeholder="Ex: Indonesia" id="stf_state" name="stf_state">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_status" class="control-label text-white">Staff Status</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="stf_status" id="stf_status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('Staff.index') }}" class="btn btn-white" role="button">Cancel</a>
                            <button type="submit" class="btn btn-success float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('Scripts') }}/Staff.js"></script>
@endpush