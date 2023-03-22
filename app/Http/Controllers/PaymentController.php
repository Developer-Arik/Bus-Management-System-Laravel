<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;

class PaymentController extends Controller
{
    function payment(Request $request){
        $post_data = array();

        $post_data['total_amount'] = "5000";
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
        // $post_data['multi_card_name'] = "mastercard,visacard,amexcard";

        # EMI INFO
        $post_data['emi_option'] = "0";
        $post_data['emi_max_inst_option'] = "9";
        $post_data['emi_selected_inst'] = "9";

        # CUSTOMER INFORMATION
        $post_data['pnr'] = $request->pnr;
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $request->pnr;
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        $sslc = new SslCommerzNotification();

        $sslc->makePayment($post_data,'hosted');
    }

    public function success(Request $request){
        $pnr = $request->value_a;
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $sslc = new SslCommerzNotification();

        if($request->store_id===env('SSLCZ_STORE_ID')){
            $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
            $booking = Booking::where('pnr',$pnr)->first();

            $booking->payment->update([
                "status" => true
            ]);

            return redirect()->route('singleBooking',$pnr)->with([
                "payment_success" => "Booking PNR $pnr Payment Succesfull"
            ]);
        }

        return response("Not From this Store",400);
    }

    public function fail(Request $request){
        return $request;
    }
}
