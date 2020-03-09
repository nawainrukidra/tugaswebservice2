<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Tambah Data Jumlah Kendaraan Yang Melintas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container mt-4 ml-7 mr-7">
            <h2 class="text-center mb-4">DATA JUMLAH KENDARAAN YANG MELINTAS</h2>
           
            <div class="row text-center">
              <div class="col-sm"><strong>Nama:</strong> Ardi Kurniawan</div>
              <div class="col-sm"><strong>NIM:</strong> 17.01.53.0071</div>
            </div>
           
            <div class="notif text-center mt-4 mb-2"></div>
              <div class="form-group">
                <label for="jalan">Nama Jalan</label>
                <input type="text" class="form-control" id="jalan" aria-describedby="Nama Jalan" name="jalan">
                <small id="jalan" class="form-text text-muted">Masukkan asset game.</small>
              </div>
              <!---->
              <div class="form-group">
                <label for="jumlah">Jumlah Kendaraan Yang Melintas / Hari</label>
                <input type="text" class="form-control" id="jumlah" aria-describedby="Jumlah Kendaran" name="jalan">
                <small id="jalan" class="form-text text-muted">Masukkan Diskripsi Asset.</small>
              </div>
            <!---->
            <button type="submit" class="btn btn-primary masukkan">Submit <span class="spin_"></span></button>
            <!---->
             
        </div>
        <div class="container mt-4">
            <table class="table"><thead class="thead-dark">
            <tr>
              <th scope="col">id</th>
              <th scope="col">Nama Jalan</th>
              <th scope="col">Jumlah Kendaraan Yang Melintas \ Hari</th>
            </tr>
          </thead>
          <tbody class="show_data">
          </tbody>
          </table>
        </div>
        <script>
            function get_data(){
                $.ajax({
                    url: 'https://childishchildish.000webhostapp.com/tambahjson.php',
                    method: "POST",
                    data: {show: 2},
                    dataType: "JSON",
                    success: function(data){
                        $('.show_data').html("");
                        if(data['status'] == 1){
                            for(var i=0;i<data['data'].length;i++){

                                $('.show_data').append('<tr><th scope="row">'+(i+1)+'</th><td>'+data['data'][i][1]+'</td><td>'+data['data'][i][2]+'</td></tr>');
                            }
                        }else{
                            $('.show_data').html("Error Get Data.");
                        }
                    },
                    error: function(){
                        $('.show_data').html("");
                        $('.show_data').html("Error Get Data.");
                    },
                    beforeSend: function(){
                        $('.show_data').html('<tr><th scope="row"></th><td></td><td><span class="spinner-border"></span></td><td></td></tr>');
                    }
                })
            }
            $(document).ready(function(){
               
                get_data();
               
                $('.masukkan').click(function(){
                    var jalan = $('#jalan').val();
                    var jumlah = $('#jumlah').val();

                        $.ajax({
                            url: 'https://childishchildish.000webhostapp.com/tambahjson.php',
                            method: "POST",
                            data: {jalan: jalan, jumlah:jumlah, show:1},
                            dataType: "JSON",
                            success: function(data){
                                setTimeout(function(){
                                    $('.spin_').removeClass('spinner-border spinner-border-sm');
                                    $('.masukkan').prop("disabled", false);
                                }, 300);
                                if(data['status']){
                                    get_data();
                                    $('.notif').html('<span class="text-success">'+data['msg']+'</span>');
                                }else{
                                    $('.notif').html('<span class="text-danger">'+data['msg']+'</span>');
                                }
                            },
                            error: function(){
                                setTimeout(function(){
                                    $('.spin_').removeClass('spinner-border spinner-border-sm');
                                    $('.masukkan').prop("disabled", false);
                                }, 300);
                                $('.notif').html('<span class="text-danger">Error Masukkan Data!!</span>');
                            },
                            beforeSend: function(){
                                $('.masukkan').prop("disabled", true);
                                $('.spin_').addClass('spinner-border spinner-border-sm');
                            }
                        })

                })
            })
        </script>
    </body>
</html>