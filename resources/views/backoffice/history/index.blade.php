@extends('backoffice.layouts.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            History
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
                        </div>
                        <h3 class="box-title"></h3>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered display" id="myTable" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Menu
                                    </th>
                                    <th>
                                        Function
                                    </th>
                                    <th>
                                        Nama User
                                    </th>
                                    <th>
                                        Tanggal Di Buat
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($histories as $key => $history)
                                <tr class="item{{$history->id}}">
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        @if ($history->object_id == \App\Models\History::CERTIFICATE)
                                            Sertifikat
                                        @elseif($history->object_id == \App\Models\History::HISTORY)
                                            History
                                        @elseif($history->object_id == \App\Models\History::TRAINING)
                                            Diklat
                                        @elseif($history->object_id == \App\Models\History::USER)
                                            User
                                        @elseif($history->object_id == \App\Models\History::GRADE)
                                            Grade
                                        @elseif($history->object_id == \App\Models\History::POSITION)
                                            Jabatan
                                        @elseif($history->object_id == \App\Models\History::UNIT)
                                            Bagian
                                        @endif
                                    </td>
                                    <td>
                                        @if ($history->function == \App\Models\History::INDEX)
                                            Index
                                        @elseif($history->function == \App\Models\History::CREATE)
                                            Tambah
                                        @elseif($history->function == \App\Models\History::EDIT)
                                            Edit
                                        @elseif($history->function == \App\Models\History::DELETE)
                                            Hapus
                                        @elseif($history->function == \App\Models\History::EXPORT)
                                            Export
                                        @endif
                                    </td>
                                    <td>
                                        {{$history->user->name}}
                                    </td>
                                    <td>
                                        {{$history->created_at}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align: center;">
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
