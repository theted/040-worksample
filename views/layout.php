<?php

class Layout
{
    public function render($data, $title = "040 worksample")
    {
        echo '<!DOCTYPE html>
					<html>
						<head>
							<meta charset="utf-8">
							<title>' . $title . '</title>
							<link rel="stylesheet" href="/dist/app1.0.0.css" />
							<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
						</head>
						<body>
							<div id="app">' . $data . '</div>
							<script src="/src/js/app.js"></script>
						</body>
					</html>
			';
    }
}
