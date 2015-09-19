$(function () {


    var url = '';
    $("#signin").submit(function () {
        url = "/yeti/v1/signin"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: $("#signin").serialize(), // serializes the form's elements.
            success: function (data) {
                alerts(data, 'Logging you in'); //Handles log in
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });


    $.ajax({
        url: '/yeti/v1/getPopluarSearches.json',
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            jQuery.each(data, function (i, val) {
                appendSearchResult(val);
            });
        }
    });


    function appendSearchResult(val) {
        var ul = document.getElementById("popluarSearches");
        var li = document.createElement("li");
        li.appendChild(document.createTextNode(val['search_term']));
        ul.appendChild(li);
    }



    // This is for the personal Settings
    $("#signup").submit(function () {
        var url = "/yeti/v1/signup"; // the script where you handle the form input.
        var signupLocation = document.querySelectorAll('#signUp > input[name="displayAlertLocation"]').innerHTML;
       console.log(signupLocation);
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: $("#signup").serialize(), // serializes the form's elements.
            success: function (data) {
                console.log(data);
                alerts(data, 'Account created'); // show response from the php script.
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });



    // This is for the personal Settings
    $("#search_bar").submit(function () {
        var url = "index.php?action=webresults"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: $("#search_bar").serialize(), // serializes the form's elements.
            success: function (data) {
                console.log(data);
                myFunction(data);
                $.getScript(
                    "http://localhost/yeti/assests/third-party/instagram/instagram.js",
                    function () {
                        grabImages(jQuery("#search_bar_input").val(), 4,
                            access_parameters);
                    });
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });



    // This is for the personal Settings
    $("#search_bar2").submit(function () {
        alert('test');
        var url = "index.php?q=" + jQuery("#search_bar_input").val(); // the script where you handle the form input.
        window.location = url;
        return false; // avoid to execute the actual submit of the form.
    });




    // This is for the personal Settings
    $("#delete_account").submit(function () {
        var url = "index.php?action=delete_account"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: $("#delete_account").serialize(), // serializes the form's elements.
            success: function (data) {
                redirect();
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });


    // This is for the personal Settings
    $("#update_account").submit(function () {
        var url = "index.php?action=update_account"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: $("#update_account").serialize(), // serializes the form's elements.
            success: function (data) {
                alerts(data, 'Settings Changed '); // show response from the php script.
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });


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
