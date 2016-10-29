<?php
	require_once("config.php");
	function metaDetails(){
		echo '<!DOCTYPE html>
                    <html>
                      <head>
                          <title>Debugger</title>
                              <meta name="viewport" content="width=device-width, initial-scale=1.0">
                              <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
                              <link href="css/main.css" rel="stylesheet" media="screen">';
	}

function AjaxGet() {
  echo <<<CONTENT
    <script>
      function AjaxGet(a, b) {
        console.log(a);
        Req = new XMLHttpRequest();
        Req.onreadystatechange = function()
        { if (Req.readyState == 4) {
            if (Req.status == 200 || Req.status == 304) {
              if (Req.responseText != "failed!") document.getElementById(b).innerHTML = Req.responseText;
              else alert("Failed!");
            } else alert("Failed!");
          }
          }
        Req.open("GET", a, true);
        Req.send();
      }
    </script>
CONTENT;
}
?>