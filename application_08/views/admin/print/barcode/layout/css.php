<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">

	<script src="<?php echo base_url('optimum/barcode/dist/JsBarcode.all.js'); ?>"></script>
  <script>
    function textToBase64Barcode(text){
      var canvas = document.createElement("canvas");
      JsBarcode(canvas, text, {format: "CODE39"});
      return canvas.toDataURL("image/png");
    }
  </script>
</head>
<body>
