<!DOCTYPE html>
<html>
<head>
    <title>База данных</title>
    <style>
        table { border-collapse: collapse; margin-bottom: 20px; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 5px; }
        .table-section { margin-bottom: 40px; }
        .toggle { cursor: pointer; color: blue; text-decoration: underline; }
        .hidden { display: none; }
    </style>
    <script>
        function toggle(id) {
            const el = document.getElementById(id);
            el.classList.toggle('hidden');
        }
    </script>
</head>
<body>
    <h1>Все таблицы базы</h1>

    @foreach($data as $table)
        <div class="table-section">
            <h2>
                <span class="toggle" onclick="toggle('section-{{ $table['name'] }}')">
                    {{ $table['name'] }}
                </span>
            </h2>

            <div id="section-{{ $table['name'] }}" class="">
                <h3>Структура</h3>
                <table>
                    <tr>
                        @foreach(array_keys((array)$table['columns'][0]) as $col)
                            <th>{{ $col }}</th>
                        @endforeach
                    </tr>
                    @foreach($table['columns'] as $column)
                        <tr>
                            @foreach((array)$column as $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>

                <h3>Данные (первые 50)</h3>
                <table>
                    <tr>
                        @if($table['rows']->isNotEmpty())
                            @foreach(array_keys((array)$table['rows'][0]) as $col)
                                <th>{{ $col }}</th>
                            @endforeach
                        @endif
                    </tr>
                    @foreach($table['rows'] as $row)
                        <tr>
                            @foreach((array)$row as $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endforeach
</body>
</html>
