<!DOCTYPE html>
<html lang="en">
<head>
  <title>AJAX Dinamically Allocated</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2 class="text-center">AJAX Dinamically Allocated into Database</h2>

  <form id="dynamically_allocated_form" name="dynamically_allocated_form" data-parsley-validate class="form-horizontal form-label-left">
    
    <!-- count row counter and total row name counter -->
    <input type="hidden" value="1" id="row-counter" name="row-counter" class="form-control col-md-7 col-xs-12">
    <input type="hidden" value="1" id="row-name-counter" name="row-name-counter" class="form-control col-md-7 col-xs-12">

    <div id="first_portion">
    		<div class="form-group">
          	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> User Name 1</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              	<input type="text" id="name1" name="name1" class="name_class form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div id="dynamically_allocated" style="margin-bottom: 20px;">
        </div>

        <button type='button' style="margin-left: 50px; margin-bottom: 20px;" class="btn-xs btn-success" id='add_row' value='' style="margin-top: 3px;" onclick=''>Add Row</button>

        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="button" name="submit" id="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
    </div>
    
  </form>
</div>

<script type="text/javascript">
	
	var counter = 1;
    var name_counter = 1;

    function addCounter()
    {
      counter = counter + 1;
      name_counter = name_counter + 1; 
      document.getElementById('row-counter').value = counter;
      document.getElementById('row-name-counter').value = name_counter;  
    }

    function removeCounter()
    {
      counter = counter - 1;
      document.getElementById('row-counter').value = counter;
    }

    $(document).ready(function() 
    {

      //dynamically added selects
      $("#add_row").on("click", function() 
      {
          addCounter();

          var dynamically_created_dropzone = $('<div class="form-group" id="'+counter+'">'
                                              +'<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first"> User Name '+counter+'</label>'
                                              +'<div class="col-md-8 col-sm-8 col-xs-12">'
                                              +'<input type="text" id="name'+counter+'" name="name'+counter+'" class="name_class form-control col-md-7 col-xs-12">'
                                              +'</div>'
                                              +'<div class="col-md-1 col-sm-1 col-xs-2">'
                                              +' <button type="button" class="btn-xs btn-danger btn_remove" id="'+counter+'" onclick="rmv_row(this.id);">X</button>'
                                              +'</div>'
                                              +'</div>');

          $("#dynamically_allocated").append(dynamically_created_dropzone);
        });

    });

  function rmv_row(row_id)
  {
      alert("Remove row: "+row_id);
      $("#"+row_id).remove();
      removeCounter();
  }


  //for database connection
  $('#submit').click(function()
      {
          var row_counter = document.getElementById("row-counter").value;
          var name_counter = document.getElementById("row-name-counter").value;

            var formdata = new FormData(document.getElementById('dynamically_allocated_form'));

            for (var i = 1; i <= name_counter; i++) 
            {
                if(document.getElementsByName("name"+i)[0])
                {
                    formdata.append('name'+i,document.getElementsByName("name"+i)[0].value);
                }
            }

            $.ajax(
            {
              type: "POST",
              url: "data_saving.php",
              data: formdata,
              processData: false,
              contentType: false,
              error: function(jqXHR, textStatus, errorMessage) 
              {
                  alert(errorMessage);
              },
              success: function(data) 
              {
                alert(data);
                window.location = 'index.php';
              } 
            });
          
      });

</script>

</body>
</html>
