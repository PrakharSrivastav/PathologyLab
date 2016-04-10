<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$title}}</title>
    </head>
    <body>
        <div style="text-align: center">
            <h4 style="text-align : center">Report Details</h4>
            <table class="cool-header" style="border-collapse: collapse;margin-left: auto;margin-right: auto;width: 80%;">
                <thead >
                    <tr>
                        <th style="width:30%;text-align:left;padding:5px;background: #080808 !important; color: #fff ; border: solid #080808 1px;font-weight: 200 !important;">Test Items</th>
                        <th style="text-align:left;padding:5px;background: #080808 !important; color: #fff ; border: solid #080808 1px;font-weight: 200 !important;">Tested Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Patient Name</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{ucwords($report->user->name)}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Report Name</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{ucwords($report->report_name)}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Case Number</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{$report->case_number}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Report Details</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{$report->description}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Additional Details </td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{$report->addition_details}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Report Status</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{($report->status == '0')? "In Progress" : (($report->status =='1')?"Generate":"Delivered")}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Patient History</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{$report->patient_history}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Test Date</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{$report->test_date->format('d-m-Y')}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Tested By</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{ucwords($report->testing_lab)}}</td>
                    </tr>
                    <tr>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">Last Updated</td>
                        <td style="border: solid #080808 1px;padding:2px;text-align:left">{{$report->updated_at->format('d-m-Y')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
