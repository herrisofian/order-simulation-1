<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" integrity="sha256-oSrCnRYXvHG31SBifqP2PM1uje7SJUyX0nTwO2RJV54=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" integrity="sha256-j+P6EZJVrbXgwSR5Mx+eCS6FvP9Wq27MBRC/ogVriY0=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha256-4hqlsNP9KM6+2eA8VUT0kk4RsMRTeS7QGHIM+MZ5sLY=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rating/1.5.0/bootstrap-rating.min.css" integrity="sha256-kTpDjewvK4G725YuKc5ZRcqykMxAypjQWzS8bh/6YIw=" crossorigin="anonymous" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" rel="stylesheet" />
        <title>Home / Index</title>
        
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <form class="form-login">
                    <div class="form-group">
                        <label for="usr">Name:</label>
                        <input type="text" class="form-control" id="username" name="username" required />
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnLogin" >SUBMIT</button>
                </form>
            </div>
        </div>  
        <script>
            var url = "<?php echo base_url()?>";
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha256-NXRS8qVcmZ3dOv3LziwznUHPegFhPZ1F/4inU7uC8h0=" crossorigin="anonymous" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" defer></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rating/1.5.0/bootstrap-rating.min.js" integrity="sha256-jpnUk+hgZ6/GOP5fnrJO+wjFh90vDMvNxrNY40AFkWg=" crossorigin="anonymous" defer></script>
        <script type="text/javascript">
           
                $('#btnLogin').on("click", function(e){
                    console.log(url);
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: url + "index.php/welcome/login",
                        dataType: "json",
                        data: $('.form-login').serialize(),
                        success:function(response) {
                           if(response.status != 0){
                               top.location.href= url+"index.php/orders";
                           }
                        }
                    });
                });
                
        
        </script>    
        
    </body>
</html>
