<div class="row">
  <div class="col">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <?php foreach ( $table[ 'cols' ] as $col ): ?>
          <th scope="col"><?= $col ?></th>
          <?php endforeach ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ( $table[ 'rows' ] as $key => $rows ): ?>
        <tr>
          <?php foreach ( $rows as $row ): ?>
            <?php if ( is_array( $row ) ): ?>
          <td>
            <?php foreach ( $row as $link ):
              if ( !empty( $link ) ):
                if ( !is_array( $link[ 'url' ] ) ):
                $class = $link[ 'type' ] == 'btn' ?
                  'primary' : '';
                $class = $link[ 'type' ] == 'btn-s' ?
                  'success' : $class;
                $class = $link[ 'type' ] == 'btn-2' ?
                  'outline-secondary' : $class;
                $class = $link[ 'type' ] == 'btn-i' ?
                  'outline-info' : $class ?>
            <a class="btn btn-<?= $class ?>" href="<?= $link[ 'url' ] ?>">
              <?= $link[ 'label' ] ?>
            </a>
            <?php else: $data = $link[ 'url' ] ?>
            <button
              class="btn btn-outline-info btn-email"
              data-t="<?= $data[ 't' ] ?>"
              data-inv="<?= $data[ 'inv' ] ?>">
              <?= $link[ 'label' ] ?>
            </button>
            <?php endif; ?>
            <?php endif; endforeach ?>
          </td>
            <?php else: ?>
          <td><?= $row ?></td>
          <?php endif; endforeach ?>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>