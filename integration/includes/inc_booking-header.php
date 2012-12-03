<?php include('functions.php');?>
<!doctype html>
<html class="js-false" lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title ?></title>

    <meta name="description" content="">
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../web/css/vacancesdirectes/payment.css">
    <!--<script src="//maps.googleapis.com/maps/api/js?sensor=false"></script>-->

    <script src="../web/vendor/head.extended.js"></script>
    <script>var templatePath = '../web/';</script><!-- templatePath : chemin du template en absolue -->
</head>
<body <?php if($page !=''){ echo 'class="'.$page.'"'; } ?> >