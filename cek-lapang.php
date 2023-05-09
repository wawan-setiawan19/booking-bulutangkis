  <?php
    session_start();
    require("components/head.php");
    require("components/nav.php");
    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $today = $year . '-' . $month . '-' . $day;
  ?>
  <div class="container">
    <h1 class="my-5">Cek Ketersediaan Lapangan Bulutangkis</h1>
    <form>
      <div class="form-group">
        <label for="tanggal">Tanggal:</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $today ?>" required>
      </div>
      <button type="button" class="btn btn-primary mt-2" onclick="loadTable()">Cek Ketersediaan</button>
    </form>

    <div class="table-container"></div>
  </div>
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
