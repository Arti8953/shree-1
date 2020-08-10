<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <!-- COMMON TAGS -->
  <meta charset="utf-8">
  
  <link rel="stylesheet" href="<?php echo base_url('optimum/printThis/assets/css/normalize.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('optimum/printThis/assets/css/skeleton.css'); ?>">
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
