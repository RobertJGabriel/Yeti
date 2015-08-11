$.ajax(
   {
      type:'GET',
      url:'/yeti/v1/getusers.json',

      success: function(data){
        addEvent(data,'amoutofUsers')
      }
   }
);


function addEvent(data,element)
{
alert(data.numberofUsers);
	var json = JSON.parse(data);
			
	alert(json); //mkyong
	var obj = JSON.parse(data);
	document.getElementById(element).innerHTML = data["numberofUsers"];
}