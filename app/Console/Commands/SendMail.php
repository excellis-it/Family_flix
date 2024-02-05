<?php

namespace App\Console\Commands;

use App\Mail\InvoiceMail;
use App\Models\File;
use App\Models\Invoice;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;
class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $invoices = Invoice::where(['send_in' => date('Y-m-d'), 'send_in_status' => 1])->get();
        if ( $invoices->count() > 0) {
            foreach ($invoices as $key => $value) {
                $invoice = Invoice::where('id', $value->id)->first();
                $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $ret = '';
                for ($i = 0; $i < 12; ++$i) {
                    $random = str_shuffle($chars);
                    $ret .= $random[0];
                }
                $invoice_number = 'BPM-' . $ret;
                $new_invoice = new Invoice;
                $new_invoice->user_id =  $invoice->user_id;
                $new_invoice->send_in = '';
                $new_invoice->send_in_status = 1;
                $new_invoice->send_id = $invoice->send_id;
                $new_invoice->from_name = $invoice->from_name;
                $new_invoice->from_email = $invoice->from_email;
                $new_invoice->from_state = $invoice->from_state;
                $new_invoice->from_city = $invoice->from_city;
                $new_invoice->from_address = $invoice->from_address;
                $new_invoice->from_zipcode = $invoice->from_zipcode;
                $new_invoice->from_phone = $invoice->from_phone;
                $new_invoice->from_company = $invoice->from_company;
                $new_invoice->project_name = $invoice->project_name;
                $new_invoice->project_address = $invoice->project_address;
                $new_invoice->from_gst = $invoice->from_gst;
                $new_invoice->bil_to_name = $invoice->bil_to_name;
                $new_invoice->bil_to_email = $invoice->bil_to_email;
                $new_invoice->bil_to_state = $invoice->bil_to_state;
                $new_invoice->bil_to_city = $invoice->bil_to_city;
                $new_invoice->bil_to_address = $invoice->bil_to_address;
                $new_invoice->bil_to_zipcode = $invoice->bil_to_zipcode;
                $new_invoice->bil_to_phone = $invoice->bil_to_phone;
                $new_invoice->bil_to_mobile = $invoice->bil_to_mobile;
                $new_invoice->type = $invoice->type;
                $new_invoice->bil_to_faxNo = $invoice->bil_to_faxNo;
                $new_invoice->invoice_no = $invoice_number;
                $new_invoice->notes = $invoice->notes;
                $new_invoice->sub_total = $invoice->sub_total;
                $new_invoice->total = $invoice->total;
                $new_invoice->invoice_date = $invoice->invoice_date;
                $new_invoice->company = $invoice->company;
                $new_invoice->due = $invoice->due;
                if ($invoice->due == "On specific date") {
                    $new_invoice->due_date = $invoice->due_date;
                }
                $new_invoice->discount_price = $invoice->discount_price ?? '';
                $new_invoice->discount_type = $invoice->discount_type ?? '';
                $new_invoice->tax_amount = $invoice->tax_amount ?? '';
                $new_invoice->image =  $invoice->image ?? '';
                $new_invoice->save();
    
                foreach ($invoice['items'] as $key => $item) {
                    if ($item != null) {
                        $add_items = new Item();
                        $add_items->user_id = $invoice->user_id;
                        $add_items->invoice_id = $new_invoice->id;   
                        $add_items->item_description = $item->item_description;               
                        $add_items->item_additional_details = $item->item_additional_details;
                        $add_items->item_rate = $item->rate;
                        $add_items->item_quantity = $item->quantity;
                        $add_items->item_amount = $item->amount ?? '';
                        $add_items->image = $item->image ?? '';
                        $add_items->save();
                    }
        
                }
                $items = Item::where('invoice_id', $new_invoice->id)->get();
                $data = [
                    'invoice_detail' => $new_invoice,
                    'items' => $items,
                ];
        
                $pdf = PDF::loadView('pdf.invoice', [
                        'data' => $data,
                    ])->setOptions(['defaultFont' => 'sans-serif']);
                $pdf_file = new File();
                $content = $pdf->download()->getOriginalContent();
                $filename = 'en' . $invoice->id . date('YmdHi') . '.pdf';
                Storage::put('invoice/' . $filename, $content);
                $pdf_file->file = 'invoice/' . $filename;
                $pdf_file->user_id = $invoice->user_id;
                $pdf_file->invoice_id = $new_invoice->id;
                $pdf_file->save();
    
                if ($invoice->send_id == 2) {
                    // Given date: 2023-08-11
                    $givenDate = $value['send_in'];
    
                    // Convert the given date to a Carbon instance
                    $carbonDate = Carbon::parse($givenDate);
    
                    // Add one week to the date
                    $dateAfterOneWeek = $carbonDate->addWeek();
    
                    // Format the date as needed (optional)
                    $formattedDate = $dateAfterOneWeek->format('Y-m-d');
    
                    $invoice->update(['send_in' =>  $formattedDate]);
                } else {
                    // Given date: 2023-08-11
                    $givenDate = $value['send_in'];
    
                    // Convert the given date to a Carbon instance
                    $carbonDate = Carbon::parse($givenDate);
    
                    // Add one week to the date
                    $dateAfterOneWeek = $carbonDate->addMonth();
    
                    // Format the date as needed (optional)
                    $formattedDate = $dateAfterOneWeek->format('Y-m-d');
    
                    $invoice->update(['send_in' =>  $formattedDate]);
                }
                $items = Item::where('invoice_id', $invoice->id)->get();
                $file = File::where('invoice_id', $invoice->id)->first();
               
                $maildata = [
                    'id' => $invoice->id,
                    'invoice_detail' => $new_invoice,
                    'items' => $items,
                    'pdf_file' => $file['file'] ?? '',
                    'invoice_id' => $invoice_number
                ];
    
                Mail::to($invoice->bil_to_email)->send(new InvoiceMail($maildata));
            }
           Log::info('Invoice send successfully.');
        } else {
            Log::info('Invoice not send.');
        }
        

        $this->info('Invoice send successfully.');
    }
}
