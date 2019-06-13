


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
          
          <h1 id="electionName" align="center" style="margin-top: 70px;"></h1>
          
          <h2 id="postName" align="center" style="margin-top: 50px;"></h2>
        
          <ul id="candidatesList" class="list-group" style="margin-top: 20px;"></ul>
          
          <button type="submit" class="btn btn-primary btn-lg btn-block btn btn-success" name="nextButton" id="nextButton" onClick="checkPosts()">Vote</button>
          
          

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

  var postId = 0;
  var transaction_hash = localStorage.getItem("transaction_hash");
  console.log(transaction_hash);

  const checkPosts = async () => {

    let url = "http://localhost:3002/get_all_posts/" + transaction_hash;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    let posts = myJson.posts;
    let postsLength = posts.length;

    if(postId == postsLength){

      window.location.href = "http://localhost/onevoteHome/details.php";

    } else {

      getElectionDetails();

    }
  
  }

  const getElectionDetails = async () => {

    var element = document.getElementById("candidatesList");
    element.innerHTML = '';

    let url = "http://localhost:3002/get_election_details/" + transaction_hash;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    document.getElementById("electionName").innerHTML = myJson.election_name + " Election";

    getPosts();
      
  }

  const getPosts = async() => {
    
    let url = "http://localhost:3002/get_all_posts/" + transaction_hash;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    let posts = myJson.posts;
    document.getElementById("postName").innerHTML = posts[postId];

    getPostCandidates();

  }  

  const getPostCandidates = async() => {
    
    let url = "http://localhost:3002/get_post_candidates/" + transaction_hash + "/" + postId;
    const response = await fetch(url);
    const myJson = await response.json();
    console.log(myJson);
    let candidates = myJson.candidates;
    let candidatesLength = candidates.length;

    for(var i=0; i<candidatesLength; i++){

      var list = document.createElement("li");
      list.classList.add("list-group-item");

      var label = document.createElement("label");
      
      var radio = document.createElement("input");
      radio.type = "radio";
      radio.name = "post" + postId;
      radio.value = candidates[i];
      radio.required;

      var text = document.createTextNode(" " + candidates[i]);
      //text.style.paddingLeft = "10px";

      var element = document.getElementById("candidatesList");

      label.appendChild(radio);
      label.appendChild(text);
      list.appendChild(label);
      element.appendChild(list);

    }

    incrementPostId();

  }

  function incrementPostId(){
    postId++;
  }

  window.onload = checkPosts();

</script>
