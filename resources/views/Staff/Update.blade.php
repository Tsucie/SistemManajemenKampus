@extends('layouts.app')

@section('content')
<div class="header bg-gradient-red pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Edit Staff</h3>
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

                    <form class="form-horizontal" action="{{ route('Staff.update', $data[0]->stf_u_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    @if ($data[0]->up_photo)
                                        <img id="profile-img" src="data:image/{{ pathinfo($data[0]->up_filename, PATHINFO_EXTENSION) }};base64,{{ $data[0]->up_photo }}" width="100" height="100" alt="img">
                                    @else
                                        <img id="profile-img" src="{{ asset('ProfileImg') }}/DefaultPPimg.jpg" width="100" height="100">
                                    @endif
                                    <div>
                                        <label for="image" class="control-label text-white">Photo Profile</label>
                                        <input type="text" hidden value="{{ $data[0]->up_id }}" name="up_id" id="up_id">
                                        <input type="file" class="form-control-file text-white" id="image" name="image" placeholder="image" value="{{ $data[0]->up_filename }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="u_username" class="control-label text-white">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: John_123" id="u_username" name="u_username" value="{{ $data[0]->u_username }}">
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
                                    <select class="form-control form-inputs" name="stf_sc_id" id="stf_sc_id" data_id="{{ $data[0]->stf_sc_id }}"></select>
                                </div>
                            </div>
                            <div class="form-group" id="select-fks">
                                <label for="stf_fks_id" class="control-label text-white">Faculty</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-inputs" name="stf_fks_id" id="stf_fks_id" data_id="{{ isset($data[0]->stf_fks_id) ? $data[0]->stf_fks_id : 0 }}"></select>
                                </div>
                            </div>
                            <div class="form-group" id="select-ps">
                                <label for="stf_ps_id" class="control-label text-white">Research</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-inputs" name="stf_ps_id" id="stf_ps_id" data_id="{{ isset($data[0]->stf_ps_id) ? $data[0]->stf_ps_id : 0 }}">
                                        <option selected value="null">Please Select Faculty</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="select-mk">
                                <label for="stf_mk_id" class="control-label text-white">Course</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-inputs" name="stf_mk_id" id="stf_mk_id" data_id="{{ isset($data[0]->stf_mk_id) ? $data[0]->stf_mk_id : 0 }}">
                                        <option selected value="null">Please Select Faculty & Research</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_fullname" class="control-label text-white">Fullname</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: John Doe" id="stf_fullname" name="stf_fullname" value="{{ $data[0]->stf_fullname }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_num_stat" class="control-label text-white">Registered Number</label>
                                <div class="col-sm-12">
                                    <select class="col-sm-2 form-multi-control form-inputs" name="stf_num_stat" id="stf_num_stat" onchange="setNumberType(this)">
                                        <option value="stf_nidn" @if ($data[0]->stf_num_stat == "stf_nidn") {{ 'selected' }} @endif>NIDN</option>
                                        <option value="stf_nidk" @if ($data[0]->stf_num_stat == "stf_nidk") {{ 'selected' }} @endif>NIDK</option>
                                        <option value="stf_nip" @if ($data[0]->stf_num_stat == "stf_nip") {{ 'selected' }} @endif>NIP</option>
                                        <option value="stf_nik" @if ($data[0]->stf_num_stat == "stf_nik") {{ 'selected' }} @endif>NIK</option>
                                    </select>
                                    <input type="tel" class="col-sm-10 form-multi-control form-inputs float-right lecture-num" placeholder="{{ $data[0]->sc_name.' '.str_replace('stf_', '', $data[0]->stf_num_stat) }} number" name="{{ $data[0]->stf_num_stat }}" id="{{ $data[0]->stf_num_stat }}"
                                    @switch($data[0]->stf_num_stat)
                                        @case("stf_nidn")
                                            value="{{ $data[0]->stf_nidn }}"
                                            @break
                                        @case("stf_nidk")
                                            value="{{ $data[0]->stf_nidk }}"
                                            @break
                                        @case("stf_nip")
                                            value="{{ $data[0]->stf_nip }}"
                                            @break
                                        @case("stf_nik")
                                            value="{{ $data[0]->stf_nik }}"
                                            @break
                                        @default
                                            value="No Data"
                                    @endswitch>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_education" class="control-label text-white">Education</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control form-inputs" placeholder="Ex: Harvard University 2012-2016" name="stf_education" id="stf_education">{{ $data[0]->stf_education }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_experience" class="control-label text-white">Experiences</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control form-inputs" placeholder="Ex: 1 Year Lecturer in Harvard" name="stf_experience" id="stf_experience">{{ $data[0]->stf_experience }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_address" class="control-label text-white">Address</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Silicon Valley Street No 76th" id="stf_address" name="stf_address" value="{{ $data[0]->stf_address }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_province" class="control-label text-white">Province</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Brooklyn" id="stf_province" name="stf_province" value="{{ $data[0]->stf_province }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_city" class="control-label text-white">City</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: New York City" id="stf_city" name="stf_city" value="{{ $data[0]->stf_city }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_birthplace" class="control-label text-white">Birthplace</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Huston" id="stf_birthplace" name="stf_birthplace" value="{{ $data[0]->stf_birthplace }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_birthdate" class="control-label text-white">Birthdate</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control form-inputs" placeholder="Birthdate" id="stf_birthdate" name="stf_birthdate" value="{{ $data[0]->stf_birthdate }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_gender" class="control-label text-white">Gender</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="stf_gender" id="stf_gender">
                                        <option value="Laki-laki" @if ($data[0]->stf_gender == "Laki-laki") {{ 'selected' }} @endif>Men</option>
                                        <option value="Perempuan" @if ($data[0]->stf_gender == "Perempuan") {{ 'selected' }} @endif>Woman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_religion" class="control-label text-white">Religion</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="stf_religion" id="stf_religion">
                                        <option value="Islam" @if ($data[0]->stf_religion == "Islam") {{ 'selected' }} @endif>Islam</option>
                                        <option value="Kristen" @if ($data[0]->stf_religion == "Kristen") {{ 'selected' }} @endif>Kristen</option>
                                        <option value="Hindu" @if ($data[0]->stf_religion == "Hindu") {{ 'selected' }} @endif>Hindu</option>
                                        <option value="Buddha" @if ($data[0]->stf_religion == "Buddha") {{ 'selected' }} @endif>Buddha</option>
                                        <option value="Konghucu" @if ($data[0]->stf_religion == "Konghucu") {{ 'selected' }} @endif>Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_email" class="control-label text-white">Email Address</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control form-inputs" placeholder="Ex: john@gmail.com" id="stf_email" name="stf_email" value="{{ $data[0]->stf_email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_contact" class="control-label text-white">Contact</label>
                                <div class="col-sm-12">
                                    <input type="tel" class="form-control form-inputs" placeholder="Ex: +628902192xxxx" id="stf_contact" name="stf_contact" value="{{ $data[0]->stf_contact }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_state" class="control-label text-white">Country of Origin</label>
                                <div class="col-sm-12">
                                    <input type="tel" class="form-control form-inputs" placeholder="Ex: Indonesia" id="stf_state" name="stf_state" value="{{ $data[0]->stf_state }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stf_status" class="control-label text-white">Staff Status</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="stf_status" id="stf_status">
                                        <option value="1" @if ($data[0]->stf_status == 1) {{ 'selected' }} @endif>Active</option>
                                        <option value="0" @if ($data[0]->stf_status == 0) {{ 'selected' }} @endif>Inactive</option>
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