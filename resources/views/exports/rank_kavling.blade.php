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
                    <td>{{ $data['nilai_per_parameter'][$parameter->name_parameter] ?? 0 }}</td>
                @endforeach
                <td>{{ $data['total_nilai'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
