<html>
  <head>
    <title>Evernote</title>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <style media="screen">
      textarea {
        width: 600px; height: 600px;
      }
    </style>
  </head>
  <body>
    <?php
      define('CHARSET', 'UTF-8');
      define('REPLACE_FLAGS', ENT_HTML5);

      function htmlencode($string) {
        // return htmlspecialchars( $string, REPLACE_FLAGS,  CHARSET);
        return htmlspecialchars( $string);
      }

      $evernote_content = $_POST['evernote_content'];
      if( $evernote_content ) {
        $dom = new DOMDocument();
        $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $evernote_content );
        // $dom->loadHTML( . $profile);

        // $dom->loadHTML(  mb_convert_encoding($evernote_content, 'HTML-ENTITIES', 'UTF-8') );

        $evernote_table_style = '-evernote-table:true;border-collapse:collapse;width:100%;table-layout:fixed;margin-left:0px;';
        $evernote_td_style = 'border: 1px solid rgb(219, 219, 219); padding: 10px; margin: 0px;';

        foreach ($dom->getElementsByTagName('table') as $item) {
          $item->setAttribute('style', $evernote_table_style);
          $item->removeAttribute('border');
          $item->removeAttribute('cellpadding');
          $item->removeAttribute('cellspacing');
          $item->removeAttribute('width');
        }

        foreach ($dom->getElementsByTagName('td') as $item) {
          $item->setAttribute('style', $evernote_td_style);
          $item->removeAttribute('valign');
          // echo $dom->saveHTML();
        }
        $edited_content = $dom->saveHTML();
        $escaped_content = htmlencode( $edited_content );
      }


     ?>
     ===
     <?php echo htmlencode("Ąąąłó"); ?>

     ==
     <pre>
       <?php //echo $edited_content  ?>
     </pre>
     <form>
       <textarea name="Name" rows="8" cols="40"><?= $edited_content  ?></textarea>
     </form>
    <form action='' method="POST"  accept-charset="UTF-8">
      <textarea name='evernote_content'><?= $evernote_content ?></textarea>
      <button name="button" type="submit">Submit</button>
    </form>



  </body>
</html>
