<table>
    <thead>
        <tr>
            <th>Invoice No.</th>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Due Date</th>
            <th class="text-right">Amount</th>
            <th class="text-right">Remaining Amt</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $key => $invoice)
        <tr>
            <td>{{$invoice->sr_no}}</td>
            <td>{{$invoice->visitor->fullname}}</td>
            <td>{{$invoice->invoice_date ? $invoice->invoice_date : '--'}}</td>
            <td>{{$invoice->due_date ? $invoice->due_date : '--'}}</td>
            <td class="text-right">{{$invoice->grand_total}}</td>
            <td class="text-right">{{$invoice->remaining_amount}}</td>
            <td><span class="badge badge-{{$invoice->remaining_amount ? 'warning' : 'success'}}">{{$invoice->remaining_amount ? 'Pending' : 'Completed'}}</span> </td>
        </tr>
        @endforeach
    </tbody>
</table>