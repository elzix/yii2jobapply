<div class="row justify-content-between">
    <!-- Left Content -->
    <div class="col">
        <!-- job single -->
        <div class="single-job-items mb-50">
            <div class="job-items">
                <div class="company-img company-img-details">
                    <a href="#"><img src="assets/img/icon/job-list1.png" alt=""></a>
                </div>
                <div class="job-tittle">
                    <h2><?= $job->job_title ?></h2>
                </div>
            </div>
        </div>
            <!-- job single End -->
        
        <div class="job-post-details">
            <div class="post-details1 mb-50">
                <!-- Small Section Tittle -->
                <div class="small-section-tittle">
                    <h5>Job Description</h5>
                </div>
                <p><?= $job->job_desc ?></p>
            </div>
            <div class="post-details2  mb-50">
                    <!-- Small Section Tittle -->
                <div class="small-section-tittle">
                    <h5>Category</h5>
                </div>
                <p><?= $job->category ?></p>
            </div>
            <div class="post-details2  mb-50">
                    <!-- Small Section Tittle -->
                <div class="small-section-tittle">
                    <h5>Deadline</h5>
                </div>
                <p><?= $job->deadline ?></p>
            </div>
            <?php if ( 'open' == $job->status ) : ?>
            <div class="mt-3">
                <a href="/applications/new/<?= $job->id ?>" class="btn btn-primary">Apply</a>
            </div>
            <?php endif ?>
        </div>

    </div>
</div>