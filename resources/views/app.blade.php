<!DOCTYPE html>
<html>
<head>
    <title>{{thisCollege()->name}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="{{ asset('css/home/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/layout.css') }}" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('img/background.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .wrapper.row1 {
            border: 0;
        }

        div.wrapper header nav ul a{
            text-decoration: none;
        }
        #logo{ 
            width: 60px; height: 60px , margin:0; padding: 0; 
            margin-left: -200px; padding-left: -200px
            
        }
        .nomargin{ margin: 0; padding: 0 }
        
    </style>

    @yield('page-embed-styles')

</head>
<body>

<div class="wrapper row1">
    <header id="header" class="clear">

        <div id="logo" class="fl_left" style="padding: 0; margin: 0;">
            <h1 class="nomargin navbar-brand" style="padding: 0; margin: 0; display: inline-block; width:300px; text-align: left; line-height: 0; margin-left: -150px;"><a href="/"><img id="logo" src="{{thisCollege()->logo_url}}"></a> </h1>
        </div>

        <nav id="mainav" class="fl_right">
            <ul class="clear">
                <li><a href="/">Home</a></li>
                <li><a href="/page/image-gallery">Gallery</a>
                <li><a href="/forum"></a></li>
                <li class="navbar-collapse">
                    <a href="">Register <i class="fa fa-chevron-down"></i> </a>
                    <ul>
                        <li><a href="guardian/register">Guardian</a> </li>
                    </ul>
                </li>
                <li class="navbar-collapse">
                    <a href="#" onclick="javascript:void()">Login <i class="fa fa-chevron-down"></i> </a>
                    <ul>
                        <li><a href="admin/login">Admin</a> </li>
                        <li><a href="teacher/login">Teacher</a> </li>
                        <li><a href="guardian/login">Guardian</a> </li>
                        <li><a href="student/login">Student</a> </li>
                    </ul>
                </li>
                <li><a href="/page/contact">Contact Us</a></li>
                <li><a href="/page/about"> About {{thisCollege()->name}}</a></li>
            </ul>
        </nav>

    </header>
</div>
 
@yield('content')


<div class="wrapper row5">
    <div id="copyright" class="clear">
        <p class="fl_left">Copyright &copy; {{ date('Y') }} - All Rights Reserved -www.srcoe.edu.ng</p>
        <p class="fl_right">ibagwai9@gmail.com</p>
    </div>
</div>


@yield('page-embed-scripts')

</body>
</html>
