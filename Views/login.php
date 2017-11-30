
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <header>
            <nav class="nav-extended light-blue lighten-1">
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="right">
                        <li><a href="login.php">LOGIN</a></li>
					    <li><a href="inscription.php">REGISTER</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <h1 class="purple-text"> Login Page</h1>
        <form action='#' method="post">
        <input id="email" type="email" class="validate">
        <label for="email">Email</label>
        <input id="password" type="password" class="validate">
        <label for="password">Password</label><br/>
        <input type="submit" value="Envoyer" />

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    </body>
  </html>
        