<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Class to utilize DigitalAPI  https://www.digitalapi.com/
 * @author DigitalAPI.com
 * @author DigtalAPI <info@digitalapi.com>
 */
class Digitalapi { 
    
    //API KEY
    protected $apikey;
    //Digital API  Calling URL
    protected $url;
    //Codeignitor Instance
    protected $_ci;
    
    /**
     * Loads config variables from config/digitalapi.php 
     * If need to put manual key key can be passed to constructor
     *   
     * @param string API KEY
     * @return void
     */
    
    function __construct($apikey=null) {
        $this->_ci =& get_instance();     
        $this->_ci->load->config('digitalapi');
        
        //Check if API Key Provided
        if($apikey!=''):
           $apikey= $this->_ci->config->item('api_key');
        endif; 
        $this->apikey=$apikey;
        $version=$this->_ci->config->item('api_version');
        $base_calling_url=$this->_ci->config->item('api_url');
        $this->url=$base_calling_url.$version.'/';        
    }
    
    
    /**
     * 
     * @description  Use to fetch the API key 
     * 
     * @param NONE
     * @return APIKey
     */
    
    public function getapiKey()
    {
        return $this->apikey;
    }
    
    
    /**
     * Use to fetch the URL 
     * 
     * @param NONE
     * @return API URL
     */
    public function getUrl()
    {
        return $this->url;
    }

    
    /**
     * To send email, you have to perform an HTTP POST to the Messages resource URI. We will also use the following resources for making REST requests.
     * @param  message	HTML / TEXT Mail Content	<html><div> Hello John Doe, Check google's new logo .</div></html>	
     * @param  subject	Email Subject	Check it out	
     * @param  from_name	Sender Name	DigitalAPI Admin	
     * @param from_mail	Sender Email	no-reply@digitalapi.com	
     * @param  reply_to	Reply To Email	info@digitalapi.com	
     * @param  to_name	Receiver Name	John Doe	
     * @param  to_mail	Receiver Email	john@example.com	
     * @param  type	Message Type(P,T) â€“ Promotional or Transactional	P [ if nothing passed default will be Transactional]	
     * @param  attachment	1 or 0	1	If 1 below fields are mandatory
     * @param  attachment_path	Fully qualified url	https://pbs.twimg.com/profile_images/638751551457103872/KN-NzuRl.png	
     * @param  attachment_name	Name of the attachment you want to change	Googlenewlogo.png	
     * @param  attachment_type	Mime type of attachment	image/jpeg	
     */
    
    public function sendMail($mailarray)
    {
        $jsonencoded_data=  json_encode($mailarray);
        $data = array("apiKey"=>$this->apikey,"data"=>$jsonencoded_data);  
        $encoded_response= $this->CallAPI($this->url.'sendMail',$data); //in response you will get jSon data  
        $apiresponse=json_decode($encoded_response); 
        $response['post_url']=$this->url.'sendMail';
        $response['post_endpoint']='sendMail';
        $response['post_data']=$data;        
        $response['api_response']=$apiresponse;
        $response['api_status']=$apiresponse->response;
        $response['api_message']=$apiresponse->message;
        return $response;
    }
    
    
    
    /**
     * Send SMS 
     * This end-point enables you get the API usage history in real time. Returns action count for a "_id " provided [ refer sendEmail success response for "_id" ] 
     * @param country	Recipient country dialing code	1 for USA , 91 for India etc..	
    * @param number	Recipient mobile number	9999999999	
    * @param message	Message you want to sent ( keep it under 160 character to make a single SMS)	Test SMS via DigitalAPI	
      * @param type	Message Type(P,T) - Promotional or Transactional	T [ if nothing passed default will be Promotional]
     */
    
    public function sendSMS($smsarray)
    {       
        $jsonencoded_data=  json_encode($smsarray);
        $data = array("apiKey"=>$this->apikey,"data"=>$jsonencoded_data);  
        $encoded_response= $this->CallAPI($this->url.'sendMessage',$data); //in response you will get jSon data  
        $apiresponse=json_decode($encoded_response); 
        $response['post_url']=$this->url.'sendMessage';
        $response['post_endpoint']='sendMessage';
        $response['post_data']=$data;        
        $response['api_response']=$apiresponse;
        $response['api_status']=$apiresponse->response;
        $response['api_message']=$apiresponse->message;
        return $response;
    }
    
    /**
     * Make Call
     * To make an outgoing voice call perform an HTTP POST to the Messages resource URI. We will also use the following resources for making REST requests.
     * @param country	Recipient country dialing code	1 for USA , 91 for India etc..
     * @param number	Recipient mobile number	9999999999
     * @param message	Message you want to sent in array Format 	

        array(
            0 => array(
                'message' => 'Hello, Welcome to DigitalAPI',
                'language' => 'en-us',
                'voice' => 'MAN',
                'loop' => 1
                ),
            1 => array(
                'message' => 'Your verification code is 2015',
                'language' => 'en-us',
                'voice' => 'MAN',
                'loop' => 2
                ),
            2 => array(
                'message' => 'Thank you for choosing DigitalAPI.',
                'language' => 'en-us',
                'voice' => 'MAN',
                'loop' => 1
                )
            )

     * @param  type	Message Type(P,T) - Promotional or Transactional	T [ if nothing passed default will be Promotional]
     */    
    
