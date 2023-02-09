<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";


$sql = "SELECT * FROM qa LIMIT 1";
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="generator" content="AlterVista - Editor HTML"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <title></title>
</head>
<body>
<b>Your API key (remains hidden to me): </b><input id="userapikey" value="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"/>

<div id="divchatbot" style='border-style: solid; position: fixed; bottom: 10px; left:2%; width:96%; text-align: center; z-index: 1000; background-color: rgba(200, 200, 200, 1); visibility: visible; height: 200px; overflow-y : scroll; '>
  <p align=left>
  <button type="button" onclick="chatbotprocessinput()" title="" id="chatbotbutton"><font size=4>Send</font></button>
  <button type="button" onclick="document.getElementById('divchatbot').style.visibility = 'hidden' ; document.getElementById('divchatbotoff').style.visibility = 'visible'" title="" id="chatbotbutton"><font size=4>Close</font></button>
  <input id="chatuserinput" value="What is covrize?" style="font-size:20px;" placeholder="Type here to chat with bot" onkeydown="if (event.keyCode == 13) { chatbotprocessinput() }  ;  if (event.keyCode == 38) { repeatuser() }"></input>
  </p>
  <p id="chatlog" align=left style="width:95%; word-wrap:break-word;"><br><b>Assistant:</b> Hello,</p>
</div>

<script>

var prompt = '<?php   if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"].$row["ans"];
    // echo "id: " . $row["id"]. " - Name: " . $row["que"]. " " . htmlspecialchars($row["ans"],ENT_QUOTES);
    // echo "id: " . $row["id"]. " - Name: " . $row["que"]. " " .  addslashes($row["ans"])."<br>" ;

  }
} else {
  echo "0 results";
}
$conn->close();  ?>'

var chatbotprocessinput = function(){
  var apikey = "Bearer " + document.getElementById("userapikey").value
  theprompt = prompt + "Q: " + document.getElementById("chatuserinput").value
  document.getElementById("chatuserinput").value = ""
  document.getElementById("chatlog").innerHTML = "Thinking..."
  $.ajax({
    url: "openai-api.php",
    type: "POST",
    data: {prompt:theprompt,apikey:apikey},
    }).done(function(data) {
      var textupdate = data.replace(prompt,"").replace("https://api.openai.com/v1/engines/text-davinci-002/completions","")
      document.getElementById("chatlog").innerHTML = textupdate.replace(/Q: /g,"<br><b>Visitor: </b>").replace(/A: /g,"<br><b>Assistant: </b>")
      prompt = data.replace("https://api.openai.com/v1/engines/text-davinci-002/completions","")
      console.log("------\n" + prompt)
  });
}

</script>

</body>
</html>
