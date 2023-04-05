@extends('layouts.master')
@section('main')
<section>
        <div class="container-fluid">
          <div class="page-header">
            <div class="row">
              <div class="col-sm-6 mt-4">
                <h3>Timeline 1</h3>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item">Timeline</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Example</h5>
              </div>
              <div class="card-body">
                <!-- cd-timeline Start-->
                <section class="cd-container" id="cd-timeline">
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture bg-primary"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Waiting Purchase Request Approval</h4>
                      <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p><span class="cd-date">Jan <span class="counter digits"> 14</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-secondary"><i class="icon-video-camera"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Purchase Request Approved</h4>
                      <div class="embed-responsive embed-responsive-21by9 m-t-20">
                        <iframe src="https://www.youtube.com/embed/wpmHZspl4EM" allowfullscreen=""></iframe>
                      </div><span class="cd-date">Jan <span class="counter digits">18</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture bg-success"><i class="icon-image"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Purchase Proses</h4><img class="img-fluid p-t-20" src="../assets/images/banner/1.jpg" alt=""><span class="cd-date">Jan <span class="counter digits">24</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-location bg-info"><i class="icon-pulse"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Cross Check PO</h4>
                      <audio class="m-t-20" controls="">
                        <source src="../assets/audio/horse.ogg" type="audio/ogg">                                                Your browser does not support the audio element.
                      </audio><span class="cd-date">Feb <span class="counter digits">14</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-location bg-warning"><i class="icon-image"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Waiting For PO Approval</h4><img class="img-fluid p-t-20" src="../assets/images/banner/3.jpg" alt=""><span class="cd-date">Feb <span class="counter digits">18</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-danger"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>PO Approved</h4>
                      <p class="m-0">This is the content of the last section</p><span class="cd-date">Feb <span class="counter digits">26</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-danger"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Invoicing Process</h4>
                      <p class="m-0">This is the content of the last section</p><span class="cd-date">Feb <span class="counter digits">26</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-danger"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Payment Approved</h4>
                      <p class="m-0">This is the content of the last section</p><span class="cd-date">Feb <span class="counter digits">26</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-danger"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Unpaid</h4>
                      <p class="m-0">This is the content of the last section</p><span class="cd-date">Feb <span class="counter digits">26</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-danger"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Paid</h4>
                      <p class="m-0">This is the content of the last section</p><span class="cd-date">Feb <span class="counter digits">26</span></span>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-danger"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Delivery Success</h4>
                      <p class="m-0">This is the content of the last section</p><span class="cd-date">Feb <span class="counter digits">26</span></span>
                    </div>
                  </div>
                </section>
                <!-- cd-timeline Ends-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Container-fluid ends -->
</section>

@endsection
