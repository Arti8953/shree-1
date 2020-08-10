<style>
  .PrintThis table {
    width: 100%;
  }

  .PrintThis table tr td {
    text-align: center;
    padding: 0px 5px;
    vertical-align: top;
  }

  .PrintThis table td {
    font-size: 12px;
    font-weight: 700;
  }

  .PrintThis table table {
    width: 300px;
  }

  .PrintThis table table td:nth-child(1) {
    width: 40%;
  }

  .PrintThis table table td:nth-child(2) {
    width: 60%;
  }

  .PrintThis table table td {
    border: none;
    text-align: left;
  }

  table img {
    width: 100px;
    height: 62px;
    display: block;
    margin: 0 auto;
    padding-top: 5px;
  }
</style>

<table border="1">
  <?php //echo print_r($data); 
  ?>
  <?php foreach ($data as $value) : ?>
    <tr class="first_part">
      <td>
        <table>
          <tr>
            <td colspan="2" class="align-center main-text">
              <div>
                <img class="barCodeImage" id="barcode1<?php echo $value->barCode; ?>" />
                <script>
                  JsBarcode("#barcode1<?php echo $value->barCode; ?>", "<?php echo $value->barCode; ?>");
                </script>
              </div>
            </td>
          </tr>
          <tr>
            <td>BARCODE: </td>
            <td class="main-text"> <?php echo $value->barCode; ?></td>
          </tr>
          <tr>
            <td>DESIGN NAME: </td>
            <td class="main-text"> <?php echo $value->designName; ?></td>
          </tr>
          <tr>
            <td> DESIGN SER: </td>
            <td class="main-text"> <?php echo $value->designSeries; ?></td>
          </tr>
          <tr>
            <td> DESIGN CODE: </td>
            <td class="main-text"><?php echo $value->desCode; ?></td>
          </tr>
          <tr>
            <td> FABRIC: </td>
            <td class="main-text"><?php echo $value->fabricName; ?></td>
          </tr>
          <tr>
            <td> DYE: </td>
            <td class="main-text"><?php echo $value->dye; ?></td>
          </tr>
          <tr>
            <td width="30px;"> MATCHING: </td>
            <td class="main-text" width="30px;"><?php echo $value->matching; ?></td>
          </tr>
        </table>
      </td>
      <td>
        <table>
          <tr>
            <td colspan="2" class="align-center main-text">
              <div>
                <img class="barCodeImage" id="barcode2<?php echo $value->barCode; ?>" />
                <script>
                  JsBarcode("#barcode2<?php echo $value->barCode; ?>", "<?php echo $value->barCode; ?>");
                </script>
              </div>
            </td>
          </tr>
          <tr>
            <td>BARCODE: </td>
            <td class="main-text"> <?php echo $value->barCode; ?></td>
          </tr>
          <tr>
            <td> DESIGN NAME: </td>
            <td class="main-text"> <?php echo $value->designName; ?></td>
          </tr>
          <tr>
            <td> DESIGN SER: </td>
            <td class="main-text"><?php echo $value->designSeries; ?></td>
          </tr>
          <tr>
            <td> DESIGN CODE: </td>
            <td class="main-text"><?php echo $value->desCode; ?></td>
          </tr>
          <tr>
            <td> FABRIC: </td>
            <td class="main-text"><?php echo $value->fabricName; ?></td>
          </tr>
          <tr>
            <td> DYE: </td>
            <td class="main-text"><?php echo $value->dye; ?></td>
          </tr>
          <tr>
            <td width="30px;"> MATCHING: </td>
            <td class="main-text" width="30px;"><?php echo $value->matching; ?></td>
          </tr>
        </table>
      </td>
      <td>
        <table class="table-3">
          <tr>
            <td colspan="2" class="align-center main-text">
              <div>
                <img class="barCodeImage" id="barcode3<?php echo $value->barCode; ?>" />
                <script>
                  JsBarcode("#barcode3<?php echo $value->barCode; ?>", "<?php echo $value->barCode; ?>");
                </script>
              </div>
            </td>
          </tr>
          <tr>
            <td>BARCODE: </td>
            <td class="main-text"> <?php echo $value->barCode; ?></td>
          </tr>
          <tr>
            <td> DESIGN NAME: </td>
            <td class="main-text"> <?php echo $value->designName; ?></td>
          </tr>
          <tr>
            <td> DESIGN SER: </td>
            <td class="main-text"> <?php echo $value->designSeries; ?></td>
          </tr>
          <tr>
            <td> DESIGN CODE: </td>
            <td class="main-text"><?php echo $value->desCode; ?></td>
          </tr>
          <tr>
            <td> FABRIC: </td>
            <td class="main-text"><?php echo $value->fabricName; ?></td>
          </tr>
        </table>
      </td>
    </tr>
  <?php endforeach; ?>
</table>