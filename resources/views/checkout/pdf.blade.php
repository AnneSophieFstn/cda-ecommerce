
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Facture MielPéi</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <h1>FACTURE MIÉLPÉI974</h1>
      <div id="company" class="clearfix">
        <div><a href="mailto:company@example.com">mielpei974@mielpei.fr</a></div>
      </div>
    </header>
    <br><br><br>
    <main>
        

        <table class="table table-bordered mt-4 ">
            <tr>
                <th>Id</th>
                <th>Nom article</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>

            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->title }}</td>
                <td>{{ $order->price }}</td>
                <td>{{ $order->qty }}</td>
            </tr>

        </table>

    </main>
  </body>
</html>