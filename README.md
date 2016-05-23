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
to  your application/libraries/ folderer

In config/digitalapi.php file update your DigitalAPI key

$config['api_key'] ='XXXXXXX PUT YOUR API KEY HERE XXXXXXXXX'; 
and you're good to go!

## A Brief Introduction
With the digitalapi codeigniter library, we've simplified interaction with the DigitalAPI REST API.
No need to manually create CURL requests in your application, you can include the library in your 
aplication and you are ready to make API calls to Digital API.

## Quickstart

#### Respose Format
For all api calls, there is a unified response format while using the library as follows:
```css
    /**
    *$response is an associatuve array
    *which contains
    *   $response['post_url']
    *   $response['post_endpoint']
    *   $response['post_data']
    *   $response['api_status'] //API Status Code
    *   $response['api_message'] //API MEssage // incase of 400 status you can refer it for error details
    *   $response['api_response'] For API Return please check documentation URL
    */
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
                  'from_mail'=>'example@yourdomain.com',//email should be from your sending domail
                  'from_name'=>'Your Name', //Sender name
                  'reply_to'=>'example@yourdomain.com', //email should be from your sending domail
                  'to_name'=> 'John Doe',// Keep Empty if not available
                  'to_mail'=>'johndoe@example.com', // Receicver email address
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
    
    /**
    *$response is an associatuve array
    *which contains
    *   $response['post_url']
    *   $response['post_endpoint']
    *   $response['post_data']
    *   $response['api_status'] //API Status Code
    *   $response['api_message'] //API Message // incase of 400 status you can refer it for error details
    *   $response['api_response'] For API Return please check documentation URL
    */
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
documentation for sending SMS.](https://www.digitalapi.com/api/v1/docs#voicecall "Digital API 
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
    $response=$this->digitalapi->sendSMS($mailarray);
    
?>
```




