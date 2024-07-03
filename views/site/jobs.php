<div class="row">
  <div class="col-md-3">
  <a href="/jobs/new" class="btn btn-primary">Add New</a>
  </div>
</div>
<div class="row">
  <?php foreach ( $jobs as $job ) : ?>
  <div class="col-md-3">
    <div class="card border-0 bg-light rounded shadow">
      <div class="card-body p-4">
        <h5><?= $job->job_title ?></h5>
        <p><?= $job->job_desc ?></p>
        <p><?= $job->category ?></p>
        <p><?= $job->deadline ?></p>
        <?php if ( 'open' == $job->status ) : ?>
        <div class="mt-3"> <a href="/jobs/<?= $job->id ?>" class="btn btn-primary">View Details</a></div></div>
        <?php endif ?>
    </div>
  </div>
  <?php endforeach ?>
</div>