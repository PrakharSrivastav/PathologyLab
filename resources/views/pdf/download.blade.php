<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$title}}</title>
        <style>
            .cool-header th  {text-align:left;padding:5px;background: #080808 !important; color: #fff ; border: solid #080808 1px;font-weight: 200 !important;} 
            table.cool-header td {border: solid #080808 1px;padding:2px}
            table {border-collapse: collapse;margin-left: auto;margin-right: auto;width: 80%;}
        </style>

    </head>
    <body>
        <div style="text-align: center">
            <h4 style="text-align : center">Report Details</h4>
            <table class="cool-header">
                <thead >
                    <tr>
                        <th style="width:30%">Test Items</th>
                        <th>Tested Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Patient Name</td><td>{{ucwords($report->user->name)}}</td></tr>
                    <tr><td>Report Name</td><td>{{ucwords($report->report_name)}}</td></tr>
                    <tr><td>Case Number</td><td>{{$report->case_number}}</td></tr>
                    <tr><td>Report Details</td><td>{{$report->description}}</td></tr>
                    <tr><td>Additional Details </td><td>{{$report->addition_details}}</td></tr>
                    <tr><td>Report Status</td><td>Generated</td></tr>
                    <tr><td>Patient History</td><td>{{$report->patient_history}}</td></tr>
                    <tr><td>Test Date</td><td>{{$report->test_date->format('d-m-Y')}}</td></tr>
                    <tr><td>Tested By</td><td>{{ucwords($report->testing_lab)}}</td></tr>
                    <tr><td>Last Updated</td><td>{{$report->updated_at->format('d-m-Y')}}</td></tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
