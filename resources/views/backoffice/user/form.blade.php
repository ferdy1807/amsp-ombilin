@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User
        </h1>
    </section>
    <!-- Small boxes (Stat box) -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-info">
                        @if($user == null || empty($user))
                            {!! Form::open(['route' => 'backoffice.user.save','files' => true]) !!}
                        @else
                            {!! Form::model($user, ['route' => ['backoffice.user.save', $user->id], 'files' => true]) !!}
                        @endif
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            @include('backoffice._partials.notifications')
                            <div class="form-group">
                                <label class="required">
                                    NIP
                                </label>
                                {!! Form::text('nip', isset($user->nip) ? $user->nip : old('nip') ?: null, ['class' => 'form-control','placeholder'=>'NIP']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Nama
                                </label>
                                {!! Form::text('name', isset($user->name) ? $user->name : old('name') ?: null, ['class' => 'form-control','placeholder'=>'Nama']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Level
                                </label>
                                {!! Form::select('level', [
                                        \App\Models\User::USER => 'User',
                                        \App\Models\User::ADMIN => 'Admin',
                                        \App\Models\User::SUPERADMIN => 'Super Admin',
                                    ], isset($user->level) ? $user->level : old('level') ?: null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Tanggal Lahir
                                </label>
                                {!! Form::text('date_of_birth', isset($user->date_of_birth) ? $user->date_of_birth : old('date_of_birth') ?: null, ['class' => 'form-control datepicker','placeholder'=>'Tanggal Lahir']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Jabatan
                                </label>
                                {!! Form::select('position_id', $positions, isset($user->position_id) ? $user->position_id : old('position_id') ?: null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Grade
                                </label>
                                {!! Form::select('grade_id', $grades, isset($user->grade_id) ? $user->grade_id : old('grade_id') ?: null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Bagian
                                </label>
                                {!! Form::select('unit_id', $units, isset($user->unit_id) ? $user->unit_id : old('unit_id') ?: null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label class="required">
                                    Email
                                </label>
                                {!! Form::email('email', isset($user->email) ? $user->email : old('email') ?: null, ['class' => 'form-control','placeholder'=>'Email']) !!}
                            </div>
                            <div class="form-group">
                                @if($user == null || empty($user))
                                <label class="required">
                                @else
                                <label>
                                @endif
                                    Password
                                </label>
                                {!! Form::password('password', ['class' => 'form-control','placeholder' => 'Password']) !!}
                                    @if(!empty($user))
                                        * Kosongkan jika kamu tidak mau mengubah Password
                                    @endif
                            </div>
                            <div class="form-group">
                                @if($user == null || empty($user))
                                <label class="required">
                                    Image
                                </label>
                                @else
                                <label>
                                    Image
                                </label>
                                <br>
                                    @if (!empty($user->image))
                                    <img accept="image/*" src="{{ $user->image_file }}" style="height:100px;width:100px;"/>
                                    @endif
                                @endif
                                {!! Form::file('image', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                                * Kosongkan jika kamu tidak mau mengubah gambar
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
        $(".timepicker").timepicker({use24hours: true, showInputs: false});});
    $('.datepicker').datepicker({format: 'yyyy-mm-dd'});
    $(".js-select2").select2({
        language: '{{ app()->getLocale() }}'
    });
</script>
@stop
