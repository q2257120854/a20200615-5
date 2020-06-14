<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>404 Page Not Found</title>
<style type="text/css">
#e404-container {
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
	margin:80px auto;
	width:680px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

#e404-container h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

#e404-container p {margin: 12px 15px 12px 15px;}
</style>
</head>
<body>
	<div id="e404-container">
		<h1>404 Page Not Found</h1>
		<p><?php echo $debugmsg; ?></p>
		<p>您尝试访问的页面未找到!</p>
	</div>
</body>
</html>