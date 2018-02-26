@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
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
                                            {!! Form::text('search_created_at',Input::get('search_created_at') , ['class' => 'form-control demo searchdate', 'data-date-format' => 'yyyy-mm-dd','placeholder'=> 'Cari Berdasarkan Tanggal Pembuatan', 'data-tanggal' => Input::get('searchdate')?: '']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-inline">
                                        <button class="btn btn-default btn-block" type="submit">
                                            <span class="fa fa-search">
                                            </span>
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{ route('backoffice.user.export',Input::all()) }}">
                                <div class="col-sm-4 form-inline">
                                    <button class="btn btn-success btn-block" type="submit">
                                        <span class="fa fa-upload">
                                        </span>
                                        Export To Excel
                                    </button>
                                </div>
                            </a>
                        </div>
                        <h3 class="box-title">
                        </h3>
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
                                        Nama
                                    </th>
                                    <th>
                                        Jabatan
                                    </th>
                                    <th>
                                        Bagian
                                    </th>
                                    <th>
                                        Tanggal Dibuat
                                    </th>                                    
                                    <th>
                                    @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                                        <div class="form-group">
                                            <a href="{{route('backoffice.user.form')}}">
                                                <button class="btn btn-primary">
                                                    <span class="fa fa-plus">
                                                    </span>
                                                    Tambah User
                                                </button>
                                            </a>
                                        </div>                                    
                                    @else
                                        Aksi
                                    @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $key => $user)
                                <tr class="item{{$user->id}}">
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$user->nip}}
                                    </td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{ isset($user->position->name) ? $user->position->name : "-"}}
                                    </td>
                                    <td>
                                        {{ isset($user->unit) ? $user->unit->name : "-" }}
                                    </td>
                                    <td>
                                        <?php echo date("d M Y", strtotime($user->created_at)); ?>
                                    </td>
                                    @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                                    <td>
                                        <a href="{{route('backoffice.user.form',$user->id)}}">
                                            <button class="btn btn-warning" type="button">
                                                <span class="fa fa-edit">
                                                </span>
                                                Edit
                                            </button>
                                        </a>
                                        <a href="{{route('backoffice.user.detail',$user->id)}}">
                                            <button class="btn btn-info" type="button">
                                                <span class="fa fa-eye">
                                                </span>
                                                Detail
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-delete" type="button" value="{{$user->id}}">
                                            <span class="fa fa-trash">
                                            </span>
                                            Delete
                                        </button>
                                    </td>                                    
                                    @elseif (Auth::user()->level == \App\Models\User::ADMIN)
                                    <td>
                                        <a href="{{route('backoffice.user.detail',$user->id)}}">
                                            <button class="btn btn-info" type="button">
                                                <span class="fa fa-eye">
                                                </span>
                                                Detail
                                            </button>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center;">
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
        url: '{{route('backoffice.user.delete')}}'+'/' +id,
        success: function(data){
          $('.item' + data.id).remove();
          swal("User Berhasil Terhapus");
        }
      })  
    }
  });  

  });
</script>
@stop
