

var apiCalls = {
  amoutofUsers: "/yeti/v1/getStates.json"
};

for (var key in apiCalls)
{
  $.ajax(
  {
    type: 'GET',
    url: apiCalls[key],
    }).done(function(data)
    {
      addEvent(data)
  });
}
function addEvent(data)
{
  var json = JSON.parse(data);
  document.getElementById('numberofSearches').innerHTML = json['numberofSearches'];
    document.getElementById('amoutofUsers').innerHTML = json['amoutofUsers'];

}