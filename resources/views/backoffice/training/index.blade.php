@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Diklat
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <form action="" method="get">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            {!! Form::text('search_date_training',Input::get('search_date_training') , ['class' => 'form-control demo searchdate', 'data-date-format' => 'yyyy-mm-dd','placeholder'=> 'Cari Tanggal Mulai Diklat', 'data-tanggal' => Input::get('searchdate')?: '']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            {!! Form::text('search_end_date_training',Input::get('search_date_training') , ['class' => 'form-control demo searchdate', 'data-date-format' => 'yyyy-mm-dd','placeholder'=> 'Cari Tanggal Selesai Diklat', 'data-tanggal' => Input::get('searchdate')?: '']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            {!! Form::text('search_created_at',Input::get('search_created_at') , ['class' => 'form-control demo searchdate', 'data-date-format' => 'yyyy-mm-dd','placeholder'=> 'Cari Tanggal Pembuatan Data', 'data-tanggal' => Input::get('searchdate')?: '']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-inline">
                                        <button class="btn btn-default btn-block" type="submit">
                                            <span class="fa fa-search">
                                            </span>
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if (\Auth::user()->level != \App\Models\User::USER)
                            <a href="{{ route('backoffice.training.export', Input::all()) }}">
                                <div class="col-sm-6 form-inline">
                                    <button class="btn btn-success btn-block" type="submit">
                                        <span class="fa fa-upload">
                                        </span>
                                        Export To Excel
                                    </button>
                                </div>
                            </a>
                            @endif
                        </div><br>
                        <h3 class="box-title">
                            <b>Pilih Filter :</b>
                            <form action="" method="get">
                                <button type="submit" name="primary" name="primary" class="btn btn-sm btn-rounded btn-primary">
                                    Mengikuti
                                </button>
                                <button type="submit" name="danger" name="danger" class="btn btn-sm btn-rounded btn-danger">
                                    Tidak Mengikuti
                                </button>
                                <a href="{{ url('/admin-backoffice/trainings') }}">
                                    <div class="btn btn-sm btn-rounded btn-default">Tampilkan Semua</div>
                                </a>
                            </form>
                        </h3><br><br>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered display" id="myTable" cellspacing="0" width="100%">
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
                                    <th>
                                        Mengikuti Diklat
                                    </th>
                                    @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                                    <th>
                                        <div class="form-group">
                                            <a href="{{route('backoffice.training.form')}}">
                                                <button class="btn btn-primary">
                                                    <span class="fa fa-plus">
                                                    </span>
                                                    Tambah Diklat
                                                </button>
                                            </a>
                                        </div>
                                    </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($trainings as $key => $training)
                                <tr class="item{{$training->id}}">
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
                                    <td>                                        
                                            @php
                                                if (isset($training->follow)) {
                                                    if ($training->follow == '1') {
                                            @endphp             
                                                <button class="btn btn-primary" type="button">Mengikuti</button>
                                            @php
                                                    } else {
                                            @endphp             
                                                <button class="btn btn-danger" type="button">Tidak Mengikuti</button>
                                            @php
                                                    }
                                                }
                                            @endphp 
                                    </td>
                                    @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                                    <td>
                                        <a href="{{route('backoffice.training.form',$training->id)}}">
                                            <button class="btn btn-warning" type="button">
                                                <span class="fa fa-edit">
                                                </span>
                                                Edit
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-delete" type="button" value="{{$training->id}}">
                                            <span class="fa fa-trash">
                                            </span>
                                            Delete
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" style="text-align: center;">
                                        <h2>
                                            <span class="fa fa-search">
                                            </span>
                                            Empty
                                        </h2>
                                    </td>
                                </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop

@section('js')
<script>
    $(document).on('click', '.btn-delete', function(id) {
    var id =  $(this).val();
    swal({
      title: "Anda Yakin?",
      text: "Data Akan Dihapus!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya, Hapus Data!",
      closeOnConfirm: false
    },
    function(isConfirm){
     console.log(id);
     if(isConfirm){
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'delete',
        url: '{{route('backoffice.training.delete')}}'+'/' +id,
        success: function(data){
          $('.item' + data.id).remove();
          swal("Diklat Berhasil Terhapus");
        }
      })  
    }
  });  

  });
</script>
@stop
