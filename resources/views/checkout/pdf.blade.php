
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
                <th>Voiture</th>
                <th>Immatriculation</th>
                <th>Type</th>
                <th>Assureur</th>
            </tr>

            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->price }}</td>
                <td>{{ $row->qty }}</td>
            </tr>

        </table>

    </main>
  </body>
</html>