$(function() {
    //createCode();
    var myParam = getParameterByName('apikey');
    var term = getParameterByName('term');
    if (myParam !== '') {
        $("#webresults > *").remove();
        ajaxGetRequest("/v1/getsearches.json?apikey=" + myParam + "&term=" + term ,"");
    }
    console.log('sss');
    ajaxupdateRequest('/v1/me.json','') ;

    getCodeLinkRequest('/v1/getCode','');


    $("#search_bar").submit(function() {
        var myParam = getParameterByName('apikey');
        var term = getParameterByName('term');
        var searchTerm = document.getElementById('search_bar_input').value;
        window.location = "/search?apikey=" + myParam + "&term=" + searchTerm + "";
        return false; // avoid to execute the actual submit of the form.
    });

//Hack again but poor coding i know :'('
    function getCodeLinkRequest(urls, message) {

        $.ajax({
            url: urls,
            type: "GET",
            success: function(data) {

            document.getElementById("codeiscool").value = data;
            
            }, error: function(data) {

            document.getElementById("codeiscool").value = data;
      
        }
        });
    }



    $("#updateAccount").submit(function() {
    ajaxPostRequest($(this), "/v1/updateAccount", "Account Updated");
    return false; // avoid to execute the actual submit of the form.
    });


    function appendUpdate(val) {
     
       document.getElementById("firstNameUpdate").value = val['firstName'];
       document.getElementById("lastNameUpdate").value = val['lastname'];
       document.getElementById("emailUpdate").value = val['email'];

    }
    function ajaxupdateRequest(urls, message) {

        $.ajax({
            url: urls,
            type: "GET",
            dataType: "json",
            success: function(data) {
           
                console.log(data);
                jQuery.each(data, function(i, val) {
                     appendUpdate(val) ;
               
                });
            
            }, error: function(data) {
          console.log(data);
        }
        });
    }

    $("#signin").submit(function() {
        ajaxPostRequest($(this), "/v1/signin", "true");
        return false; // avoid to execute the actual submit of the form.
    });
    
    $("#signup").submit(function() {
        ajaxPostRequest($(this), "/v1/signup", "true");
        return false; // avoid to execute the actual submit of the form.
    });
    
    
    
    // This is for the personal Settings
    $("#new_search_settings").submit(function() {
        alert('batman');
        ajaxPostRequest($(this), "/v1/updateSearchSettings", "");
        return false; // avoid to execute the actual submit of the form.
    });
    
    // This is for the personal Settings
    $("#manualImportSearch").submit(function() {

      
        ajaxPostRequest($(this), "/v1/manualImportSearch", "true");

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

    function getTable() {}

        var el = document.getElementById("plusInput");
            el.addEventListener("click", createInput);

    function createInput() {
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

    function ajaxPostRequest(thisObj, url, message) {
        console.log(thisObj);
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: thisObj.serialize(), // serializes the form's elements.
            success: function(data) {
                console.log(data);
                alerts(data, message); //Handles log in
            }, error: function(data) {
          console.log(data);
        }
        });
    }

    function ajaxGetRequest(urls, message) {
               console.log(urls);
        $.ajax({
            url: urls,
            type: "GET",
            dataType: "json",
            success: function(data) {
           
                console.log(data);
                jQuery.each(data, function(i, val) {
                    console.log('hi');
                    createSearchResult(val);
                });
            
            }, error: function(data) {
    console.log(data);
        }
        });
    }

   

    function createSearchResult(val) {
        console.log( val['title']);
   if ( val['title'] !== "undefined"){

        var test = document.getElementById('webresults');
        var div = document.createElement("div");



        div.setAttribute("class", "panel panel-success");
    
        div.setAttribute("role", "alert");
        div.setAttribute("id", "");
        var a = document.createElement('a');
        var linkText =  document.createElement('p');
        linkText.innerHTML = val['title'];
        a.appendChild(linkText);
        a.title = val['title'];
        a.href = val['url'];
        var div2 = document.createElement("div");
        div2.setAttribute("class", "panel-heading");
        div.appendChild(div2);
        var div3 = document.createElement("h3");
        div3.setAttribute("class", "panel-title");
        div3.appendChild(a);
        div2.appendChild(div3);
        var div4 = document.createElement("div");
        div4.setAttribute("class", "panel-body");
        div4.innerHTML = val['description'];
        div.appendChild(div4);

        var div5 = document.createElement("span");
        div5.setAttribute("class", "label label-info");
        div5.innerHTML = val['search'];
        div.appendChild(div5);

        test.appendChild(div);
    }
    }

    function alerts(status, message) {
        $("#alerts > *").remove();
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
        $('#confirm').modal('show'); 
    }




        function createCode(){
           ajaxGetRequest("/v1/getApiCode.json", "test");
        
        
    }

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    function createAlertDiv(message, type) {
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
