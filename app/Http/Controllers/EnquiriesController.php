<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EnquiryItem;
use Illuminate\Http\Request;
use App\Models\SalesmanIncentive;
use App\Notifications\NewEnquiry;
use App\Notifications\UpdateEnquiry;
use App\Notifications\NewInvoice;
use App\Exports\EnquiriesExport;
use Maatwebsite\Excel\Facades\Excel;

class EnquiriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'subscribed']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('start_date') && request('end_date')) {
            $enquiries = auth()->user()->enquiries()->whereBetween('enquiry_date', [date('d-m-Y', strtotime(request('start_date'))), date('d-m-Y', strtotime(request('end_date')))])->get();
        }else{
            $enquiries = auth()->user()->enquiries;
        }
        return view('enquiries.index', compact('enquiries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->activeSubscription()->getRemainingOf('enquiries.count'))
        {
            flash('You need to upgrade to add more enquiries.')->warning();
            return redirect('billing');
        }
        $customers = auth()->user()->visitors()->where('status', '!=', -1)->get();
        $salesmans = auth()->user()->employees;
        $products = auth()->user()->products;
        $enquirySrno = Enquiry::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;
        if(isset(auth()->user()->invoicetaxes)){
            $taxIds = explode(',', auth()->user()->invoicetaxes);
            $invoicetaxes = Tax::whereIn('id', $taxIds)->get();
            return view('enquiries.create', compact('salesmans', 'customers', 'products', 'enquirySrno', 'invoicetaxes'));
        }else{
            return view('enquiries.create', compact('salesmans', 'customers', 'products', 'enquirySrno'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'enquiry_date' => 'required',
            'sub_tot_amt' => 'required',
            'grand_total' => 'required'
        ]);
        $enquirySrno = Enquiry::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;

        $taxes = [];
        if (request()->has('tax_amt') && count(request('tax_amt'))) {
                        foreach (request('tax_amt') as $key => $tax_amt) {
                $taxes[] = [request('tax_abbrivation')[$key] => $tax_amt];
            }
        }

        $enquiry = Enquiry::create([
            'sr_no' => $enquirySrno,
            'company_id' => auth()->id(),
            'employee_id' => !empty(request('employee_id')) ? request('employee_id') : 0,
            // 'store_id' => 0,
            'customer_id' => request('customer_id'),
            'followup_date' => date('d-m-Y', strtotime(request('followup_date'))),
            'followup_time' => request('followup_time'),
            'enquiry_date' => date('d-m-Y', strtotime(request('enquiry_date'))),
            'sub_tot_amt' => request('sub_tot_amt'),
            'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,
            'taxes' => json_encode($taxes),
            'grand_total' => request('grand_total')
        ]);

        for ($i=0; $i < count(request('product_id')); $i++) {
            $enquiry->enquiryitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);
        }

       // $enquiry->customer->notify(new NewEnquiry($enquiry, auth()->user()));

        auth()->user()->activeSubscription()->consumeFeature('enquiries.count', 1);

        flash('Enquiry added successfully!')->success();
        return redirect('/enquiries/'.$enquiry->sr_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show($enquiry)
    {
        $enquiry = auth()->user()->enquiries->where('sr_no', $enquiry)->first();
        return view('enquiries.show', compact('enquiry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        if($enquiry->status == 1)
        {
            flash("You can't edit this enquiry!");
            return back();
        }
        else
        {
            $customers = auth()->user()->visitors()->where('status', '!=', -1)->get();
            $salesmans = auth()->user()->employees;
            $products = auth()->user()->products;
            $enquiryitems = $enquiry->enquiryitems;

            if(isset(auth()->user()->invoicetaxes)){
                $taxIds = explode(',', auth()->user()->invoicetaxes);
                $invoicetaxes = Tax::whereIn('id', $taxIds)->get();
                return view('enquiries.edit', compact('salesmans', 'enquiry', 'customers', 'products', 'enquiryitems', 'invoicetaxes'));
            }else{
                return view('enquiries.edit', compact('salesmans', 'enquiry', 'customers', 'products', 'enquiryitems'));
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'customer_id' => 'required',
            'enquiry_date' => 'required',
            'sub_tot_amt' => 'required',
            'grand_total' => 'required'
        ]);

        $taxes = [];
        if (request()->has('tax_amt') && count(request('tax_amt'))) {
            foreach (request('tax_amt') as $key => $tax_amt) {
                if (!$tax_amt) {
                    $taxes[] = [request('old_tax_abbrivation')[$key] => request('old_tax_amt')[$key]];
                }
                else{
                    $taxes[] = [request('tax_abbrivation')[$key] => $tax_amt];
                }
            }
        }
        $enquiry->update([
            'company_id' => auth()->id(),
            'employee_id' => !empty(request('employee_id')) ? request('employee_id') : 0,
            // 'store_id' => 0,
            'customer_id' => request('customer_id'),
            'followup_date' => date('d-m-Y', strtotime(request('followup_date'))),
            'followup_time' => request('followup_time'),
            'enquiry_date' => date('d-m-Y', strtotime(request('enquiry_date'))),
            'sub_tot_amt' => request('sub_tot_amt'),
            'discount_type' => request('discount_type'),
            'discount' => !empty(request('discount')) ? request('discount') : 0,
            'taxes' => json_encode($taxes),
            'grand_total' => request('grand_total')
        ]);
        $enquiry->enquiryitems()->delete();

        for ($i=0; $i < count(request('product_id')); $i++) {
            $enquiry->enquiryitems()->create([
                'product_id' => request('product_id')[$i],
                'description' => request('description')[$i],
                'qty' => request('qty')[$i],
                'price' => request('price')[$i],
                'tax' => isset(request('tax')[$i]) ? request('tax')[$i] : 0,
                'product_tot_amt' => request('product_tot_amt')[$i]
            ]);
        }

        // $enquiry->customer->notify(new UpdateEnquiry($enquiry, auth()->user()));

        flash('Enquiry updated successfully!')->success();
        return redirect('/enquiries');
    }

    public function createInvoice($enquiry)
    {
        $enquiry = auth()->user()->enquiries()->where('sr_no', $enquiry)->first();
        if (isset($enquiry->invoice)) {
            flash("Enquiry already converted to sale!");
            return redirect('/enquiries/'.$enquiry->sr_no);
        }else{
            foreach ($enquiry->enquiryitems as $key => $item) {
                $product = Product::where('id', $item->product_id)->first();
                if ($product->has_stock && $product->stock < $item->qty) {
                    flash('Only '. $product->stock . ' '.$product->name. ' available!')->warning();
                    return back();
                }
            }

            $enquiry->update(['status' => 1]);
            $invoiceSrno = Invoice::orderBy('created_at', 'desc')->where('company_id', auth()->id())->count() + 1;
            $invoice = Invoice::create([
                'sr_no' => $invoiceSrno,
                'company_id' => auth()->id(),
                'employee_id' => !empty($enquiry->employee_id) ? $enquiry->employee_id : 0,
            // 'store_id' => 0,
                'customer_id' => $enquiry->customer_id,
                'enquiry_id' => $enquiry->id,
                'invoice_date' => date('d-m-Y'),
                'due_date' => date('d-m-Y'),
                'sub_tot_amt' => $enquiry->sub_tot_amt,
                'discount_type' => $enquiry->discount_type,
                'discount' => !empty($enquiry->discount) ? $enquiry->discount : 0,
                'grand_total' => $enquiry->grand_total,
                'taxes' => json_encode($enquiry->taxes),
                'remaining_amount' => $enquiry->grand_total
            ]);

            $enquiry->customer->update(['is_customer' => 1]);

            foreach ($enquiry->enquiryitems as $key => $item) {
                $invoice->invoiceitems()->create([
                    'product_id' => $item->product_id,
                    'description' => $item->description,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'tax' => isset($item->tax) ? $item->tax : 0,
                    'product_tot_amt' => $item->product_tot_amt
                ]);

                $product = Product::where('id', $item->product_id)->first();
                $product->stock -= $item->qty;
                $product->save();
            }

            if(isset($invoice->employee) && $invoice->employee->incentive_id != 0){
                $incentiveAmt = 0;
                if ($invoice->employee->incentive->type == 1) {
                    $incentiveAmt = $invoice->employee->incentive->rate;
                }else if ($invoice->employee->incentive->type == 2) {
                    $incentiveAmt = (($invoice->grand_total * $invoice->employee->incentive->rate) / 100);
                }

                if ($invoice->grand_total >= $invoice->employee->incentive->minimum_invoice_amt) {
                    $invoice->incentive_amt = $incentiveAmt;
                    $invoice->save();
                    $incentive = SalesmanIncentive::create([
                        'employee_id' => $invoice->employee_id,
                        'enquiry_id' => isset($invoice->enquiry_id) ? $invoice->enquiry_id : 0,
                        'invoice_id' => $invoice->id,
                        'incentive_amount' => $incentiveAmt,
                    ]);
                }
            }

            // $invoice->customer->notify(new NewInvoice($invoice, auth()->user()));

            flash('Invoice created successfully!')->success();
            return redirect('/sales/invoices/' . $invoice->sr_no);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        if($enquiry->status == 1 || $enquiry->status == -1)
        {
            flash("You can't edit this enquiry!");
            return redirect('/enquiries');
        }
        else
        {
            $enquiry->enquiryitems()->delete();
            $enquiry->delete();
            flash('Enquiry deleted successfully!')->error();
            return redirect('/enquiries');
        }
    }

    public function cancel(Enquiry $enquiry)
    {
        $enquiry->update(['status' => -1]);
        flash('Enquiry cancelled successfully!')->error();
        return redirect('/enquiries');
    }

    public function changefollowupdate(Request $request, Enquiry $enquiry)
    {
        $enquiry->update(['followup_date' => $request->followup_date, 'followup_time' => $request->followup_time]);
        flash('Enquiry followup date updated successfully!')->success();
        return redirect('/enquiries/'.$enquiry->sr_no);
    }

    public function exportToExcel(Request $request)
    {
        if($request){
            return Excel::download(new EnquiriesExport($request->start_date, $request->end_date), 'enquiries.xlsx');
        }else{
            return Excel::download(new EnquiriesExport(), 'enquiries.xlsx');
        }
    }

    public function download(Enquiry $enquiry){
        $enquiryPdf = \PDF::loadView('enquiries.print', compact('enquiry'));

        // return $enquiryPdf->download('enquiry.pdf');
        return view('enquiries.print', compact('enquiry'));
    }

    public function exportToPDF(){
       return Excel::download(new EnquiriesExport(), 'enquiries.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
   }

   public function enquiryExportToPDF(Enquiry $enquiry){
       return Excel::download(new EnquiryExport($enquiry), 'ENV-00'.$enquiry->sr_no.'.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
   }

   public function exportToCSV(){
       return Excel::download(new EnquiriesExport(), 'enquiries.csv',  \Maatwebsite\Excel\Excel::CSV);
   }
}
