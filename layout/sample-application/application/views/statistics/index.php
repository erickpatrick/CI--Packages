<?php if ($this->session->flashdata('flag')) : ?>
<div class="alert alert-<?php echo $this->session->flashdata('kind'); ?>">
  <a class="close" data-dismiss="alert">&times;</a>
  <?php echo $this->session->flashdata('msg'); ?>
</div>
<?php endif; ?>
<div>
  <h2>Estatísticas & Probabilidades <small>Cálculos melhoradores de performance</small></h2>
  <div class="row graphic-sum">
    <div class="span8">
      <h3>Quantidades de vezes &times; Soma dos resultados: Sorteados 10+ vezes</h3>
    <?php $sum = 0; $qtt = 0; $times = 0; $above_ten = array(); foreach ($stats as $s) : ?>
      <?php if ($s->quantity > 9) : ?>
      <span>
        <img src="<?php echo site_url('assets/img/graphic-bar-alpha.png'); ?>" width="17" height="<?php echo (150 - ($s->quantity * 5));?>" />
        <?php echo $s->quantity; ?>
        <img src="<?php echo site_url('assets/img/graphic-bar.png'); ?>" width="17" height="<?php echo ($s->quantity * 5); ?>" />
        <?php echo $s->sum; ?>
      </span>
      <?php endif; ?>
      <?php $qtt += $s->quantity; $sum += $s->sum; ?>
    <?php if ($s->quantity >= 10) : $above_ten[] = $s->sum; $times += $s->quantity; endif; ?>
    <?php endforeach; ?>
    </div>
    <?php sort($above_ten); ?>
    <div class="span6">
      <h3>Conjuntos sorteados 10+ vezes representam</h3>
      <h1 class="bignum"><?php printf("%.2f", ($times / $total * 100)); ?>%</h1>
    </div>
  </div>
  <?php $count = count($stats); $sum /= $count; $qtt /= $count; ?>
  <div>
    <div class="row">
      <div class="span8">
        <h3>Último sorteio: #<?php echo $game->id; ?> <small>em <?php echo $game->date; ?></small></h3>
        <table class="table table-striped">
          <tbody>
            <tr>
              <th class="span3">Números sorteados:</th>
              <td><?php echo $game->numbers; ?></td>
            </tr>
            <tr>
              <th class="span3">Números fora:</th>
              <td><?php echo $game->left; ?></td>
            </tr>
            <tr>
              <th class="span3">Soma do sorteio:</th>
              <td><?php echo $game->sum; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="span4">
        <h3>Últimos 10 sorteios</h3>
        <table class="table table-striped">
          <tbody>
            <tr>
              <th>Moda:</th>
              <td><?php echo $means->mode; ?></td>
            </tr>
            <tr>
              <th>Média:</th>
              <td><?php echo $means->mean; ?></td>
            </tr>
            <tr>
              <th>Mediana:</th>
              <td><?php echo $means->median; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="span3 text-align-right">
        <h3>Média total</h3>
        <h1><?php printf("%.2f", $vals['sum']); ?> <small><?php printf("%.2f", $vals['qtt']); ?></small></h1>
        <h3>Média maiores somas</h3>
        <h1><?php printf("%.2f", $sum); ?> <small><?php printf("%.2f", $qtt); ?></small></h1>
      </div>
    </div>
  </div>
  <div>
    <div class="row">
      <div class="span5">
        <table class="table table-striped">
          <tbody>
            <tr>
              <th>Top 09:</th>
              <td><?php echo $max_min['top']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="span6">
        <table class="table table-striped">
          <tbody>
            <tr>
              <th>Intermediários:</th>
              <td><?php echo $max_min['middle']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="span4">
        <table class="table table-striped">
          <tbody>
            <tr>
              <th>Piores 05:</th>
              <td><?php echo $max_min['bottom']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>