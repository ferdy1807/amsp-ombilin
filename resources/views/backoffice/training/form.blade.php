@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Diklat
        </h1>
    </section>
    <!-- Small boxes (Stat box) -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-info">
                        @if($training == null || empty($training))
                            {!! Form::open(['route' => 'backoffice.training.save','files' => true]) !!}
                        @else
                            {!! Form::model($training, ['route' => ['backoffice.training.save', $training->id], 'files' => true]) !!}
                        @endif
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            @include('backoffice._partials.notifications')
                            <div class="form-group">
                                <label class="required">
                                    Nama Diklat
                                </label>
                                {!! Form::text('name', isset($training->name) ? $training->name : old('name') ?: null, ['class' => 'form-control','placeholder'=>'Nama']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    User
                                </label>
                                {!! Form::select('user_id', $users, isset($training->user_id) ? $training->user_id : old('user_id') ?: null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Nomor Surat Panggilan
                                </label>
                                {!! Form::text('no_mail_call', isset($training->no_mail_call) ? $training->no_mail_call : old('no_mail_call') ?: null, ['class' => 'form-control','placeholder'=>'Nomor Surat Panggilan']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Judul Diklat
                                </label>
                                {!! Form::text('title_learning', isset($training->title_learning) ? $training->title_learning : old('title_learning') ?: null, ['class' => 'form-control','placeholder'=>'Judul Diklat']) !!}
                            </div>
                            <div class="form-group">
                                    Tanggal Diklat Mulai
                                </label>
                                {!! Form::text('date_training', isset($training->date_training) ? $training->date_training : old('date_training') ?: null, ['class' => 'form-control datepicker','placeholder'=>'Tanggal Diklat Mulai']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Tanggal Diklat Selesai
                                </label>
                                {!! Form::text('end_date_training', isset($training->end_date_training) ? $training->end_date_training : old('end_date_training') ?: null, ['class' => 'form-control datepicker','placeholder'=>'Tanggal Diklat Selesai']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Tempat Diklat
                                </label>
                                {!! Form::text('place_training', isset($training->place_training) ? $training->place_training : old('place_training') ?: null, ['class' => 'form-control','placeholder'=>'Tempat Diklat']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Jenis
                                </label>
                                {!! Form::select('type', [
                                        \App\Models\Training::PLN => 'PLN',
                                        \App\Models\Training::NONPLN => 'NON PLN',
                                    ], isset($user->type) ? $user->type : old('type') ?: null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Mengikuti
                                </label>
                                {!! Form::select('follow', [
                                        \App\Models\Training::FOLLOW => 'Iya',
                                        \App\Models\Training::UNFOLLOW => 'Tidak',
                                    ], isset($training->follow) ? $training->follow : old('follow') ?: null, ['class' => 'form-control', 'id' => 'follow', 'onchange' => 'check();']) !!}
                            </div>
                            <div 
                                class="form-group" 
                                id="follow_reason"
                                @if (empty($training) || $training == null)
                                    style="display:none;"
                                @else
                                     @if ($training->follow == \App\Models\Training::FOLLOW)
                                        style="display:none;"
                                     @endif
                                @endif>
                                <label class="required">
                                    Alasan Tidak Mengikuti
                                </label>
                                {!! Form::select('follow_reason', [
                                        \App\Models\Training::SICK => 'Sakit',
                                        \App\Models\Training::OFFDAY => 'Cuti',
                                        \App\Models\Training::BUSINESSTRIP => 'Dinas',
                                    ], isset($training->follow_reason) ? $training->follow_reason : old('follow_reason') ?: null, ['placeholder' => 'Alasan Tidak Mengikuti', 'class' => 'form-control']) !!}
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
    $('.datepicker').datepicker({format: 'yyyy-mm-dd'});
    $(".js-select2").select2({
        language: '{{ app()->getLocale() }}'
    });
    function check() {
        var follow = document.getElementById("follow");
        var current_value = follow.options[follow.selectedIndex].value;

        if (current_value == 2) {
            document.getElementById("follow_reason").style.display = "block";
        }else {
            document.getElementById("follow_reason").style.display = "none";
        }
    }

</script>
@stop
