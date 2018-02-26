<!DOCTYPE html>
<html>
    <head>
        <title>
        </title>
    </head>
    <body>
        <table>
            <caption>
                Data Sertifikat
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
                        Nama Sertifikat
                    </th>
                    <th>
                        Kode Sertifikat
                    </th>
                    <th>
                        Nilai
                    </th>
                    <th>
                        Tanggal Kadaluarsa
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
                @foreach ($certificates as $key => $certificate)
                <tr>
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
                        {{$certificate->date_expired}}
                    </td>
                    <td>
                        {{$certificate->user->name}}
                    </td>
                    <td>
                        {{$certificate->created_at}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>