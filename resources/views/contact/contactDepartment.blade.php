<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/index_contact">Contact</a>
        <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/index_department">Department</a>
        <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/index_cotdep">ContactDepartment</a>
        <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/index_contactDepartment">Search</a>
        <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/logout">Logout</a>
      </div>
    </div>
  </div>
</nav>
<select name="column" id="column" style="margin-top: 20px;">
    <option value="0">None</option>
    <option value="1">Full Name</option>
    <option value="2">Phone Number</option>
    <option value="3">Department</option>
</select>
<input id="search">
<button  id="search_btn">search</button>
<table style="margin-top: 30px ;" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Department</th>
        </tr>
    </thead>
    <tbody id="tablebody">

    </tbody>
</table>
<br><br>
<button type="button" onclick="tableToCSV()">download CSV</button>

<script>
    
    $("#search_btn").click(function() {
        var column = $("#column").val();
        var search = $("#search").val();
        $.ajax({
            url: '/index_search',
            type: 'GET', 
            data: {
                'column': column,
                'search': search
            },
            success: function(data, status, xhr) {
                $("#tablebody").html(data);
            },
            error: function(jqXhr, textStatus, errorMessage) {}
        });
    });

    function tableToCSV() {

        var csv_data = [];

        var rows = document.getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {

            var cols = rows[i].querySelectorAll('td,th');

            var csvrow = [];
            for (var j = 0; j < cols.length; j++) {


                csvrow.push(cols[j].innerHTML);
            }

            csv_data.push(csvrow.join(","));
        }

        csv_data = csv_data.join('\n');
        downloadCSVFile(csv_data);

    }

    function downloadCSVFile(csv_data) {

        CSVFile = new Blob([csv_data], {
            type: "text/csv"
        });


        var temp_link = document.createElement('a');

        temp_link.download = "result.csv";
        var url = window.URL.createObjectURL(CSVFile);
        temp_link.href = url;

        temp_link.style.display = "none";
        document.body.appendChild(temp_link);


        temp_link.click();
        document.body.removeChild(temp_link);
    }
</script>