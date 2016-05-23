## Installation
You can install **digitalapi-codeigniter** by downloading the source.

#### Via ZIP file:
Click here to download the source
(.zip)](https://github.com/DigitalAPI/digitalapi-codeigniter/zipball/master) 
which includes all dependencies.

Once you download the files, move the digitalapi-codeigniter files to your 
codeigniter application  folders.

1-Copy the digitalapi-codeigniter/application/config/digitalapi.php file 
to your application/config/ folder

2-Copy the digitalapi-codeigniter/application/libraries/digitalapi.php file
to  your application/libraries/ folder

In config/digitalapi.php file update your DigitalAPI key

$config['api_key'] ='XXXXXXX PUT YOUR API KEY HERE XXXXXXXXX'; 
and you're good to go!

## A Brief Introduction
With the digitalapi codeigniter library, we've simplified interaction with the DigitalAPI REST API.
No need to manually create CURL requests in your application, you can include the library in your 
aplication and you are ready to make API calls to Digital API.

## Quickstart

#### Response Format
For all api calls, there is a unified response format while using the library as follows:
```php
<?php
    // $response is an associative array which contains
    $response['post_url']
    $response['post_endpoint']
    $response['post_data']
    $response['api_status'] //API Status Code
    $response['api_message'] //API Message // incase of 400 status you can refer it for error details
    $response['api_response'] //For API Return please check documentation URL
?>
For more details on response format please do check our hosted document at: https://www.digitalapi.com/api/v1/docs
```


### Send an Email
**Document URL:** 
The documentation for **digitalapi** is hosted
at : [Click here to read our full
documentation for sending email.](https://www.digitalapi.com/api/v1/docs#email "Digital API 
Library Documentation For Sending Email")

Please refer the document for all possible response and inputs.
```php
<?php
    //Set up mail data
    $mailarray=array(
                  'from_mail'=>'example@yourdomain.com',//email should be from your sending domain
                  'from_name'=>'Your Name', //Sender name
                  'reply_to'=>'example@yourdomain.com', //email should be from your sending domain
                  'to_name'=> 'John Doe',// Keep Empty if not available
                  'to_mail'=>'johndoe@example.com', // Receiver email address
                  'subject'=> 'Firstmail using Digital API', //Mail subject
                  'message'=>'<p>Hello World! My firstmail using DIgital API</p>', //mail body HTML or Plaintext
                  'attachment'=>0,// 1 if  attachment / If 1 below fields are mandatory
                  'attachment_path'=>'', //Fully qualified url
                  'attachment_name'=>'', //Add new file name if you want your rename 
                  'attachment_type'=>'', //Mime type of attachment
                  );
    //Load digital API Library
    $this->load->library('digitalapi');
    
    //Make the API call
    $response=$this->digitalapi->sendMail($mailarray);
    
    //Checking status
    $status=$response['api_status'];
    if($status==200):
      echo 'Congrats! You sent an email using DigitalAPI!'
    else:
      echo 'You got a error: '.$response['api_message'];
    endif;      
?>
```

### Send a SMS
**Document URL:** 
The documentation for **digitalapi SMS** is hosted
at : [Click here to read our full
documentation for sending SMS.](https://www.digitalapi.com/api/v1/docs#sms "Digital API 
Library Documentation For Sending SMS")

Please refer the document for all possible response and inputs.
```php
<?php
    //Setup SMS Data
    $dataarray=array(
                        'country'=>91, // country dialing code 
                        'number'=>9999999999, //Receiver number
                        'message'=>'Your OTP for transaction is 8967',
                        'type'=>'t' // t- Transactional / p- Promotional
                    );
     //Load digital API Library
    $this->load->library('digitalapi');
    
    //Make the API call
    $response=$this->digitalapi->sendSMS($mailarray);
    
    //Check status
    $status=$response['api_status'];
    if($status==200):
      echo 'Congrats! You sent an SMS using DigitalAPI!'
    else:
       echo 'You got a error: '.$response['api_message'];
    endif;                      
?>
```

### Make a Voice Call
**Document URL:** 
The documentation for **digitalapi Call** is hosted
at : [Click here to read our full
documentation for making Voice Calls.](https://www.digitalapi.com/api/v1/docs#voicecall "Digital API 
Library Documentation For Making Voice Call")

Please refer the document for all possible response and inputs.
```php
<?php
    //Setup SMS Data
    $dataarray=array(
                        'country'=>91, // country dialing code 
                        'number'=>9999999999, //Receiver number
                        'message'=>'Your OTP for transaction is 8967',
                        'type'=>'t' // t- Transactional / p- Promotional
                    );
    //Load digital API Library
    $this->load->library('digitalapi');
    
    //Make the API call
    $response=$this->digitalapi->makeCall($mailarray);
    
    //Check status
    $status=$response['api_status'];
    if($status==200):
      echo 'Congrats! You made a call using DigitalAPI!'
    else:
       echo 'You got a error: '.$response['api_message'];
    endif; 
?>
```


### Get the  IP Information
**Document URL:** 
The documentation for **digitalapi  IP Information** is hosted
at : [Click here to read our full
documentation for getting the IP info.](https://www.digitalapi.com/api/v1/docs#ipinfo "Digital API 
Library Documentation getting the IP info")

Please refer the document for all possible response and inputs.
```php
<?php
    //Set parameters
    
    // Default : partial, which returns only Country,Country_code,City,State
    //Made two return types to speed up the ip search
    $returndata='full'; 
    
    //IP adress
    $ip='XXX.XXX.XXX.XXX';
    
    //Load digital API Library
    $this->load->library('digitalapi');
    
    //Make the API call
    $response=$this->digitalapi->getIPInfo($returndata,$ip);
    
?>
```

### Number Lookup
**Document URL:** 
The documentation for **digitalapi  Number Lookup** is hosted
at : [Click here to read our full
documentation for Number Lookup.](https://www.digitalapi.com/api/v1/docs#numberlookup "Digital API 
Library Documentation Number Lookup")

Please refer the document for all possible response and inputs.
```php
<?php
    //Set parameters
    $number_data=array(
                'country'=>91, //Recipient country dialing code
                'number'=>7845784578, //Phone number
                'force_fetch'=>'N' //Fetch from provider, (Y,N) - Yes or No
                );
    //Load digital API Library
    $this->load->library('digitalapi');
    
    //Make the API call
    $response=$this->digitalapi->getNumberInfo($number_data);
?
```


### Get Credit Status
**Document URL:** 
The documentation for **digitalapi  Get Credit Status** is hosted
at : [Click here to read our full
documentation for Credit Status.](https://www.digitalapi.com/api/v1/docs#credit-info "Digital API 
Library Documentation Credit Status")

Please refer the document for all possible response and inputs.
```php
<?php
    //Load digital API Library
    $this->load->library('digitalapi');
    
    //Make the API call
    $response=$this->digitalapi->myCreditStatus(); 
?
```

### Get Credit Transaction History
**Document URL:** 
The documentation for **digitalapi  Credit History** is hosted
at : [Click here to read our full
documentation for Credit History.](https://www.digitalapi.com/api/v1/docs#credit-history "Digital API 
Library Documentation Credit History")

Please refer the document for all possible response and inputs.
```php
<?php
    //Set up data
    $search_array=array(
                    'search_type'=>'C',// Request Type(C,D) - Date wise search or Number of latest records
                    'records'=>5, //Number of records to be fetched. // Needed when request_type is C.
                    'start_date'=>'YYYY-MM-DD', // From Date // If type = D
                    'end_date'=>'YYYY-MM-DD', // To Date // If type = D
                    );

    //Load digital API Library
    $this->load->library('digitalapi');
    
    //Make the API call
    $response=$this->digitalapi->myCreditTransactions($search_array); 
?
```


## Reports
DigitalAPI offers a simple way to keep track of your API usages and conversations. You can access your usage / conversion data through bellow HTTP requests.

**Document URL:** 
The documentation for **digitalapi reports** is hosted
at : [Click here to read our full
documentation for reports.](https://www.digitalapi.com/api/v1/docs#reports "Digital API 
Library Documentation reports")

Please refer the document for all possible response and inputs.
```php
<?php
    /**
    * There will be 4 types of report format
    * 1- Get the API Usage //Docs: https://www.digitalapi.com/api/v1/docs#report-usage
    * 2- Get the status of SMS(s) sent //Docs: https://www.digitalapi.com/api/v1/docs#report-sms
    * 3- Get the status of Voice Call(s) //Docs: https://www.digitalapi.com/api/v1/docs#report-call
    * 4- Get the status of Email(s) //Docs: https://www.digitalapi.com/api/v1/docs#report-email
    * For multiple status search, Digital API provides a single call environment
    * You can query up to 100 message id's at a time
    */
    
    $reportType='usage'; // usage / sms / call / email
    
    //Single Message search
    $messageId='{"message_id":"b624092b8dce4c17a031cffe9855e7c2"}';
    
    //or
    
    //Multiple Message Search
    $messageId='{"message_id":["b624092b8dce4c17a031cffe9855e7c2", "38b1ef23703c4254993e90473b398fa3"]}';
    
    
    //Load digital API Library
    $this->load->library('digitalapi');
    
    //Make the API call
    //Incase of usage search leave $messageId
    $response=$this->digitalapi->getReport($reportType,$messageId);
    
?>
```


## Webhooks
Webhook is a HTTP callback, where data is sent through POST method whenever an event occurred. Webhooks can be configured for all the events of the every END-POINT. All webhook calls to your server includes your API key in the data posted, so that you can make sure that the data posted belongs to you. Your callback urls mustn't be shared with anyone apart from DigitalAPI.

[Register your webhook URLs here](https://www.digitalapi.com/api-v1/webhooks/app/ "Register your 
webhook URLs here")
Obtain the login pass phrase from DigitalAPI

### Receiving webhook calls
Once you setup your webhook url, you will receive the call back as a post to the url

**Catching the post data**
```php
<?php
    //Webhook Configured page
    //example to fetch data
    //Please check https://www.digitalapi.com/api/v1/docs#webhooks for more details
    
    if($this->input->post()): 
        $hookdata=json_decode($this->input->post('data'),true);
        $action_performed=$data['current_action']['action_performed'];       
        $msg_id=$data['msg_id'];
    endif;
?>
```

## Prerequisites

* PHP >= 5.2.3
* CodeIgniter >= 3.0.1
* The PHP cURL extension

## Getting help

If you need help installing or using the library, please contact DigitalAPI Support at support@digitalapi.com first. 

If you've instead found a bug in the library or would like new features added, go ahead and open issues or pull requests against this repo!
