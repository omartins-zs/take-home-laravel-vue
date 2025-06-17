<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .page-break {
            page-break-after: always;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }

        .group-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .obs {
            font-style: italic;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }
    </style>
</head>

<body>

    <h2>Solicitação de Exames</h2>
    <p><strong>Médico:</strong> {{ $doctor['name'] ?? '—' }} | <strong>CRM:</strong> {{ $doctor['crm'] ?? '—' }}</p>
    <p><strong>Paciente:</strong> {{ $patient['name'] ?? '—' }} | <strong>Nascimento:</strong>
        {{ $patient['birth_date'] ?? '—' }} | <strong>Sexo:</strong> {{ $patient['gender'] ?? '—' }}</p>

    @foreach ($groups as $idx => $group)
        <div class="group-box">
            <div class="title">{{ $group['title'] ?? 'Grupo' }}</div>
            <table>
                <thead>
                    <tr>
                        <th>Exame</th>
                        <th>Lateralidade</th>
                        <th>Comentário</th>
                        <th>Grupo de Impressão</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group['exams'] ?? [] as $exam)
                        <tr>
                            <td>{{ $exam['name'] ?? '—' }}</td>
                            <td>{{ $exam['laterality'] ?? '—' }}</td>
                            <td>{{ $exam['comment'] ?? '—' }}</td>
                            <td>{{ $exam['groupPrint'] ?? ($group['printGroup'] ?? '—') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (!empty($group['observation']))
                <div class="obs"><strong>Observação:</strong> {{ $group['observation'] }}</div>
            @endif
        </div>

        @if ($separatePages && !$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>

</html>
