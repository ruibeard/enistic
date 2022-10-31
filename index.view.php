<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="styles.css" rel="stylesheet">
   <title>Document</title>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body class="bg-slate-100  ">

<nav class="flex justify-between items-center mx-auto max-w-screen-xl my-8">
   <p><a href="htts://ruialmeida.me" target="_blank" class="underline">ruialmeida.me</a></p>
</nav>
<header class=" max-w-screen-xl mx-auto p-10 my-8 bg-white overflow-hidden shadow-2xl justify-center items-center flex space-x-4">
   <div class=" space-y-4">
      <p>Below is my attempt to create the assignment requested. </p>
      <p>I'm using PHP, <a class="underline" href="https://tailwindcss.com/">TailwindCSS</a> and Jquery</p>
   </div>
</header>
<main class="shadow-2xl bg-slate-50 max-w-screen-xl mx-auto  p-8 flex justify-around items-center">

   <table class="shadow-2xl  mx-auto border divide-y divide-gray-300 ">
      <thead class="bg-gray-100 uppercase ">
      <tr>
         <th class="py-4 px-2">Description</th>
         <th class="py-4 px-2">Price</th>
         <th class="py-4 px-2">Action</th>
      </tr>
      </thead>

      <tbody class="divide-y divide-gray-300">
      <?php
      $html = '';
      foreach ($listOfPrices as $row) {
          $html .= <<<HTML
      <tr id="price{$row->id}">
         <td class="py-2 px-4 flex space-x-4 overflow-auto items-center border-r border-gray-100">
            <img class="h-16 w-16  rounded-full object-cover" src="https://source.unsplash.com/random/100×100/?{$row->description}" alt="Image fetched from Unsplash">
               <span>$row->description</span>
         </td>
         <td class="py-2 text-center">$row->price </td>
         <td class="py-2 text-center">
             <button type="button" name="delete" id="delete" class="text-red-600 font-bold" value="{$row->id}">X</button>
         </td>
      </tr>
  HTML;
      }
      $html .= <<<HTML

      <form id="insert" method="post">
         <tr>
            <td class="px-2 "><input id="description" class="border-b bg-gray-200 ring-1 border-gray-500" name="description" placeholder="Ex: kiwi" type="text" value=""/></td>  
            <td class="px-2"><input size="7" class="border-b bg-gray-200 inline-flex  ring-1 border-gray-500 px-2" step="0.01" name="price" placeholder="Ex: 9.99 " type="number"></td>
            <td class="px-2 py-2"><input type="submit" class="cursor-pointer bg-green-600 text-gray-100 px-4 py-1 rounded-full" value="Create"></td>
         </tr>
      </form>
HTML;

      echo $html;
      ?>
      </tbody>
   </table>

</main>
<script>
    $(document).ready(function () {
        var i = <?= $settingValue[0]->value; ?>;
        console.log(i);
        var timer = setInterval(function () {
            if (i === 0) {
                clearInterval(timer);
            }
            $('#counter').text('Number ' + i--);
        }, 1000);

        $('button#delete').click(function () {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'Delete.php',
                data: {id: id},
                success: function () {
                    $('#price'.concat(id)).remove();
                }
            });
        });

        $("#insert").on("submit", function (event) {
            event.preventDefault();
            var formValues = $(this).serialize();
            console.log(formValues);
            $.ajax({
                type: 'POST',
                url: 'Create.php',
                data: formValues,
                success: function () {
                    location.reload();
                }
            });
        });
    })
</script>
</body>
</html>