    public function makeCall($callarray)
    {       
        $jsonencoded_data=  json_encode($callarray);
        $data = array("apiKey"=>$this->apikey,"data"=>$jsonencoded_data);  
        $encoded_response= $this->CallAPI($this->url.'sendVoiceMessage',$data); //in response you will get jSon data  
        $apiresponse=json_decode($encoded_response); 
        $response['post_url']=$this->url.'sendVoiceMessage';
        $response['post_endpoint']='sendVoiceMessage';
        $response['post_data']=$data;        
        $response['api_response']=$apiresponse;
        $response['api_status']=$apiresponse->response;
        $response['api_message']=$apiresponse->message;
        return $response;
    }
    
    
    /**
     *This end-point enables you get the Information of an IP address. 
     * @param  ip_address	IP address	{"ip_address":"183.82.223.1"}
     * \n OR
     * {"ip_address":["183.82.223.1","49.204.46","49.204.62.232"]}
        In array we can pass maximum of 100 values. 
     */
    
    public function getIPInfo($returndata='partial',$ip=null)
    {          
        $response_data=array();                
        if(!$ip):
            $ip=$this->_ci->input->ip_address();
        endif;
        
        $single_ip_parameterarray=array(
                                    'ip_address'=>$ip,
                                    );  
        //Json encode to prepare data string
        $jsonencoded_data=  json_encode($single_ip_parameterarray);
        //API DATA ARRAY
        $data = array('apiKey'=>$this->getapiKey(),'data'=>$jsonencoded_data);          
        //Now initiate cURL
        $response= $this->CallAPI($this->getUrl().'getIPInfo',$data); //in response you will get jSon data      
        if($response):                    
            if($returndata=='full'):
                return json_decode($response,true); 
            else:                
                $ipinfo=  json_decode($response,true);
                $country='';
                $country_code='';
                $city='';
                $state='';
                if (array_key_exists('country',$ipinfo['ip_info'][$ip])):
                    if(trim($ipinfo['ip_info'][$ip]['country']) !=''):                     
                        $country=trim($ipinfo['ip_info'][$ip]['country']);
                    else:
                        $country='N/A';
                    endif;
                else:    
                  $country='N/A';  
                endif; 
                
                if (array_key_exists('country_code',$ipinfo['ip_info'][$ip])):
                    if(trim($ipinfo['ip_info'][$ip]['country_code']) !=''):                     
                      $country_code=trim($ipinfo['ip_info'][$ip]['country_code']);
                    else:
                        $country_code='N/A';
                    endif;
                else:    
                  $country_code='N/A';  
                endif; 
                
                if (array_key_exists('state',$ipinfo['ip_info'][$ip])):
                    if(trim($ipinfo['ip_info'][$ip]['state']) !=''):                     
                        $state=trim($ipinfo['ip_info'][$ip]['state']);
                    else:
                        $state='N/A';
                    endif;
                else:    
                  $state='N/A';  
                endif; 
                
                if (array_key_exists('city',$ipinfo['ip_info'][$ip])):
                    if(trim($ipinfo['ip_info'][$ip]['city']) !=''):                     
                      $city=trim($ipinfo['ip_info'][$ip]['city']);
                    else:
                        $city='N/A';
                    endif;
                else:    
                  $city='N/A';  
                endif; 
                
                $response_data['country']=$country;
                $response_data['country_code']=$country_code;
                $response_data['state']=$state;
                $response_data['city']=$city;
                return $response_data;
            endif;
           
        else:    
            return FALSE; 
        endif; 
    }
    
    
    
    /**
     * To Get details of the Phone Number.
     * @param  country	Recipient country dialing code	1 for USA , 91 for India etc..
     * @param  number	Phone number	9999999999
     * @param  force_fetch	Fetch from provider, even we have performed same request with-in stipulated time (Y,N) - Yes or No	N [ if nothing passed default will be No]
     */
    
    public function getNumberInfo($callarray=null)
    {       
        
        $jsonencoded_data=  json_encode($callarray);
        $data = array("apiKey"=>$this->apikey,"data"=>$jsonencoded_data);  
        $encoded_response= $this->CallAPI($this->url.'numberLookup',$data); //in response you will get jSon data  
        $apiresponse=json_decode($encoded_response);
        $response['post_url']=$this->url.'numberLookup';
        $response['post_endpoint']='numberLookup';
        $response['post_data']=$data;        
        $response['api_response']=$apiresponse;
        $response['api_status']=$apiresponse->response;
        $response['api_message']=$apiresponse->message;
        return $response;
    }
    
    
    /**
     *  This end-point enables you get the Credit Information of the user. 
     * 
     */
    
