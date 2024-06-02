<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>




    <div class="alert alert-info col-4 offset-4 alert-dismissible fade show d-none" role="alert" id="myAlert">
        <div class="row">
            <div class="col-11"> <h4 class="alert-heading fw-bold">
            !Oops
        </h4>
    </div>
            <div class="col-1">
        <button type="button" class="btn-close text-left" data-bs-dismiss="alert" aria-label="Close"></button></div>
       
        </div>
        <hr/>
        <div class="col-12 fs-5">
        You Have to Sign In Or Sign Up First
        </div>

    </div>

    <button onclick="alerttrig();">Trigger</button>





<script>
  bootstrap.Alert.getInstance(alert);
</script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>