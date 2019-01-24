<table>
    <thead>
        <tr>
            <th>Purchase No.</th>
            <th>Order ID</th>
            <th>Vendor Name</th>
            <th>Date</th>
            <th>Due Date</th>
            <th class="text-right">Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchases as $key => $purchase)
        <tr>
            <td>{{$purchase->sr_no}}</td>
            <td>{{$purchase->order_id ? $purchase->order_id : '--'}}</td>
            <td>{{$purchase->vendor->name}}</td>
            <td>{{$purchase->purchase_date ? $purchase->purchase_date : '--'}}</td>
            <td>{{$purchase->due_date ? $purchase->due_date : '--'}}</td>
            <td class="text-right">{{$purchase->grand_total}}</td>
            <td><span class="badge badge-{{$purchase->remaining_amount ? 'warning' : 'success'}}">{{$purchase->remaining_amount ? 'Pending' : 'Completed'}}</span> </td>
        </tr>
        @endforeach
    </tbody>
</table>