    public function myCreditStatus()
    {       
        
        $data = array("apiKey"=>$this->apikey);  
        $encoded_response= $this->CallAPI($this->url.'getCreditStatus',$data); //in response you will get jSon data  
        $apiresponse=json_decode($encoded_response);
        $response['post_url']=$this->url.'getCreditStatus';
        $response['post_endpoint']='getCreditStatus';
        $response['post_data']=$data;        
        $response['api_response']=$apiresponse;
        $response['api_status']=$apiresponse->response;
        $response['api_message']=$apiresponse->message;
        return $response;
    }
    
    
    /**
     * Get Credit Transaction History
     * This end-point enables you to Get Credit History.
     */
     
    public function myCreditTransactions($callarray=null)
    {       
        $mycallarray['request_type']=$callarray['search_type'];
        $mycallarray['count']=$callarray['records'];
        $mycallarray['start_date']=$callarray['start_date'];
        $mycallarray['end_date']=$callarray['end_date'];
         
        $jsonencoded_data=  json_encode($mycallarray);
        $data = array("apiKey"=>$this->apikey,"data"=>$jsonencoded_data);      
        $encoded_response= $this->CallAPI($this->url.'getCreditHistory',$data); //in response you will get jSon data  
        $apiresponse=json_decode($encoded_response);
        $response['post_url']=$this->url.'getCreditHistory';
        $response['post_endpoint']='getCreditHistory';
        $response['post_data']=$data;        
        $response['api_response']=$apiresponse;
        $response['api_status']=$apiresponse->response;
        $response['api_message']=$apiresponse->message;
        return $response;
    }
    
    /**
     *  DigitalAPI offers a simple way to keep track of your API usages and conversations. You can access your usage / conversion data through bellow HTTP requests.
    *There will be 3 types of report format    
    * 1- Get the status of SMS(s) sent //Docs: https://www.digitalapi.com/api/v1/docs#report-sms
    * 2- Get the status of Voice Call(s) //Docs: https://www.digitalapi.com/api/v1/docs#report-call
    * 3- Get the status of Email(s) //Docs: https://www.digitalapi.com/api/v1/docs#report-email
    * For multiple status search, Digital API provides a single call environment
    * You can query up to 100 message id's at a time
     */
    public function getReport($reportType,$messageId=null)
    {
        
        if($reportType):
            if($messageId!=''):
                $jsonencoded_data=  json_encode($messageId); 
            endif;
            
            switch ($reportType):
                    case 'usage':                        
                                $data = array("apiKey"=>$this->apikey);  
                                $encoded_response= $this->CallAPI($this->url.'getUsage',$data);
                                $response['post_url']=$this->url.'getUsage';
                                $response['post_endpoint']='getUsage';
                                 $response['post_data']=$data;      
                                break;
                    case 'sms':
                                $data = array("apiKey"=>$this->apikey,"data"=>$jsonencoded_data);      
                                $encoded_response= $this->CallAPI($this->url.'getMessageStatus',$data);
                                $response['post_url']=$this->url.'getMessageStatus';
                                $response['post_endpoint']='getMessageStatus';
                                 $response['post_data']=$data;      
                                break;
                    case 'call':
                                $data = array("apiKey"=>$this->apikey,"data"=>$jsonencoded_data);       
                                $encoded_response= $this->CallAPI($this->url.'getVoiceStatus',$data);
                                $response['post_url']=$this->url.'getVoiceStatus';
                                $response['post_endpoint']='getVoiceStatus';
                                 $response['post_data']=$data;      
                                break;        
                    case 'email':
                                $data = array("apiKey"=>$this->apikey,"data"=>$jsonencoded_data);     
                                $encoded_response= $this->CallAPI($this->url.'getEmailStatus',$data);
                                $response['post_url']=$this->url.'getEmailStatus';
                                $response['post_endpoint']='getEmailStatus';
                                 $response['post_data']=$data;      
                                break;
            endswitch;
            $apiresponse=json_decode($encoded_response);             
            $response['api_response']=$apiresponse;
            $response['api_status']=$apiresponse->response;
            $response['api_message']=$apiresponse->message;            
        else:    
            $response['post_url']='';
            $response['post_endpoint']='getReport';
            $response['post_data']='';        
            $response['api_response']='';
            $response['api_status']=400;
            $response['api_message']='Please define report type';
        endif;
        return $response;
    }
    
    
    
   
    /**
     * @Description: Use to initiate cURL request to digital API 
     * @Parameter $url : URL TO send request
     * @Parameter $data: Any parameter to pass to url , it must be an array
     * @Parameter $method: HTTP request mode // Keep it empty in call to set default a POST
     * @returns : Json string, which contains API response with a standart HTTP status code  in name of parameter Response.     
     */
    public function CallAPI($url,$data = false,$method='POST')
    {       
        $curl = curl_init();
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    
}
