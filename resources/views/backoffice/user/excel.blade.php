<!DOCTYPE html>
<html>
    <head>
        <title>
        </title>
    </head>
    <body>
        <table>
            <caption>
                Data Pegawai
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
                        Tanggal Lahir
                    </th>
                    <th>
                        Posisi
                    </th>
                    <th>
                        Grade
                    </th>
                    <th>
                        Bagian
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Tanggal Di Buat
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$user->nip}}
                    </td>
                    <td>
                        {{$user->date_of_birth}}
                    </td>
                    <td>
                        {{$user->position}}
                    </td>
                    <td>
                        {{$user->grade}}
                    </td>
                    <td>
                        {{$user->unit}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        {{$user->created_at}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>