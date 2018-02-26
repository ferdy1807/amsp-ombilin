@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sertifikat
        </h1>
    </section>
    <!-- Small boxes (Stat box) -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-info">
                        @if($certificate == null || empty($certificate))
                            {!! Form::open(['route' => 'backoffice.certificate.save','files' => true]) !!}
                        @else
                            {!! Form::model($certificate, ['route' => ['backoffice.certificate.save', $certificate->id], 'files' => true]) !!}
                        @endif
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            @include('backoffice._partials.notifications')
                            <div class="form-group">
                                <label class="required">
                                    Nama Sertifikat
                                </label>
                                {!! Form::text('name', isset($certificate->name) ? $certificate->name : old('name') ?: null, ['class' => 'form-control','placeholder'=>'Nama']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    User
                                </label>
                                {!! Form::select('user_id', $users, isset($certificate->user_id) ? $certificate->user_id : old('user_id') ?: null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Kode Sertifikat
                                </label>
                                {!! Form::text('certificate_code', isset($certificate->certificate_code) ? $certificate->certificate_code : old('certificate_code') ?: null, ['class' => 'form-control','placeholder'=>'Kode Sertifikat']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Nilai
                                </label>
                                {!! Form::text('value', isset($certificate->value) ? $certificate->value : old('value') ?: null, ['class' => 'form-control','placeholder'=>'Nilai']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Tanggal Kadaluarsa
                                </label>
                                {!! Form::text('date_expired', isset($training->date_expired) ? $training->date_expired : old('date_expired') ?: null, ['class' => 'form-control datepicker','placeholder'=>'Tanggal Kadaluarsa']) !!}
                            </div>
                            <div class="form-group">
                                @if($certificate == null || empty($certificate))
                                <label class="required">
                                    Berkas Sertifikat
                                </label>
                                @else
                                <label>
                                    Berkas Sertifikat
                                </label>
                                <br>
                                    * isi data jika ingin merubah
                                    <a href="{{ $certificate->file_url }}" target="_blank">
                                        Link Data
                                    </a>
                                    @endif
                                {!! Form::file('file', ['class' => 'form-control']) !!}
                                </br>
                            </div>
                        </div>
                        <!-- /.box -->
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                <i class="fa fa-send">
                                </i>
                                SAVE
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
@section('script')
<script type="text/javascript">
    $(function() {
        //Timepicker
        $(".timepicker").timepicker({
            use24hours: true,
            showInputs: false
        });
    });
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });    
    $(".js-select2").select2({
        language: '{{ app()->getLocale() }}'
    });
</script>
@stop
