@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Grade
        </h1>
    </section>
    <!-- Small boxes (Stat box) -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-info">
                        @if($grade == null || empty($grade))
                            {!! Form::open(['route' => 'backoffice.grade.save','files' => true]) !!}
                        @else
                            {!! Form::model($grade, ['route' => ['backoffice.grade.save', $grade->id], 'files' => true]) !!}
                        @endif
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            @include('backoffice._partials.notifications')
                            <div class="form-group">
                                <label class="required">
                                    Nama Grade
                                </label>
                                {!! Form::text('name', isset($grade->name) ? $grade->name : old('name') ?: null, ['class' => 'form-control','placeholder'=>'Nama']) !!}
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
