<table class="table table-compact table-zebra w-full">
    <thead>

        <tr>
            <th></th>
            <th>Carrier</th>
            <th>Flight Date</th>
            <th>Turnaround Type</th>
            <th>Aircraft Type</th>
            <th>Origin</th>
            <th>Destination</th>
            <th>Flight Type</th>
            <th>Aircraft Registration</th>
            <th>Airline Representative</th>
            <th>STA</th>
            <th>STD</th>
            <th>Arrival</th>
            <th>Departure</th>
            <th>Done By</th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($flights as $flight)
            <tr>
                <th>
                    {{ $flight->serial }}

                </th>
                <td>
                    {{ $flight->carrier->carrier_code }} {{ $flight->flight_no }}
                </td>

                <td>
                    {{ Carbon\Carbon::parse($flight->flight_date)->format('j-M-y') }}
                </td>
                <td>{{ $flight->turnaround_type }}</td>
                <td>{{ $flight->aircraft_type }}</td>
                <td>{{ $flight->origin }}</td>
                <td>{{ $flight->destination }} </td>
                <td>
                    @if ($flight->flight_type == 'F')
                        Freighter
                    @elseif($flight->flight_type == 'P')
                        Passenger
                    @endif
                </td>
                <td>{{ $flight->aircraft_registration }} </td>
                <td>{{ $flight->signature_name }} </td>
                <td>{{ $flight->STA }} </td>
                <td>{{ $flight->STD }} </td>
                <td>{{ $flight->arrival }} </td>
                <td>{{ $flight->departure }} </td>
                <td>
                    @if (isset($flight->owner->name))
                        {{ $flight->owner->name }}
                    @else
                        <b>-</b>
                    @endif

                </td>



            </tr>
        @endforeach

    </tbody>

</table>
