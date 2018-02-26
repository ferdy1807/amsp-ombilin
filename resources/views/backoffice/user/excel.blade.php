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
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->date_of_birth}}
                    </td>
                    <td>
                        {{isset($user->position->name) ? $user->position->name : null}}
                    </td>
                    <td>
                        {{isset($user->grade->name) ? $user->grade->name : null}}
                    </td>
                    <td>
                        {{isset($user->unit->name) ? $user->unit->name : null}}
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