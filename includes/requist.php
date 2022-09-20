<div class="container-fluid  wow fadeInUp" data-wow-delay="0.1s" id="contact">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">Request for quick services</h5>
                    <h1 class="mb-0">Interested In Our Services?<br>Do not hesitate to get in touch with us.</h1>
                </div>
                <div class="row gx-3">
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                        <h5 class="mb-4"><i class="fa fa-reply text-primary me-3"></i>Reply within 24 hours</h5>
                    </div>
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                        <h5 class="mb-4"><i class="fa fa-phone-alt text-primary me-3"></i>24 hrs telephone support
                        </h5>
                    </div>
                </div>
                <p class="mb-4">Racing among the competitors is definitely a difficult task. We consistently exceed
                    your expectations, regardless of how difficult the tasks are. We make every effort to deliver
                    one-of-a-kind products and services that satisfy and fulfill your demands and requirements.
                    Continue reading to see what makes us the best IT company for your next big projects.</p>
                <div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Contact us if you have any questions ?</h5>
                        <h4 class="text-primary mb-0">+212 675556566</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="bg-white rounded-3 h-100 d-flex align-items-center p-5 wow zoomIn  form-style " data-wow-delay="0.9s">

                    <div>
                        <div class="row g-3 ">
                            <div class="col-xl-12">
                                <h3 class="text-center text-white rounded-3 py-3">CONTACT US</h3>
                            </div>

                            <div class="col-xl-12 position-relative">
                                <input value="<?= isset($_SESSION['user']) ? $_SESSION['user']['name'] : '' ?>" type="text" id="request_fullname" class=" effect-1" placeholder="Your Name" style="height: 55px;" required>
                                <span class="Focus-border"></span>
                            </div>

                            <div class="col-12 position-relative">
                                <input value="<?= isset($_SESSION['user']) ? $_SESSION['user']['email'] : '' ?>" id="request_email" type="email" class="request_email effect-1 " placeholder="Your Email" style="height: 55px;" required>
                                <span class="Focus-border"></span>
                            </div>

                            <div class="col-12  position-relative">
                                <select class="effect-1" id="request_service" style="height: 55px;" required>
                                    <option selected disabled>Select A Service</option>
                                    <option value="Security">Security</option>
                                    <option value="SEO">SEO</option>
                                    <option value="Web development">Web development</option>
                                    <option value="Design">Design</option>
                                    <option value="Web and mobile apps">Web and mobile apps</option>
                                    <option value="Maintenance">Maintenance</option>
                                </select>
                                <span class="Focus-border"></span>
                            </div>

                            <div class="col-12 position-relative">
                                <input id="request_title" type="text" class=" effect-1 " placeholder="request's subject" style="height: 55px;" required>
                                <span class="Focus-border"></span>
                            </div>

                            <div class="col-12 position-relative">
                                <textarea id="request_body" class="effect-1" rows="4" placeholder="your Message" required></textarea>
                                <span class="Focus-border text-area "></span>
                            </div>

                            <div class="col-12 d-flex justify-content-center ">
                                <button class="btn fs-2 spatiel-btn w-50 rounded-3 p-2 mt-3" style=" background-color: #000066;" id="send_request">Send
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>