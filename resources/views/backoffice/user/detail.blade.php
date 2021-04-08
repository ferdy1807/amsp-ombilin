@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail User
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        @include('backoffice._partials.notifications')
                        <div class="form-group">
                            <label>
                                NIP
                            </label>
                            <br>
                            {{ isset($user->nip) ? $user->nip : "-" }}
                        </div>
                        <div class="form-group">
                            <label>
                                Nama
                            </label><br>
                            {{ isset($user->name) ? $user->name : "-" }}
                        </div>
                        <div class="form-group">
                            <label>
                                Level
                            </label>
                            <br>
                            @if ($user->level == 1)
                                ADMIN
                            @else
                                USER
                            @endif
                        </div>
                        <div class="form-group">
                            <label>
                                Tanggal Lahir
                            </label><br>
                            {{ isset($user->date_of_birth) ? $user->date_of_birth : "-" }}
                        </div>
                        <div class="form-group">
                            <label>
                                Jabatan
                            </label><br>
                            {{ isset($user->position) ? $user->position->name : "-" }}
                        </div>
                        <div class="form-group">
                            <label>
                                Grade
                            </label><br>
                            {{ isset($user->grade) ? $user->grade->name : "-" }}
                        </div>
                        <div class="form-group">
                            <label>
                                Bagian
                            </label><br>
                            {{ isset($user->unit) ? $user->unit->name : "-" }}
                        </div>
                        <div class="form-group">
                            <label>
                                Email
                            </label><br>
                            {{ isset($user->email) ? $user->email : "-" }}
                        </div>
                        <div class="form-group">
                            <label>
                                Image
                            </label><br>
                                <img accept="image/*" src="{{ url('public/medias/users/'.$user->image) }}" style="height:100px;width:100px;"/>
                            </br>
                        </div>
                        <div class="form-group">
                            Status Diklat : 
                            @if (count($user->training) > 0)
                                <div class="btn btn-sm btn-rounded btn-primary">
                                    Telah Mengikuti Diklat
                                </div>
                            @else
                                <div class="btn btn-sm btn-rounded btn-danger">
                                    Belum Mengikuti Diklat
                                </div>
                            @endif
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (count($user->training) > 0)
    <section class="content-header">
        <h1>
            Training
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-hover table-bordered display" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        NIP
                                    </th>
                                    <th>
                                        Judul Diklat
                                    </th>
                                    <th>
                                        Tanggal Diklat Mulai
                                    </th>
                                    <th>
                                        Tanggal Diklat Selesai
                                    </th>
                                    <th>
                                        Tempat Diklat
                                    </th>
                                    <th>
                                        Nama User
                                    </th>
                                    <th>
                                        Tanggal Data Di Buat
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($user->training as $key => $training)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$training->user->nip}}
                                    </td>
                                    <td>
                                        {{$training->title_learning}}
                                    </td>
                                    <td>
                                        <?php echo date("d M Y", strtotime($training->date_training)); ?>
                                    </td>
                                    <td>
                                        @isset ($training->end_date_training)
                                            <?php echo date("d M Y", strtotime($training->end_date_training)); ?>
                                        @endisset
                                    </td>
                                    <td>
                                        {{$training->place_training}}
                                    </td>
                                    <td>
                                        {{$training->user->name}}
                                    </td>
                                    <td>
                                        <?php echo date("d M Y", strtotime($training->created_at)); ?>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (count($user->certificate) > 0)
    <section class="content-header">
        <h1>
            Sertifikat
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-hover table-bordered display" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        NIP
                                    </th>
                                    <th>
                                        Nama Sertifikat
                                    </th>
                                    <th>
                                        Kode Sertifikat
                                    </th>
                                    <th>
                                        Nilai
                                    </th>
                                    <th>
                                        Nama User
                                    </th>
                                    <th>
                                        Tanggal Dibuat
                                    </th>
                                    <th>
                                        Download
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($user->certificate as $key => $certificate)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$certificate->user->nip}}
                                    </td>
                                    <td>
                                        {{$certificate->name}}
                                    </td>
                                    <td>
                                        {{$certificate->certificate_code}}
                                    </td>
                                    <td>
                                        {{$certificate->value}}
                                    </td>
                                    <td>
                                        {{$certificate->user->name}}
                                    </td>
                                    <td>
                                        <?php echo date("d M Y", strtotime($certificate->created_at)); ?>
                                    </td>
                                    <td>
                                        <a href="{{ $certificate->file_url }}" target="_blank">
                                            Download Data
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-rounded btn-{{$certificate->status}}">
                                            @php
                                                if (isset($certificate->status)) {
                                                    if ($certificate->status == 'danger') {
                                                        echo "Sudah Expired";
                                                    } elseif ($certificate->status == 'warning') {
                                                        echo "0 - 1 Bulan Lagi";
                                                    } elseif ($certificate->status == 'success') {
                                                        echo "2 - 6 Bulan Lagi";
                                                    } else {
                                                        echo "Diatas 6 Bulan";
                                                    }
                                                }
                                            @endphp 
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
@stop
