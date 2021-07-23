<div class='mpFramed'>
      <div class="alert alert-dismissible alert-danger" style="display: none" id="alert">>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
      </div>
      <h5>Phone Status</h5>
      <table class="table  table-bordered" id="tblTenantAnswer">
        <tr class=table-primary><th>Tenants</th></tr>


        <?php

        $tableRow = "<tr class='clickable-row rowAnswer' data-phoneStatusID=".$row['phoneStatusID'].
        " data-phoneStatus=".$row['phoneStatus']."><td><i class='fas fa-phone tenantPhone'></i>".$row['answerName']."</td></tr>";

        $sql = "SELECT * FROM `phoneStatus` WHERE `candia` <> 1";
        $result = $db->query($sql);
        while($row = $result->fetch_assoc()) {
          echo "<tr class='clickable-row rowAnswer' data-phoneStatusID=".$row['phoneStatusID'].
          " data-phoneStatus=".$row['phoneStatus']." data-candia=0><td><i class='fas fa-phone phoneIcon'></i>&nbsp;&nbsp;".$row['answerName']."</td></tr>";
        }
        ?>

        <tr class=table-info><th>Candia</th></tr>
        <?php
        $sql = "SELECT * FROM `phoneStatus` WHERE `candia` = 1";
        $result = $db->query($sql);
        while($row = $result->fetch_assoc()) {
          echo "<tr class='clickable-row rowAnswer' data-phoneStatusID=".$row['phoneStatusID'].
          " data-phoneStatus=".$row['phoneStatus']." data-candia=1><td><i class='fas fa-phone phoneIcon'></i>&nbsp;&nbsp;".$row['answerName']."</td></tr>";
        }
        ?>
      </table>
</div>
      <script>

      function updateTblAnswer(){var jqxhr = $.get( '/dbFunctions/dbMainPage.php?q=2', function() {}).done(function(foo) {xs = foo.split("|");
          for (var i = 0; i < xs.length; i++) {
            $(".phoneIcon").eq(i).removeClass('fa-phone-slash fa-phone fa-envelope-open');
            $(".rowAnswer").eq(i).removeClass('answerCall takeMessage ignoreCall');

            if (xs[i] == 1){
              $(".phoneIcon").eq(i).addClass('fa-phone');
              $(".rowAnswer").eq(i).addClass('answerCall');
              $(".rowAnswer").eq(i).data('phonestatus', parseInt(xs[i]));
            }
            if (xs[i] == 2){
              $(".phoneIcon").eq(i).addClass('fa-envelope-open');
              $(".rowAnswer").eq(i).addClass(' takeMessage ');
              $(".rowAnswer").eq(i).data('phonestatus', parseInt(xs[i]));
            }
            if (xs[i] == 3){
              $(".phoneIcon").eq(i).addClass('fa-phone-slash');
              $(".rowAnswer").eq(i).addClass('ignoreCall');
              $(".rowAnswer").eq(i).data('phonestatus', parseInt(xs[i]));
            }
          }
        })
        .fail(function() {
          $("#updateAlert").addClass("alert-danger");
          $("#updateAlertText").html("Now why would you go and break everything?");
        });
      }



      $(".clickable-row").click(function() {
        i=$( ".rowAnswer" ).index( this );
        console.log("this.data.phonestatus: "+$(this).data('phonestatus'));
        status = $(this).data('phonestatus');
        newStatus = parseInt(status)+1;
        console.log("newstatus before ifthen: "+newStatus);
        if ($(this).data('candia')==1){
          if (status == 1){ newStatus = 2;}else{newStatus=1;}
        }else{
          if (status == 3){ newStatus = 1;}else{newStatus= parseInt(status) + 1;}
        }


        console.log("newStatus:" +newStatus);
        $(".phoneIcon").eq(i).removeClass('fa-phone-slash fa-phone fa-envelope-open');
        $(".rowAnswer").eq(i).removeClass('answerCall takeMessage ignoreCall');

        if (newStatus == 1){
          $(".phoneIcon").eq(i).addClass('fa-phone');
          $(".rowAnswer").eq(i).addClass('answerCall');
        }
        if (newStatus == 2){
          $(".phoneIcon").eq(i).addClass('fa-envelope-open');
          $(".rowAnswer").eq(i).addClass(' takeMessage ');
        }
        if (newStatus == 3){
          $(".phoneIcon").eq(i).addClass('fa-phone-slash');
          $(".rowAnswer").eq(i).addClass('ignoreCall');
        }
        $(".rowAnswer").eq(i).data('phonestatus', newStatus);

        var jqxhr = $.post( '/dbFunctions/dbMainPage.php?q=1', $(this).data(), function() {
        })
        .done(function(data) {
          console.log(data);
        })
        .fail(function() {
          $("#alert").addClass("alert-danger");
          $("#alert").html("Now why would you go and break everything?");
        })
        .always(function() {
          console.log("finished");
        });
//*/
      });

      updateTblAnswer();
      setInterval(updateTblAnswer,15000);

      $('#quickCharge').on('change', function(){
        foo = $( "#quickCharge option:selected" ).data('units');
        $('#quickCargeQuantity').attr('placeholder', foo+'s');
        $('#quickCargeQuantity').attr('title', 'Per '+ foo);
      });
      function postCharge(type){
        if (type == 1){
          cost = $('#quickCharge').val()*$('#quickCargeQuantity').val();
          $('#output').html("going to charge someone $"+cost+" for "+$( "#quickCharge option:selected" ).text().trim());
        }else{
          $('#output').html("you done did it!");
        }
      }


      </script>
