<table>
    <thead>
    <tr>
        <th>Amount</th>
        <th>Bank Name</th>
        <th>Bank Account Name</th>
        <th>Bank Account Number</th>
        <th>Email</th>
        <th>Email CC</th>
        <th>Email BCC</th>
        <th>Submitter</th>
        <th>Business Unit</th>
        <th>Sub Business Unit</th>
        <th>Project Name</th>
        <th>Type of Cost</th>
        <th>Company Name</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        @php
            $created = \Illuminate\Support\Carbon::parse($item->created_at);
            $description = [
                $item->costcenter->name,
                $item->project->guid,
                $item->company->code,
                $item->costcenter->code,
                $item->project->name,
                strtoupper($created->shortMonthName),
                $created->year
            ];
        @endphp
        <tr>
            <td>{{$item->amount}}</td>
            <td>{{$item->bank_name}}</td>
            <td>{{$item->bank_account_name}}</td>
            <td>{{$item->bank_account_number}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->email_cc}}</td>
            <td>{{$item->email_bcc}}</td>
            <td>{{$item->submitter}}</td>
            <td>{{$item->business_unit->name}}</td>
            <td>{{$item->business_unit->sub_name}}</td>
            <td>{{$item->project->name}}</td>
            <td>{{$item->costcenter->type_of_cost}}</td>
            <td>{{$item->company->name}}</td>
            <td>{{implode("_", $description)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
