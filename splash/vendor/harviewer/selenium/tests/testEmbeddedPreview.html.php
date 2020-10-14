<?php
require_once("config.php");
$url = $harviewer_base;
?>

<!doctype html>
<html>
<head>
  <title>Test Case for HAR Viewer</title>
</head>
<body>

<div id="preview1" class="har" data-har="<?php echo $test_base.'tests/hars/1.har' ?>"></div>

<br/>

<div id="preview2" class="har" data-har="<?php echo $test_base.'tests/hars/2.har' ?>"
    height="50px" width="400px" expand="false"></div>

<br/>

<div id="preview3" class="har" data-har="<?php echo $test_base.'tests/hars/testLoad1.harp' ?>"
                               data-callback="callback_testLoad1"></div>

<script>
(function() {
    var har = document.createElement("script");
    har.src = "<?php echo $harviewer_base ?>har.js";
    har.setAttribute("id", "har");
    har.setAttribute("async", "true");
    document.documentElement.firstChild.appendChild(har);
})();
</script>

</body>
</html>

