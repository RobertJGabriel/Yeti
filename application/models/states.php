<?php


    // -- Class Name : states
    // -- Purpose : 
    // -- Created On : Genortate the highcharts information from the database. in a json repsonce
    
    class states{
        var $database;
        
        public
        function __construct()   {
            $this->database =  new database();
        }

        public
        function search_chart(){
            $i = 0;
            $result =   $this->database->amount_of_searches();
            while($row = mysqli_fetch_array($result)) {
                echo $row['Number']. "/" . $row['date']. "/" ;
                $i++;
            }

        }

    }

    ?>