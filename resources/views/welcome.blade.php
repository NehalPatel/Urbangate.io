<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UrbanGate.io</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 54px;
        }

        .text{
            font-size: 24px;
        }

        .m-t-md {
            margin-bottom: 30px;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;            
        }
        .footer a{
            color: #636b6f;
            text-decoration:none;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-t-md m-b-md">
                UrbanGate                                        
            </div>
            <p class="text">We are coming very soon...</p>
            <div class="m-b-md">
                <img src="/assets/images/site_build.png" class="img-fluid" style="width: 400px">                    
            </div>                                
        </div>
        <div class="clearfix"></div>

        <!-- Footer -->
        <footer class="footer">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2020 Copyright:<a href="https://urbangate.io/"> UrbanGate.io</a>
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->
    </div>   
</body>
</html>
