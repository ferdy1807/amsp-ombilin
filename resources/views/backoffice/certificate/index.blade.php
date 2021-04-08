@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sertifikat
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::text('search_date_expired',Input::get('search_date_expired') , ['class' => 'form-control demo searchdate', 'data-date-format' => 'yyyy-mm-dd','placeholder'=> 'Cari Tanggal Kadaluarsa', 'data-tanggal' => Input::get('search_date_expired')?: '']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::text('search_created_at',Input::get('search_created_at') , ['class' => 'form-control demo searchdate', 'data-date-format' => 'yyyy-mm-dd','placeholder'=> 'Cari Tanggal Pembuatan Data', 'data-tanggal' => Input::get('search_created_at')?: '']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-inline">
                                        <button class="btn btn-default btn-block" type="submit">
                                            <span class="fa fa-search">
                                            </span>
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if (\Auth::user()->level != \App\Models\User::USER)
                            <a href="{{ route('backoffice.certificate.export',Input::all()) }}">
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
                                <button type="submit" name="danger" name="danger" class="btn btn-sm btn-rounded btn-danger">
                                    Sudah Expired
                                </button>
                                <button type="submit" name="warning" name="warning" class="btn btn-sm btn-rounded btn-warning">
                                    0 - 1 Bulan Lagi
                                </button>
                                <button type="submit" name="success" name="success" class="btn btn-sm btn-rounded btn-success">
                                    2 - 6 Bulan Lagi
                                </button>
                                <button type="submit" name="primary" name="primary" class="btn btn-sm btn-rounded btn-primary">
                                    Diatas 6 Bulan
                                </button>
                                <a href="{{ url('/admin-backoffice/certificates') }}">
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
                                        Tanggal Kadaluarsa
                                    </th>
                                    <th>
                                        Download
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                                    <th>
                                        <div class="form-group">
                                            <a href="{{route('backoffice.certificate.form')}}">
                                                <button class="btn btn-primary">
                                                    <span class="fa fa-plus">
                                                    </span>
                                                    Tambah Sertifikat
                                                </button>
                                            </a>
                                        </div>
                                    </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($certificates as $key => $certificate)
                                <tr class="item{{$certificate->id}}">
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
                                        <?php echo date("d M Y", strtotime($certificate->date_expired)); ?>
                                    </td>
                                    <td>
                                        <a href="{{ asset('public/medias/certificate/'.$certificate->file) }}" target="_blank">
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
                                    @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                                    <td>
                                        <a href="{{route('backoffice.certificate.form',$certificate->id)}}">
                                            <button class="btn btn-warning" type="button">
                                                <span class="fa fa-edit">
                                                </span>
                                                Edit
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-delete" type="button" value="{{$certificate->id}}">
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

@section('css')
<style type="text/css">
    .red{
        color: red;
    }
</style>
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
        url: '{{route('backoffice.certificate.delete')}}'+'/' +id,
        success: function(data){
          $('.item' + data.id).remove();
          swal("Sertifikat Berhasil Terhapus");
        }
      })  
    }
  });  

  });
</script>
@stop
