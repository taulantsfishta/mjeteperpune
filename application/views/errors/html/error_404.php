<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

/* Selection Styles */
::selection { background-color: #ff6f61; color: #fff; }
::-moz-selection { background-color: #ff6f61; color: #fff; }

/* Reset some default styles */
body {
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: #333;
}

/* Container Styling */
#container {
    max-width: 800px;
    margin: 80px auto;
    padding: 40px 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease;
}

#container:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

/* Heading Styles */
h1 {
    font-size: 2em;
    color: #444;
    margin-bottom: 20px;
    border-bottom: 2px solid #ececec;
    padding-bottom: 10px;
}

h1 span {
    font-weight: normal;
}

/* Message Styles */
.message {
    font-size: 1.1em;
    color: #666;
}

/* Link Styles */
a {
    color: #007bff;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}

/* Code block styles */
code {
    font-family: 'Courier New', Courier, monospace;
    background-color: #f8f8f8;
    border: 1px solid #d0d0d0;
    border-radius: 4px;
    padding: 10px 15px;
    display: block;
    margin-top: 20px;
    font-size: 14px;
    color: #d14;
}

/* Responsive Typography */
@media (max-width: 600px) {
    body {
        font-size: 14px;
    }
    #container {
        padding: 20px 15px;
        margin: 40px auto;
    }
    h1 {
        font-size: 1.5em;
    }
}
</style>

</head>
<body>
    <div id="container">
        <h1><?php echo $heading; ?></h1>
        <p class="message"><?php echo $message; ?></p>
		<p><a href=<?php echo base_url().'admin/dashboard'; ?>>KTHEHU</a></p>
    </div>
</body>
</html>
