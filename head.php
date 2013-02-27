<?php 
  $devServerHost = 'your-dev-site.net';
  $lastChangeOfAnyLessFile = md5(date("Y-m-d H:i:s", mktime(18, 52, 0, 2, 27, 2013)));
  $lessCompiler = '<link rel="stylesheet/less" type="text/css" href="/css/style.less?'.$lastChangeOfAnyLessFile.'">
                  <script src="/plugins/less-1.3.1.js" type="text/javascript"></script>';

  if ( $_SERVER['HTTP_HOST'] == $devServerHost){ 
    echo '<script type="text/javascript">less = { env: "development" };</script>' . $lessCompiler;
  } else { 
    require_once "./libs/lessphp/lessc.inc.php";
    try {
      $less = new lessc;
      $less->checkedCompile("./css/style.less", "./web_temp/".$lastChangeOfAnyLessFile.".css" );
      echo '<link rel="stylesheet" type="text/css" href="/web_temp/'.$lastChangeOfAnyLessFile.'.css">';
    } catch (Exception $e) {
      echo $lessCompiler . '<script>console.log("less is not compiled");</script>';
    }
  } 
?>
