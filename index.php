<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>OneVote - One Person One Vote</title>
    <link rel="icon" href="img/icon.png">
  </head>

    <body>

    <div class="container-fluid">
      <div class="row">
        
        <div class="col-md-3"></div>
        <div class="col-md-6">

          <br><br><br><br><br><br><br>
          <p style="text-align: center"><img src="img/logo.png"></p><br>

            <fieldset>
              <legend>Enter provided Transaction Hash to Enter the Election</legend>

              <div class="row">

              <div class="col-md-12">
                <input type="text" class="form-control" placeholder="Enter transaction_hash" id="transaction_hash">
              </div>

            </div>

            </fieldset><br>

            <div class="row">

              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-lg btn-block btn btn-success" onClick="loginElection()">Submit</button>
              </div>

            </div>

          </form>

        </div>

        <div class="col-md-3"></div>

      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  </body>
</html>


<script type="text/javascript">

  const loginElection = async() => {

    var transaction_hash = document.getElementById("transaction_hash").value;
    var public_address = "0x13AB9be743BBBd271Ed766Fe20fc5c4Ed8a64F4C";
    console.log(transaction_hash);
    
    let url = "http://localhost:3002/voter_login/"  + transaction_hash + "/" + public_address;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    
    if(myJson.status){
      localStorage.setItem("transaction_hash", transaction_hash);
      localStorage.setItem("public_address", public_address);
      localStorage.setItem("voter_id", myJson.voter_id);
      window.location.href = 'http://localhost:81/onevoteHome/voting.php';
    } else {
      alert(myJson.msg)
    }

  }

</script>