<?php

session_start();

if(isset($_SESSION['transaction_hash'])){
  $transaction_hash = $_SESSION['transaction_hash'];
}

include("db.php");

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title>OneVote - One Person One Vote</title>
    <link rel="icon" href="img/icon.png">

  </head>

    <body>

<div class="container-fluid">
  <div class="row">
    
    <div class="col-md-3"></div>

    <div class="col-md-6">

      <h1 id="electionName" align="center" style="margin-top: 70px; "></h1>
      <p id ="hash" style="color: white;"><?php echo $transaction_hash; ?></p><br>


      <!-- Nav pills -->
      <ul class="nav nav-pills nav-fill nav-justified" role="tablist" style="align-content: center;">
        <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#posts">Posts</a> </li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#candidates">Candidates</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#voters">Voters</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div id="posts" class="container tab-pane active "><br></div>
        <div id="candidates" class="container tab-pane fade"><br></div>
        <div id="voters" class="container tab-pane fade"><br></div>
      </div>

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


<script>

  const getElectionDetails = async () => {   
      let url = "http://localhost:3002/get_election_details/" + document.getElementById("hash").innerHTML;
      const response = await fetch(url);
      const myJson = await response.json();
      console.log(myJson);
     document.getElementById("electionName").innerHTML = myJson.election_name + " Election";

     getAllPosts();
      
  }  

  const getAllPosts = async() => {
    
    let url = "http://localhost:3002/get_all_posts/" + document.getElementById("hash").innerHTML;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    
    let posts = myJson.posts;
    let postsLength = posts.length;

    for(var i=0; i<postsLength; i++){
        var list = document.createElement("li");
        list.style.fontSize = "x-large"
        var para = document.createTextNode(posts[i]);
        list.appendChild(para);

        var element = document.getElementById("posts");
        element.appendChild(list);
    }

    getAllCandidates();

  }  

  const getAllCandidates = async() => {
    
    let url = "http://localhost:3002/get_all_candidates/" + document.getElementById("hash").innerHTML;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    let candidates = myJson.candidates;
    let candidatesLength = candidates.length;

    for(var i=0; i<candidatesLength; i++){

      var list = document.createElement("li");
      list.style.fontSize = "x-large"
      var para = document.createTextNode(candidates[i]);
      list.appendChild(para);

      var element = document.getElementById("candidates");
      element.appendChild(list);

    }

    getAllVoters();

  }  


  const getAllVoters = async() => {
    
    let url = "http://localhost:3002/get_all_voters/" + document.getElementById("hash").innerHTML;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    
    let voters = myJson.voters;
    let votersLength = voters.length;

    for(var i=0; i<votersLength; i++){

      var list = document.createElement("li");
      list.style.fontSize = "x-large"
      var para = document.createTextNode(voters[i]);
      list.appendChild(para);

      var element = document.getElementById("voters");
      element.appendChild(list);

    }

  }  

  window.onload = getElectionDetails();
</script>
