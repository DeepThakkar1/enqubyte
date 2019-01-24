<table>
    <thead>
        <tr>
            <th>Enquiry No.</th>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Followup Date</th>
            <th class="text-right">Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($enquiries as $key => $enquiry)
        <tr>
            <td>{{$enquiry->sr_no}}</td>
            <td>{{$enquiry->customer->fullname}}</td>
            <td>{{$enquiry->enquiry_date ? $enquiry->enquiry_date : '--'}}</td>
            <td>{{$enquiry->followup_date ? $enquiry->followup_date : '--'}}</td>
            <td class="text-right">{{$enquiry->grand_total}}</td>
            <td><span class="badge badge-{{$enquiry->status == -1 ? 'danger' : ($enquiry->status == 1 ? 'success' : 'warning')}}">{{$enquiry->status == -1 ? 'Cancelled' : ($enquiry->status == 1 ? 'Converted' : 'Pending')}}</span> </td>
        </tr>
        @endforeach
    </tbody>
</table>