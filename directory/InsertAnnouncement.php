<html>
  <head>
    <link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
    #editor {
      height: 400px;
      width: 400px
    }
    #toolbar {

      width: 400px
    }
    .line-dotted {
      border-style: dotted;
    }

    .line-solid {
      border-style: solid;
    }

    .line-double {
      border-style: double;
    }

    .ql-snow .ql-picker.ql-box .ql-picker-label::before,
    .ql-snow .ql-picker.ql-box .ql-picker-item::before {
        content: 'None'
    }

    .ql-snow .ql-picker.ql-box .ql-picker-label[data-value="solid"]::before,
    .ql-snow .ql-picker.ql-box .ql-picker-item[data-value="solid"]::before {
        content: "Solid";
     }

    .ql-snow .ql-picker.ql-box .ql-picker-label[data-value="double"]::before,
    .ql-snow .ql-picker.ql-box .ql-picker-item[data-value="double"]::before {
        content: "Double";
     }

    .ql-snow .ql-picker.ql-box .ql-picker-label[data-value="dotted"]::before,
    .ql-snow .ql-picker.ql-box .ql-picker-item[data-value="dotted"]::before {
        content: "Dotted";
     }
    .ql-snow span.ql-picker.ql-box {
        width: 8em;
    }
    </style>
  </head>

  <body>
    <label for="display_name">Run Until: </label>
    <input class="form-control" name="runtil" id="runtil" type="datetime-local" value=<?php echo date("Y-m-d\Th:m", strtotime("+1 week"));?>>
    <div id="toolbar">
      <button class="ql-bold"></button>
      <button class="ql-italic"></button>

      <select class="ql-box">
        <option selected>None</option>
        <option value="double">Double</option>
        <option value="solid">Solid</option>
        <option value="dotted">Dotted</option>
      </select>
    </div>

    <div id="editor"></div>






    <input name="annc" id="annc" type="hidden">


  <div class="row">
      <button onclick="logHtmlContent()">Log content as HTML</button>
  </div>
</form>
</div>

<label for="link">
<input name="link" id="link" type="text">
<button onclick="parselink()">get code</button>
<span id="linktext"></span>


  <script>
  let Inline = Quill.import('blots/inline');
  let Parchment = Quill.import('parchment')

  var boxAttributor = new Parchment.Attributor.Class('box', 'line', {
    scope: Parchment.Scope.INLINE,
    whitelist: [false, 'solid', 'double', 'dotted']
  });

  Quill.register(boxAttributor);

  class MarkBlot extends Inline { }
  MarkBlot.blotName = 'mark';
  MarkBlot.tagName = 'mark';
  Quill.register(MarkBlot);

  var quill = new Quill('#editor', {
    modules: {
      toolbar: {
        container: '#toolbar'
      }
    },
    theme: 'snow'
  });




  function logHtmlContent() {
    foo = quill.root.innerHTML;
    bar=foo.replace("&lt;","<").replace("&gt;",">");
    document.getElementById('linktext').innerHTML='<xmp>'+bar+'</xmp>';
    console.log(bar);
console.log(document.getElementById("runtil").value);
    $.post("anncdb.php", {
     annc: bar,
     runtil: document.getElementById("runtil").value
   });
  }




  function parselink(){
quill.root.innerHTML='<xmp><img src="'+document.getElementById('link').value+'" width="150px"></xmp>';
  }
  </script>



</html>
