<?php if ($this->session->flashdata('flag')) : ?>
<div class="alert alert-<?php echo $this->session->flashdata('kind'); ?>">
  <a class="close" data-dismiss="alert">&times;</a>
  <?php echo $this->session->flashdata('msg'); ?>
</div>
<?php endif; ?>
<div>
  <h2>Resultados Lotofácil <small>Os 10 resultados mais recentes</small></h2>
  <div class="row-fluid">
    <table class="table table-striped sorteio">
      <thead>
        <th>Sorteio</th>
        <th>Data</th>
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
        <th>Soma</th>
      </thead>
      <tbody>
      <?php foreach ($results as $result) :?>
        <tr>
          <td><?php echo $result->id; ?></td>
          <td><?php echo $result->date; ?></td>
          <td><?php echo $result->b1; ?></td>
          <td><?php echo $result->b2; ?></td>
          <td><?php echo $result->b3; ?></td>
          <td><?php echo $result->b4; ?></td>
          <td><?php echo $result->b5; ?></td>
          <td><?php echo $result->b6; ?></td>
          <td><?php echo $result->b7; ?></td>
          <td><?php echo $result->b8; ?></td>
          <td><?php echo $result->b9; ?></td>
          <td><?php echo $result->b10; ?></td>
          <td><?php echo $result->b11; ?></td>
          <td><?php echo $result->b12; ?></td>
          <td><?php echo $result->b13; ?></td>
          <td><?php echo $result->b14; ?></td>
          <td><?php echo $result->b15; ?></td>
          <td><strong><?php echo $result->sum; ?></strong></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>