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

    <title>OneVote - Election Home</title> 
  </head>

    <body>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
  <h1 id="electionName" align="center" style="margin-top: 70px; "></h1>
   <p id ="hash" style="color: white;"><?php echo $transaction_hash; ?></p>
  <br>


  <!-- Nav pills -->
  <ul class="nav nav-pills" role="tablist" style="align-content: center;">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#posts">Posts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#candidates">Candidates</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#voters">Voters</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" >
    <div id="posts" class="container tab-pane active"><br>  
      <p>The election has the following posts :</p>
    </div>
    <div id="candidates" class="container tab-pane fade"><br>
      <p>The election has the following candidate :</p>
    </div>
    <div id="voters" class="container tab-pane fade"><br>
      <p>The election has the following voters :</p>
    </div>
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
        var para = document.createElement("li");
        var node = document.createTextNode(posts[i]);
        para.appendChild(node);

        var element = document.getElementById("posts");
        element.appendChild(para);
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
        var para = document.createElement("li");
        var node = document.createTextNode(candidates[i]);
        para.appendChild(node);

        var element = document.getElementById("candidates");
        element.appendChild(para);
    }

    getAllVoters();

  }  


     const getAllVoters = async() => {
    let url = "http://localhost:3002/get_all_voters/" + document.getElementById("hash").innerHTML;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    
    let voters = myJson.voters;
    let voterslength = voters.length;

    for(var i=0; i<voterslength; i++){
        var para = document.createElement("li");
        var node = document.createTextNode(voters[i]);
        para.appendChild(node);

        var element = document.getElementById("voters");
        element.appendChild(para);
    }

   // getPostCandidates();

  }  



  //   const getPostCandidates = async() => {
  //   let url = "http://localhost:3002/get_all_posts/" + document.getElementById("hash").innerHTML;
  //   let response = await fetch(url);
  //   let myJson = await response.json();
  //   console.log(myJson);
    
  //   let posts = myJson.posts;
  //   let postsLength = posts.length;

  //   let url1 = "http://localhost:3002/get_all_candidates/" + document.getElementById("hash").innerHTML;
  //   let response1 = await fetch(url1);
  //   let myJson1 = await response1.json();
  //   console.log(myJson1);
    
  //   let candidates = myJson1.candidates;
  //   let candidatesLength = candidates.length;




  //   for(var i=0; i<postsLength; i++){
  //       var para = document.createElement("h5");
  //       var node = document.createTextNode(posts[i]);
  //       para.appendChild(node);
  //       para.id =  "postItem";

  //       for(var j=i; j<candidatesLength; j++){
  //         var para1 = document.createElement("h6");
  //         var node1 = document.createTextNode(candidates[j]);
  //         para1.appendChild(node1);

  //         console.log(para1)

  //         // var element1 = document.getElementById("postItem");
  //         // element1.appendChild(para1);
  //       }

  //       var element = document.getElementById("postCandidates");
  //       element.appendChild(para);
  //   }



  // }  








  window.onload = getElectionDetails();
</script>
