<!DOCTYPE html>
<html>
    <head>
        <title>
        </title>
    </head>
    <body>
        <table>
            <caption>
                Data Diklat
            </caption>
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
                        Nomor Surat Panggilan
                    </th>
                    <th>
                        Judul Diklat
                    </th>
                    <th>
                        Tanggal Diklat
                    </th>
                    <th>
                        Tempat Diklat
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
                @foreach ($trainings as $key => $training)
                <tr>
                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$training->nip}}
                    </td>
                    <td>
                        {{$training->name}}
                    </td>
                    <td>
                        {{$training->no_mail_call}}
                    </td>
                    <td>
                        {{$training->title_learning}}
                    </td>
                    <td>
                        {{$training->date_training}}
                    </td>
                    <td>
                        {{$training->place_training}}
                    </td>
                    <td>
                        {{$training->user->name}}
                    </td>
                    <td>
                        {{$training->created_at}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>