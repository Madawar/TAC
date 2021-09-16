<table class="table table-compact table-zebra w-full">
    <thead>

        <tr>
            <th>Serial</th>
            <th>Flight Date</th>
            <th>Carrier</th>
            <th>Service</th>
            <th>QTY</th>
            <th>RATE</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($flights as $flight)
            <tr>
                <th>
                    {{ $flight->serial }}</th>

                <td>
                    {{ Carbon\Carbon::parse($flight->flight_date)->format('j-M-y') }}
                </td>
                <td>
                    {{ $flight->carrier->carrier_code }}{{ $flight->flight_no }}
                </td>
                <td>{{ $flight->turnaround_type }} Charge For {{ $flight->carrier->carrier_code }}
                    {{ $flight->flight_no }} {{ $flight->aircraft_registration }}
                    {{ Carbon\Carbon::parse($flight->flight_date)->format('y.m.d') }} ({{ $flight->aircraft_type }})
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($flight->services as $service)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Incidental Charge For {{ $flight->carrier->carrier_code }}{{ $flight->flight_no }}
                        {{ $flight->aircraft_registration }}
                        {{ Carbon\Carbon::parse($flight->flight_date)->format('y.m.d') }} -
                        {{ $service->service }} </td>
                    <td>{{ $service->qty }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        @endforeach

    </tbody>

</table>
