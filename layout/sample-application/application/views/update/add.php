<div class="row-fluid">
  <?php if ($this->session->flashdata('flag')) : ?>
  <div class="alert alert-<?php echo $this->session->flashdata('kind'); ?>">
    <a class="close" data-dismiss="alert">&times;</a>
    <?php echo $this->session->flashdata('msg'); ?>
  </div>
  <?php endif; ?>
  <div>
    <form class="form update" action="<?php echo base_url('update/save'); ?>" method="post">
      <fieldset>
        <legend>Atualizar resultados da Lotofácil</legend>
        <div class="control-group">
          <label class="control-label" for="date"><strong>Data do sorteio</strong></label>
          <div class="controls">
            <input type="date" name="date" class="span2" id="date">
          </div>
        </div>
        <table class="table table-striped">
          <thead>
            <th>Bola 01</th>
            <th>Bola 02</th>
            <th>Bola 03</th>
            <th>Bola 04</th>
            <th>Bola 05</th>
            <th>Bola 06</th>
            <th>Bola 07</th>
            <th>Bola 08</th>
            <th>Bola 09</th>
            <th>Bola 10</th>
            <th>Bola 11</th>
            <th>Bola 12</th>
            <th>Bola 13</th>
            <th>Bola 14</th>
            <th>Bola 15</th>
          </thead>
          <tbody>
            <tr>
              <td><input  type="text" name="b1" /></td>
              <td><input  type="text" name="b2" /></td>
              <td><input  type="text" name="b3" /></td>
              <td><input  type="text" name="b4" /></td>
              <td><input  type="text" name="b5" /></td>
              <td><input  type="text" name="b6" /></td>
              <td><input  type="text" name="b7" /></td>
              <td><input  type="text" name="b8" /></td>
              <td><input  type="text" name="b9" /></td>
              <td><input  type="text" name="b10" /></td>
              <td><input  type="text" name="b11" /></td>
              <td><input  type="text" name="b12" /></td>
              <td><input  type="text" name="b13" /></td>
              <td><input  type="text" name="b14" /></td>
              <td><input  type="text" name="b15" /></td>
            </tr>
          </tbody>
        </table>
        <div class="form-actions">
          <div class="pull-right">
            <button type="submit" class="btn btn-primary">Atualizar resultados</button>
            <button type="reset" class="btn">Limpar campos</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>