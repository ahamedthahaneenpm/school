<?php

namespace App\Http\Requests\Admin\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DashboardCountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $permissions = [
            "dashboard_count_order_read",
            "dashboard_count_order_request_read",
            "dashboard_count_receivable_read",
            "dashboard_count_payable_read",
            "dashboard_count_profit_read",
            "dashboard_count_customers_read",
            "dashboard_count_customers_request_read",
            "dashboard_count_item_request_read",
            "dashboard_count_salesreturns_read",
            "dashboard_count_stockreceive_read",
            "dashboard_count_pending_receipts_read"
        ];
        return auth()->user()->canany($permissions) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}