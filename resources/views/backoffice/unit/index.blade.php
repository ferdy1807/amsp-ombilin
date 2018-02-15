@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bagian
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered display" id="myTable" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Nama Bagian
                                    </th>
                                    <th>
                                        Tanggal Dibuat
                                    </th>
                                    @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                                    <th>
                                        <div class="form-group">
                                            <a href="{{route('backoffice.unit.form')}}">
                                                <button class="btn btn-primary">
                                                    <span class="fa fa-plus">
                                                    </span>
                                                    Tambah Bagian
                                                </button>
                                            </a>
                                        </div>
                                    </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($units as $key => $unit)
                                <tr class="item{{$unit->id}}">
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$unit->name}}
                                    </td>
                                    <td>
                                        <?php echo date("d M Y", strtotime($unit->created_at)); ?>
                                    </td>
                                    @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                                    <td>
                                        <a href="{{route('backoffice.unit.form',$unit->id)}}">
                                            <button class="btn btn-warning" type="button">
                                                <span class="fa fa-edit">
                                                </span>
                                                Edit
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-delete" type="button" value="{{$unit->id}}">
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
        url: '{{route('backoffice.unit.delete')}}'+'/' +id,
        success: function(data){
          $('.item' + data.id).remove();
          swal("Bagian Berhasil Terhapus");
        }
      })  
    }
  });  

  });
</script>
@stop
