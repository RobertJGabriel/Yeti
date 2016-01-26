<?php
    include_once("database.php");
    include_once("application/third-party/twitter/twitter.php");
    // -- Class Name : search
    // -- Purpose : 
    // -- Created On : Api Calls for twitter , google and bing.
    
    class search{
        var $database;
        var $twitter;
        var $acctKey = 'ch5yPPgveyknb+HrsD0Gow1UV5znc7ukV32Kd3WULd4';
        var $rootUri = 'https://api.datamarket.azure.com/Bing/Search';
        var $results = array();
        var $duckduckgoResults;
        var $bingSearchResultsLimit = 5;
        var $images = '';
        var $totalResults = array();


// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
        public  function __construct()   {
            $this->database =  new database();
            $this->twitter =  new twitter();
            //  $this->add_search();
        }


// -- Function Name : add_search
// -- Params : 
// -- Purpose : 
        public function add_search(){
            $search_Term = "cat";
            $this->bing('Web',$search_Term);
            //  $this->duckduckgo($search_Term);
            //  $this->google($search_Term);
            //  $this->database->add_search($search_Term,$_SESSION['ID']);
            $this->displayResults($this->results);
            
            if ($_SESSION['twitter'] === '1'){
                $this->post_twitter();
            }

            print_r($this->totalResults);
        }


// -- Function Name : post_twitter
// -- Params : 
// -- Purpose : 
        public function post_twitter(){
            $this->twitter->postTweet($_POST['search_bar_input']);
        }

// -- Function Name : duckduckgo
// -- Params : $search_Term
// -- Purpose : 
        public function duckduckgo($search_Term){
            $a = array();
            $requestUri = "http://api.duckduckgo.com/?q='$search_Term'&format=json";
            $response = file_get_contents($requestUri, 0);
            // Decode the response. 
            $this->duckduckgoResults = json_decode($response);
            $resultStr = '';
            $title = $this->duckduckgoResults->Heading;
            $url = $this->duckduckgoResults->RelatedTopics[0]->FirstURL;
            $description =$this->duckduckgoResults->RelatedTopics[0]->Text;
            $a['title'] = $title;
            $a['description']= $description;
            $a['url'] = $url;
            $a['search'] =  'duckduckgo' ;
            array_push($a,$a['title']);
            array_push($a,$a['description']);
            array_push($a,$a['url']);
            array_push($a,$a['search']);
            return    $a;
        }


// -- Function Name : google
// -- Params : $search_Term
// -- Purpose : 
        public function google($search_Term){
            $a = array();
            $query = $search_Term;
            $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".$query;
            $body = file_get_contents($url,0);
            $json = json_decode($body);
            $resultStr = '';
            for($x=0;$x<count($json->responseData->results);$x++){
                $a['title'] = $json->responseData->results[$x]->title;
                $a['description']= $json->responseData->results[$x]->content ;
                $a['url'] =     $json->responseData->results[$x]->url ;
                $a['search'] =  'google' ;
                array_push($a,$a['title']);
                array_push($a,$a['description']);
                array_push($a,$a['url']);
                array_push($a,$a['search']);
            }

            return $a;
            //  echo $resultStr;
        }

// -- Function Name : bing
// -- Params : $type,$search_Term
// -- Purpose : 
        public function bing($type,$search_Term){
            // Encode the query and the single quotes that must surround it.
            $query = urlencode("'{$search_Term}'");
            // Get the selected service operation (Web or Image).
            $serviceOp = $type;
            // Construct the full URI for the query.
            $requestUri = "$this->rootUri/$serviceOp?\$format=json&Query='$query'" . "&\$top=" . $this->bingSearchResultsLimit;
            // Encode the credentials and create the stream context.
            $auth = base64_encode("$this->acctKey:$this->acctKey");
            $data = array('http' => array('request_fulluri' => true,'ignore_errors' => true,'header' => "Authorization: Basic $auth"));
            $context = stream_context_create($data);
            // Get the response from Bing.
            $response = file_get_contents($requestUri, 0, $context);
            // Decode the response. 
            $jsonObj = json_decode($response);
            $resultStr = '';
            // Parse each result according to its metadata type. 
            foreach($jsonObj->d->results as $value) {
                switch ($value->__metadata->type) {
                    case 'WebResult':
                        $tempResult = array('title' => $value->Title, 'description' => $value->Description, 'url' => $value->Url, 'engine' => 'bing');
                        array_push($this->totalResults,$tempResult);
                        $resultStr = "
                            <ul class='nav nav-tabs nav-stacked well' >
                                <div class='panel panel-info'>
                                    <div class='panel-heading'>
                                        <h3 class='panel-title'><a href=\"{$value->Url}\">{$value->Title}</a></h3>
                                    </div>
                                <div class='panel-body'>
                                    <h5><a href=\{$value->Url}\">{$value->Title}</a></h5>
                                    <p>{$value->Description}</p>
                                    <span class='label label-info'>Bing</span>  
                                </div>
                                </div>
                            </ul>" ;
                        array_push( $this->results,$resultStr);
                        break;
                }

            }
            // $contents = str_replace('{RESULTS}', $resultStr, $contents);
        }



// -- Function Name : ripResults
// -- Params : 
// -- Purpose : 
        public function ripResults(){
        }


// -- Function Name : manualImportSearch
// -- Params : 
// -- Purpose : 
        public function manualImportSearch()        {
            $title  =   filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $description   =   filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $url_or_link    =   filter_var($_POST['url_or_link'], FILTER_SANITIZE_STRING);
            $information = array("term"=>$title);
            foreach($_POST['information'] as $k=>$scene) {
                array_push($information,$scene);
            }

            $information = json_encode($information);
            $this->database->importSearch($title,$description,$url_or_link,$information,1,$_SESSION["companyId"]);
            return 'true';
        }



// -- Function Name : displayTable
// -- Params : 
// -- Purpose : 
        public function displayTable(){
            $results = $this->database->getSearchResults($_SESSION["companyId"]);
            $count = mysqli_num_rows($results);
            
            if($count===1){
                while($row = $results->fetch_assoc()){
                    $_SESSION["ID"] =  $row['id'];
                    $_SESSION["first_Name"] =  $row['firstName'];
                    $_SESSION["last_Name"] =  $row['lastName'];
                    $_SESSION["website"] =  $row['website'];
                    $_SESSION["email"] =  $row['email'];
                    $_SESSION["twitter"] =  $row['twitter'];
                    $_SESSION["password"] =  $row['password'];
                    $_SESSION["companyId"] =  $row['companyId'];
                }

            }

        }



// -- Function Name : displayResults
// -- Params : $arr
// -- Purpose : 
        public function displayResults($arr){
            shuffle($arr);
            foreach ($arr as &$value) {
                echo $value;
            }

            echo json_encode($this->totalResults);
        }

    }

?>