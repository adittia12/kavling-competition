<table>
    <thead>
        <tr>
            <th>Rank</th>
            <th>Kavling</th>
            @foreach ($parameters as $parameter)
                <th>{{ $parameter->name_parameter }}</th>
            @endforeach
            <th>Total Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rankingData as $rank => $data)
            <tr>
                <td>{{ $rank + 1 }}</td>
                <td>{{ $data['kavling'] }}</td>
                @foreach ($parameters as $parameter)
                    <td>{{ number_format($data['nilai_per_parameter'][$parameter->name_parameter] ?? 0, 0) }}</td>
                @endforeach
                <td>{{ number_format($data['total_nilai'], 0) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
