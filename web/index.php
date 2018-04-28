<?php

// author: Mike Henry, 2018

require('include.php');

//some settings
$random_images = array(
	'http://icons.iconarchive.com/icons/zairaam/bumpy-planets/256/07-jupiter-icon.png',
	'http://www.princeton.edu/~willman/planetary_systems/Sol/Saturn/Saturn.gif',
	'http://www.solstation.com/stars/venus.gif',
	'http://quest.nasa.gov/mars/background/images/mars.gif'
);

$cover_image = 'http://www.lovethispic.com/uploaded_images/20521-Rocky-Beach-Sunset.jpg';

$settings = new DivSettings();

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Mike Henry">
  <title>Three29 Test - Mike Henry</title>
<style>

/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}
</style>
<style>

/* css here */
.divitem {
  height: 25vh;
  transition: all 2s ease;
}
.divitem.toggled {
  width: 100% !important;
}
#div1 {
  width: 25%;
  background-image: url("<?= $cover_image ?>");
  background-position: center center;
  background-size: cover;
}
#div2 {
  width: 75%;
  background-color: orange;
  background-image: url("<?= get_random_image($random_images) ?>");
  background-position: center top;
  background-repeat: no-repeat;
  background-size: 128px;
}
#div3 {
  width: 50%;
  background-color: blue;
}
#div3.toggled {
  background-color: red;
}
#div4 {
  width: 90%;
  background-color: yellow;
  font-size: x-large;
  text-align: center;
}
#div4 .numbers {
  line-height: 2;
}

@media only screen and (max-width : 600px) {
  #div3, #div4 {
    display: none;
  }
}

</style>
<script defer src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script defer src="script.js"></script>
</head>
<body>
<div id="wrapper">
	<div id="div1" class="divitem <?= $settings->get_toggled_class(1) ?>">
	</div>
	<div id="div2" class="divitem <?= $settings->get_toggled_class(2) ?>">
	</div>
	<div id="div3" class="divitem <?= $settings->get_toggled_class(3) ?>">
	</div>
	<div id="div4" class="divitem <?= $settings->get_toggled_class(4) ?>">
    <span class="numbers">
      <?= htmlspecialchars(get_number_string()) ?>
    </span>
	</div>
</div>
</body>
</html>
