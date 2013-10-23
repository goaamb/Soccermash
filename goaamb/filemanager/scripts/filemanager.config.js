/*---------------------------------------------------------
  Configuration
---------------------------------------------------------*/

// Set this to the server side language you wish to use.
var lang = 'php'; // options: lasso, php, py

// Set this to the directory you wish to manage.
var url = location.href;
url = url.split("/");
url.shift();
url.shift();
var fileRoot = '';
if (url.length > 0) {
	if (url[0] === "localhost") {
		fileRoot = "/idiomas/cmsfiles/";
	} else {
		fileRoot = "/files/";
	}
}

// Show image previews in grid views?
var showThumbs = true;
