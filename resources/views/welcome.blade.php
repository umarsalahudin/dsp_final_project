<!DOCTYPE html>
<html lang="en">
  <head>    
      <title>Drug Search Portal</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;


        }
    </style>    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}">
      <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
  </head>
  <body>
  <div class="wrapper row">
    <div class="Search column column-center">
      <div class="column column-center">
        
        <div class="Search__logo row column-center">
          <span>Drug Search</span>
          <span> Portal</span>
        </div>
      <br>
      <br>
        <div class="container">
          <div class="col-md-12">
            <div class="row">
              
              <div class="Search__input">
                <div claass="col-md-6">
                  <i id="search-icon" class="fa fa-search"></i>
                  <input type="text" id="name" name="name" placeholder="Search Medicines" required>
                </div>
              </div>
              <div class="col-md-6">
                <select name="towns_group" id="towns_group" class="Search__input" required>
                  <i id="search-icon" class="fa fa-search"></i>
                  <option value="9999">Select Towns</option>
                  <option value="Johar town">Johar town</option>
                  <option value="Iqbal town">Iqbal town</option>
                  <option value="Awan town">Awan town</option>
                  <option value="Ravi Town">Ravi Town</option>
                  <option value="Shalimar Town">Shalimar Town</option>
                  <option value="Wagah Town">Wagah Town</option>
                  <option value="Aziz Bhatti Town">Aziz Bhatti Town</option>
                  <option value="Data Ganj Bakhsh Town">Data Ganj Bakhsh Town</option>
                  <option value=" Gulberg Town"> Gulberg Town</option>
                  <option value="Samanabad Town">Samanabad Town</option>
                  <option value="Nishter Town">Nishter Town</option>
                  <option value="Lahore Cantt">Lahore Cantt</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <button id="searchbtn" class="Search__random" name="searchbtn" id="searchbtn">Search</button >
    </div>


 <div class="container" style="display: none;" id="display">
   <div class="Search__logo row column-center" style="font-size: 30px">
        <span>Search&nbsp;</span>
        <span>Results :</span>
      </div>
       <div class="table-responsive">
           <table class="table" id="table" >
            <thead>
               <tr>
                   <th>Name</th>
                   <th>Quantity</th>
                   <th>Company</th>
                   <th>Price</th>
                   <th>Address</th>
                   <th>Pharmacy</th>
                   <th>Town</th>
                   <th>View Map</th>
               </tr>
             </thead>
                <tbody>
                 <tr class="data">
                </tr>
               </tbody>
          </table>
       </div>
   </div>

  
  


 
   <footer class="column column-center bottom">
        <a href="https://en.wikipedia.org/" target="__blank">Dsp.com</a>
        <a href="about" target="__blank">About Us</a>
    </footer>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvuxh7HFTWHVMIMCQcyWWHFPtNJ21ig1M&libraries=places"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
<script>
$("#searchbtn").click(function() {

  $.ajax({
      type: 'get',
      url: 'result',
      dataType: 'json',
      data: {
        '_token': $('input[name=_token]').val(),
        'name': $('input[name=name]').val(),
        'town': $('select[name=towns_group]').val(),
      },
      success: function(myarray) {
        //console.log(myarray);
     /*   $("#name").autocomplete(myarray);*/
        $('#display').css('display','block');
      
        $('#table').append("<tr id='data' class='data'><td>" + myarray.M.name+"</td><td>"+myarray.M.quantity+"</td><td>"+myarray.M.company+"</td><td>"+myarray.M.price+"</td><td>" + myarray.M.address+"</td><td>" + myarray.T.pharmacy+"</td><td>" + myarray.T.town+"</td><td><button class='Search__random'><a href='TownMap&"+ myarray.T.lng +"&"+  myarray.T.lat+"'>View Map</a></button></td></tr>");


      }
  });
});

</script>
</body>
</html>
