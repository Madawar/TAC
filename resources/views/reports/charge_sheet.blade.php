<html>
<?php
use Illuminate\Support\Str;
?>

<head>
    <link rel="stylesheet" href="{{ url('css/bundle.css') }}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ url('css/dashboard.css') }}" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Orbitron:400,500,700,900" rel="stylesheet">
    <style>
        body {
            background: #fff !important;

        }

        table {
            border-collapse: collapse !important;
        }

        .logo {
            position: fixed;
            top: -40px;
            left: 0px;
            right: 0px;
        }

        @font-face {
            font-family: 'Orbitron';
            src: url('{{ url('/Orbitron-Black.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Orbitron';
            /*same name, yes*/
            font-weight: bold;
            /*config its weight*/
            src: url('{{ url('/Orbitron-Bold.ttf') }}') format('truetype');

        }

        .sheetno {
            font-weight: bold;
            float: right;
        }

    </style>
</head>

<body>

    <img class="logo" src="{{ url('/logo.jpg') }}" style="width:200px; height:auto;" />
    <div style="float:right;">
        <b>Transglobal Building<br />
            Cargo Road, Freight Terminal<br />
            Jomo Kenyatta Int'l Airport<br />
            P.O Box 661 - 00521 Nairobi - Kenya</b>
    </div>
    <h1 class="text-center" style="z-index:1000;"> Aircraft Turnaround Charge Sheet</h1>
    <h2 class="text-center ">Date : <span class="">{!! \Carbon\Carbon::parse($flight->flight_date)->format('j<\s\up>S<\/\s\up> F, Y') !!}</span>
    </h2>

    <hr />

    <h1 class="
            sheetno"><i>S/NO </i> : {{ $flight->serial }}</h1>
            <br />
            <br />

            <table class="table card-table table-vcenter text-nowrap table-bordered">

                <tbody>
                    <tr>
                        <td colspan="4" style="font-weight: bold; background: #f6fbff;">Flight Details</td>
                    </tr>
                    <tr>
                        <td>
                            Flight Number : <u><b
                                    class="">{{ $flight->carrier->carrier_code }} {{ $flight->flight_no }}</b></u>

                </td>
                <td>
                    Origin : <u><b>{{ $flight->origin }}</b></u>
                </td>
                <td>
                    STA : <u><b>{{ $flight->STA }}</b></u>

                </td>
                <td>
                    ATA : <u><b>{{ $flight->arrival }}</b></u>
                </td>
            </tr>
            <tr>
                <td>
                    Aircraft Type / Config : <u><b class="">{{ $flight->aircraft_type }}</b></u>

                </td>
                <td>
                    DEST : <u><b>{{ $flight->destination }}</b></u>
                </td>
                <td>
                    STD : <u><b>{{ $flight->STD }}</b></u>

                </td>
                <td>
                    ATD : <u class=" text-right"><b>{{ $flight->departure }}</b></u>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Aircraft Registration: <u><b>{{ $flight->aircraft_registration }}</b></u>

                        </td>
                        <td colspan="2">
                            Parking Stand ARR : <u><b></b></u>
                        </td>

                    </tr>
                </tbody>

            </table>
            <br />
            <table class="table card-table table-vcenter text-nowrap table-bordered">

                <tbody>
                    <tr>
                        <td style="font-weight: bold; background: #f6fbff;">Services Provided</td>
                    </tr>
                    <tr style="height: 300px;">
                        <td class=""
                    style=" width: 300px; height: 80px; vertical-align: top;
                            text-align: justify;font-weight: bold;">
                            1.) {{ $flight->turnaround_type }}

                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background: #f6fbff;">Incidental Services Provided</td>
                    </tr>
                    <tr>
                        <td class=""
                    style=" width: 300px; height: 80px; vertical-align: top;
                            text-align: justify;font-weight: bold;">
                            @foreach ($flight->services as $incidental)
                                <b>{{ $loop->index + 1 }}.)</b> {{ $incidental->service }}
                                @if ($incidental->start_time != '' || $incidental->start_time != null)
                                    - {{ $incidental->start_time }} {{ $incidental->end_time }}
                                    ,{{ $incidental->remarks }}
                                @else
                                    - {{ $incidental->qty }}
                                    @if ((int) $incidental->qty > 0)
                                        ,{{ $incidental->remarks }}
                                    @else
                                        ,{{ $incidental->remarks }}
                                    @endif

                                @endif
                                <br />
                            @endforeach

                        </td>


                    </tr>
                </tbody>

            </table>
            <br />

            <table class="table card-table table-vcenter text-nowrap table-bordered">

                <tbody>
                    <tr>
                        <td colspan="2" style="font-weight: bold; background: #f6fbff;">Airline</td>
                    </tr>
                    <tr>
                        <td
                            style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
                            Airline Representative<br />
                            {{ $flight->signature_name }}

                        </td>
                        <td
                            style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
                            Signature<br />
                            @if ($flight->signature != null)
                                <img src="{{ url('/storage/signatures/' . $flight->signature) }}"
                                    style="max-width:auto; height:90px;" />
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2" style="font-weight: bold; background: #f6fbff;">GHA</td>
                    </tr>
                    <tr>
                        <td
                            style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
                            AFS Representative<br />
                            @if ($user)
                                {{ $user->name }}
                            @endif
                        </td>
                        <td
                            style="width: 300px; height: 90px; vertical-align: top; text-align: left;font-weight: bold;">
                            Signature<br />
                            @if ($user)
                                <img src="{{ url('/storage/signatures/' . $user->signature) }}"
                                    style="max-width:auto; height:90px;" />
                            @endif
                        </td>

                    </tr>

                </tbody>
            </table>
            <br />
            <table class="table card-table table-vcenter text-nowrap table-bordered">

                <tbody>
                    <tr>
                        <td style="font-weight: bold; background: #f6fbff;">Comments</td>
                    </tr>
                    <tr style="height: 300px;">
                        <td
                            style="width: 300px; height: 60px; vertical-align: top; text-align: left;font-weight: bold;">
                            {{ $flight->remarks }}

                        </td>

                    </tr>

                    </tr>
                </tbody>
            </table>

</body>

</html>
