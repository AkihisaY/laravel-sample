
<div class="row mt-2">
    <div class="col-sm">
        <p class="h5">URL<p>
        <pre class="prettyprint">http://localhost:8000/get_api?function=monthly_asset&key=[project_key]&user_id=[user_id]&month=[yyyymm]</pre>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm">
        <p class="h5">Parameter<p>
        <pre class="prettyprint">function=[function_name]   //function name => monthly_asset
key=[project_key]   //project key
user_id=[user_id]   //user id
month=[yyyymm]      //date </pre>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm">
        <p class="h5">Response<p>
        <pre class="prettyprint">{
    "status": true,
    "result": [
        {
        "asset_id": 27,                //asset id
        "date": "07/2021",             //date
        "cash_jpy": "827",             //cash JPY 
        "cash_dol": "11203",           //cash Dollar
        "cash_inv_jpy": "9876",        //cash for investiment JPY
        "cash_inv_dol": "5678",        //cash for investiment Dollar
        "stock_us": "875293",          //amount of stock for USA
        "stock_other": "18392",        //amount of stock for other
        "total_amount": "577890"       //total amount
        }
    ]
}</pre>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm">
        <p class="h5">Example Source Code(Get)<p>
        <pre class="prettyprint">$url = 'http://localhost:8000/get_api?';
$query = ['function'=>'monthly_asset'
	,'user_id'=>'8'
    ,'key'=>'tH09vSWLOG'
    ,'month'=>'202106'];

$response = file_get_contents(
                  $url.
                  http_build_query($query)
            );

$ret = json_decode($response,true);
$asset = $ret['result'];</pre>
    </div>
</div>
