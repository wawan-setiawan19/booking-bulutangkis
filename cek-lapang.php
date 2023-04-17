<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cek Ketersediaan Lapangan Bulutangkis</title>
  <!-- link stylesheet bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="my-5">Cek Ketersediaan Lapangan Bulutangkis</h1>
    <form>
      <div class="form-group">
        <label for="tanggal">Tanggal:</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
      </div>
      <button type="button" class="btn btn-primary" onclick="loadTable()">Cek Ketersediaan</button>
    </form>

    <div class="table-container"></div>
  </div>
  <!-- link script bootstrap -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script>
    const loadTable = () =>{
        const tanggal = document.querySelector('#tanggal').value
        console.log(tanggal);
        var xmlHttpReq = new XMLHttpRequest();
        xmlHttpReq.onreadystatechange = function(){
          console.log(this.status);
            if(this.readyState == 4 && this.status == 200){
              console.log(this.responseText);
                const tableContainer = document.querySelector('.table-container')
                tableContainer.innerHTML = this.responseText;
            }
        }

        xmlHttpReq.open("GET", `get-lapangan.php?tanggal=${tanggal}`)
        xmlHttpReq.send()
    }
  </script>
</body>
</html>
