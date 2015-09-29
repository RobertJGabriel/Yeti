$(function () {

    //Loads some events

    $("#search_bar").submit(function () {
        var myParam = location.search.split('apikey=')[1];
        var term = location.search.split('term=')[1];

       ajaxGetRequest( "/yeti/v1/getsearches.json?apikey=" + myParam + "&term=" + term,"");
        return false; // avoid to execute the actual submit of the form.
    });

    $("#deleteButton").click(function () {
        alert('ss');
        ajaxPostRequest("", "/yeti/v1/deleteaccount","");
 
        return false; // avoid to execute the actual submit of the form.
    });


  
    $("#signin").submit(function () {
       ajaxPostRequest($(this), "/yeti/v1/signin","");
        return false; // avoid to execute the actual submit of the form.
    });

    $("#signup").submit(function () {
        ajaxPostRequest($(this), "/yeti/v1/signup","");
        return false; // avoid to execute the actual submit of the form.
    });

      // This is for the personal Settings
    $("#delete_account").submit(function () {
        ajaxPostRequest($(this), "/yeti/v1/deleteaccount",""); // the script where you handle the form input.
        return false; // avoid to execute the actual submit of the form.
    });

    // This is for the personal Settings
    $("#update_account").submit(function () {
        ajaxPostRequest($(this), "/yeti/v1/updateaccount","");
        return false; // avoid to execute the actual submit of the form.
    });

  // This is for the personal Settings
    $("#new_search_settings").submit(function () {
        alert('batman');
        ajaxPostRequest($(this), "/yeti/v1/updateSearchSettings","");
        return false; // avoid to execute the actual submit of the form.
    });


     // This is for the personal Settings
    $("#manualImportSearch").submit(function () {
        alert('batman is cool and this worked ?');
        ajaxPostRequest($(this), "/yeti/v1/manualImportSearch","");
        return false; // avoid to execute the actual submit of the form.
    });

    // This is for the personal Settings
    $("#manualImportEmployee").submit(function () {
        alert('batman is cool and this worked, employyee ?');
        ajaxPostRequest($(this), "/yeti/v1/manualImportEmployee","");
        return false; // avoid to execute the actual submit of the form.
    });


    // Used for checking the url 
    function regexUrlextensioncheck(n) {
    {
        var s = document.URL,
            e = new RegExp(n);
        e.test(s)
    }
    return e.test(s)
    }

    function getTable(){

        
    }




    var el = document.getElementById("plusInput");
        el.addEventListener("click", createInput);


    function createInput(){

        var div = document.createElement("div");
            div.setAttribute("class", "form-group");

        var input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("class", "form-control floating-label");
            input.setAttribute("name", "information[]");
            input.setAttribute("placeholder", "Something Extra");

          
        div.appendChild(input);

        document.getElementById("addedInput").appendChild(div);

    }




    function ajaxPostRequest(thisObj,url,message){
        console.log(thisObj);
          $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: thisObj.serialize(), // serializes the form's elements.
            success: function (data) {
                console.log(data);
              
                   alerts(data,message); //Handles log in
                
            }
        });
    }

    function ajaxGetRequest(url,message){
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                console.log('aa' + data);
                jQuery.each(data, function (i, val) {
                    appendSearchResult(val);
                });
            }
        });
    }

    

    function appendSearchResult(val) {
        var ul = document.getElementById("popluarSearches");
        var li = document.createElement("li");
        li.appendChild(document.createTextNode(val['description']));
        ul.appendChild(li);








    }


    function createSearchResult(){
 $("#webresults > *").remove();

var test  = document.getElementById('webresults');

    var div = document.createElement("div");
        div.setAttribute("class", "panel panel-success");
        div.setAttribute("role", "alert");
        div.setAttribute("id", "");
        
    var div2 = document.createElement("div");
        div2.setAttribute("class", "panel-heading");
      

        div.appendChild(div2);

    var div3 = document.createElement("h3");
        div3.setAttribute("class", "panel-title");
         div3.innerHTML = 'message';

        div2.appendChild(div3);

       var div4 = document.createElement("div");
        div4.setAttribute("class", "panel-body");
          div4.innerHTML = 'message';


        div.appendChild(div4);

 test.appendChild(div);



    }

    function alerts(status, message) {
  
        $("#alert > *").remove();
        
        switch (status) {
        case "true":
            createAlertDiv("Awesome, Hold on two seconds", "success");
            setTimeout(redirect, 2000);
            break;
        case "error":
            createAlertDiv("Oh snap something is wrong ", "danger");
            break;
        case "passwordchanged":
            createAlertDiv("password Changed", "success");
            break;
        }
    }





    function createAlertDiv(message,type){
        
        var div = document.createElement("div");
            div.setAttribute("class", "alert alert-dismissable alert-" + type);
            div.setAttribute("role", "alert");
            div.setAttribute("id", "alertDiv");
            div.innerHTML = message;
        
        var button = document.createElement("button");
            button.setAttribute("type", "button");
            button.setAttribute("class", "close");
            button.setAttribute("data-dismiss", "alert");
            button.innerHTML = "x";
            div.appendChild(button);

        document.getElementById("alerts").appendChild(div);
    }

    function redirect() {
        window.location = "";
    }


});
