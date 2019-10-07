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
							<a href="/?page=list">List registered users</a>
							<a href="/">Register participant</a>
							<div id="app">' . $data . '</div>
							<script src="/dist/app.js"></script>
						</body>
					</html>
			';
    }
}
