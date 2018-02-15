@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail User
        </h1>
    </section>
    <!-- Small boxes (Stat box) -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-info">
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            @include('backoffice._partials.notifications')
                            <div class="form-group">
                                <label>
                                    NIP
                                </label>
                                {!! Form::text('nip', isset($user->nip) ? $user->nip : old('nip') ?: null, ['class' => 'form-control', 'readonly','placeholder'=>'NIP']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Nama
                                </label>
                                {!! Form::text('name', isset($user->name) ? $user->name : old('name') ?: null, ['class' => 'form-control', 'readonly','placeholder'=>'Nama']) !!}
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
                                </label>
                                {!! Form::text('date_of_birth', isset($user->date_of_birth) ? $user->date_of_birth : old('date_of_birth') ?: null, ['class' => 'form-control datepicker','placeholder'=>'Tanggal Lahir', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Jabatan
                                </label>
                                {!! Form::text('position', isset($user->position) ? $user->position : old('position') ?: null, ['class' => 'form-control', 'readonly','placeholder'=>'Jabatan']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Grade
                                </label>
                                {!! Form::text('grade', isset($user->grade) ? $user->grade : old('grade') ?: null, ['class' => 'form-control', 'readonly','placeholder'=>'Grade']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Bagian
                                </label>
                                {!! Form::text('unit', isset($user->unit) ? $user->unit : old('unit') ?: null, ['class' => 'form-control', 'readonly','placeholder'=>'Bagian']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Email
                                </label>
                                {!! Form::email('email', isset($user->email) ? $user->email : old('email') ?: null, ['class' => 'form-control', 'readonly','placeholder'=>'Email']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Password
                                </label>
                                {!! Form::password('password', ['class' => 'form-control', 'readonly','placeholder' => 'Password']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Image
                                </label><br>
                                    <img accept="image/*" src="{{ $user->image_file }}" style="height:100px;width:100px;"/>
                                </br>
                            </div>
                        </div>
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
