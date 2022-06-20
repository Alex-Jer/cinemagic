<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            background-color: #ddd;
        }

        td {
            padding: 8px;
        }

        td:first-child {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h2>
        CineMagic - Bilhete #{{ $ticket->id }}
    </h2>

    <div>

        <div>
            <h4>
                <p>
                    <b>Data:</b> {{ $ticket->receipt->data->translatedFormat('j \d\e F \d\e Y') }}
                </p>
            </h4>
            <br />
            <table>
                <tbody>
                    <tr>
                        <td>Referência</td>
                        <td>{{ $ticket->id }}</td>
                    </tr>
                    <tr>
                        <td>Filme</td>
                        <td>{{ $ticket->screening->film->titulo }}</td>
                    </tr>
                    <tr>
                        <td>Data da sessão</td>
                        <td>{{ $ticket->screening->data->translatedFormat('j \d\e F \d\e Y') }}</td>
                    </tr>
                    <tr>
                        <td>Hora da sessão</td>
                        <td>{{ $ticket->screening->horario_inicio->format('G:i') }}</td>
                    </tr>
                    <tr>
                        <td>Sala</td>
                        <td>{{ $ticket->screening->screen->nome }}</td>
                    </tr>
                    <tr>
                        <td>Lugar</td>
                        <td>{{ $ticket->seat->fila . $ticket->seat->posicao }}</td>
                    </tr>
                </tbody>
            </table>
            <br /><br />
            <h3>Os seus detalhes</h3>
            <table>
                <tbody>
                    <tr>
                        <td>Nome do cliente</td>
                        <td>{{ $ticket->customer->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>
                            @if ($ticket->customer->user->foto_url)
                                <img src="{{ asset('storage/fotos/' . $ticket->customer->user->foto_url) }}">
                            @else
                                <img src="{{ asset('storage/fotos/default.png') }}">
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>{{ $ticket->customer->user->email }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>
