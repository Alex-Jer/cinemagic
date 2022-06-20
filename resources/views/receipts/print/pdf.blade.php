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
        CineMagic - Recibo #{{ $receipt->id }}
    </h2>

    <div>

        <div>
            <h4>
                <p>
                    <b>Data:</b> {{ $receipt->created_at->translatedFormat('l\, j \d\e F \d\e Y \à\s H:i:s') }}
                </p>
            </h4>
            <br />
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Filme</th>
                        <th>Sala</th>
                        <th>Data</th>
                        <th>Início</th>
                        <th>Lugar</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipt->tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->screening->film->titulo }}</td>
                            <td>{{ $ticket->screening->screen->nome }}</td>
                            <td>
                                {{ $ticket->screening->data->translatedFormat('d/m/Y \(l\)') }}</td>
                            <td>
                                {{ $ticket->screening->horario_inicio->translatedFormat('H:i') }}
                            </td>
                            <td>
                                {{ $ticket->seat->fila . $ticket->seat->posicao }}
                            </td>
                            <td>
                                {{ round($ticket->preco_sem_iva + ($ticket->preco_sem_iva * $receipt->iva) / 100, 2) . '€' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
            <table>
                <tbody>
                    <tr>
                        <td>Total sem IVA</td>
                        <td>{{ $receipt->preco_total_sem_iva }}€</td>
                    </tr>
                    <tr>
                        <td>IVA</td>
                        <td>{{ $receipt->iva }}%</td>
                    </tr>
                    <tr>
                        <td>Total com IVA</td>
                        <td>{{ $receipt->preco_total_com_iva }}€</td>
                    </tr>
                </tbody>
            </table>
            <br /><br />
            <h3>Os seus detalhes</h3>
            <table>
                <tbody>
                    <tr>
                        <td>Nome do cliente</td>
                        <td>{{ $receipt->nome_cliente }}</td>
                    </tr>
                    <tr>
                        <td>Tipo de pagamento</td>
                        <td>{{ $receipt->tipo_pagamento }}</td>
                    </tr>
                    <tr>
                        <td>Referência</td>
                        <td>{{ $receipt->ref_pagamento }}</td>
                    </tr>
                    <tr>
                        <td>NIF</td>
                        @if ($receipt->nif_pagamento)
                            <td>{{ $receipt->ref_pagamento }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>
