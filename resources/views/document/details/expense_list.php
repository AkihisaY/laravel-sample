
<div class="row mt-2">
    <div class="col-sm">
        <p class="h5">URL<p>
        <pre class="prettyprint">http://localhost/data/get_api?function=expense_list&key=[project_key]&user_id=[user_id]</pre>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm">
        <p class="h5">Parameter<p>
        <pre class="prettyprint">function=[function_name]   //function name => expense_list
key=[project_key]   //project key
user_id=[user_id]   //user id</pre>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm">
        <p class="h5">Response<p>
        <pre class="prettyprint">{
    "status": true,
    "result": [
    {
      "expense_id": 253,                      //Expense ID
      "pay_date": "06/22/2021",               //pay Date
      "pay_amount": "-123.00",                //Pay Amount
      "contents": "TOKIO MARINE MANAGEMENT",  //contents
      "city": "SAN JOSE",                     //City
      "state": "NY",                          //state
      "country": "US"                         //country
    }
    ]
}</pre>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm">
        <p class="h5">Example Source Code(Get)<p>
        <pre class="prettyprint">$url = 'http://localhost/data/get_api?';
$query = ['function'=>'expense_list'
	,'user_id'=>'8'
    ,'key'=>'tH09vSWLOG'
    ];

$response = file_get_contents(
                  $url.
                  http_build_query($query)
            );

$ret = json_decode($response,true);
$asset = $ret['result'];</pre>
    </div>
</div>
