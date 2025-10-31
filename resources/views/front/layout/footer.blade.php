    <footer class="footer">
        <section class="newsletter-section">
            <div class="theme-container">
                <h2 class="theme-heading">Sign up here for news and offers...</h2>
                <form class="row w-100 mx-auto g-3 justify-content-center newsletter-form align-items-strech" action="{{ route('front.addSuscriber') }}" method="post">
                    @csrf
                    <div class="newsletter-form-main d-flex flex-md-nowrap flex-wrap align-items-center ps-lg-0 p-0">
                        <label for="firstName" class="form-label mb-0 theme-paragraph">First Name*</label>
                        <input type="text" class="ms-0 ms-md-2  form-control theme-paragraph" id="firstName"
                            name="firstname" placeholder="Enter text here..">
                    </div>

                    <div class="newsletter-form-main d-flex flex-md-nowrap flex-wrap align-items-center">
                        <label for="surname" class="ms-md-2 ms-0 form-label mb-0 theme-paragraph">Surname*</label>
                        <input type="text" class="ms-0 ms-md-2  form-control theme-paragraph" id="surname"
                            name="lastname" placeholder="Enter text here..">
                    </div>

                    <div class="newsletter-form-main d-flex flex-md-nowrap flex-wrap align-items-center">
                        <label for="email" class="ms-md-0 ms-0 form-label mb-0 theme-paragraph">Email Address*</label>
                        <input type="email" class="ms-0 ms-md-2  form-control theme-paragraph" id="email"
                            name="email" placeholder="Enter text here..">
                    </div>

                    <div class="col-md-auto d-flex pe-0">
                        <button type="submit" class="theme-btn newsletter-btn theme-btn-dark">Sign Up</button>
                    </div>

                </form>
            </div>
        </section>
        <section class="footer-middle">
            <div class="theme-container">
                <div class="d-md-flex d-block justify-content-between align-items-start gap-2 flex-wrap">
                    <div class="footer-column">
                        <a href="index.html" class="footer-logo">
                            <img src="{{ asset('assets/logo/' . $gs->footer_logo ) }}" alt="" class="mb-3 pb-3 w-75">
                        </a>

                        <p class="theme-paragraph pb-3">Sagar Shah<br> Superintendent Pharmacist<br> GPHC No. 2229882
                        </p>
                        <p class="mt-3 mb-0"><a class="theme-paragraph" href="tel:01604 620008">01604 620008</a></p>
                        <p><a class="theme-paragraph"
                                href="mailto:info@chemist-nearme.co.uk">info@chemist-nearme.co.uk</a></p>

                    </div>
                    <div class="footer-column mt-4 m-md-0">
                        <h4 class="theme-sub-heading">Our Company</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Branches</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>

                    <div class="footer-column mt-4 m-md-0">
                        <h4 class="theme-sub-heading">Categories</h4>
                        <ul>
                            <li><a href="#">Pharmacy</a></li>
                            <li><a href="#">Fragrances</a></li>
                            <li><a href="#">Vitamins &amp; Supplements</a></li>
                            <li><a href="#">Food &amp; Drink</a></li>
                            <li><a href="#">Beauty</a></li>
                            <li><a href="#">Baby &amp; Child</a></li>
                            <li><a href="#">Sports Nutrition</a></li>
                        </ul>
                    </div>

                    <div class="footer-column mt-4 m-md-0">
                        <h4 class="theme-sub-heading">Help &amp; Informations</h4>
                        <ul>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Delivery Informations</a></li>
                            <li><a href="#">International Delivery</a></li>
                            <li><a href="#">Track my order</a></li>
                        </ul>
                    </div>

                    <div class="footer-column mt-4 m-md-0">
                        <h4 class="theme-sub-heading">Legal</h4>
                        <ul>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Cookies policy</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="footer-column mt-4 m-md-0">
                        <img src="{{ asset('assets/front/images/registered-pharmacy.png') }}" alt="Registered Pharmacy Logo"
                            class="mb-3 regi-pharmacy">
                        <p>Connect with us:</p>
                        <ul class="social-media-footer d-flex gap-4">
                            <li>
                                <a href="#">
                                    <svg width="20" height="20" viewBox="0 0 10 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.25765 10.5996H6.35294V19.9121H2.04706V10.5996H0V6.9527H2.04706V4.59294C2.04706 2.90487 2.85176 0.263763 6.39176 0.263763L9.58235 0.277831V3.81572H7.26706C6.88588 3.81572 6.35294 4.00563 6.35294 4.81098V6.95622H9.63176L9.25412 10.5996H9.25765Z"
                                            fill="white" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.6948 0.0879211H5.76888C2.74065 0.0879211 0.28418 2.53561 0.28418 5.55302V14.447C0.28418 17.4644 2.74065 19.9121 5.76888 19.9121H14.6948C17.723 19.9121 20.1795 17.4644 20.1795 14.447V5.55302C20.1795 2.53561 17.723 0.0879211 14.6948 0.0879211ZM18.5701 14.4259C18.5701 16.5711 16.823 18.3119 14.6701 18.3119H5.79006C3.63712 18.3119 1.89006 16.5711 1.89006 14.4259V5.57412C1.89006 3.42887 3.63712 1.68806 5.79006 1.68806H14.6701C16.823 1.68806 18.5701 3.42887 18.5701 5.57412V14.4224V14.4259Z"
                                            fill="white" />
                                        <path
                                            d="M14.6951 20H5.76923C2.69511 20 0.196289 17.5101 0.196289 14.447V5.55302C0.196289 2.48989 2.69511 0 5.76923 0H14.6951C17.7692 0 20.2681 2.48989 20.2681 5.55302V14.447C20.2681 17.5101 17.7692 20 14.6951 20ZM5.76923 0.17584C2.79393 0.17584 0.37276 2.58836 0.37276 5.55302V14.447C0.37276 17.4116 2.79393 19.8242 5.76923 19.8242H14.6951C17.6704 19.8242 20.0916 17.4116 20.0916 14.447V5.55302C20.0916 2.58836 17.6704 0.17584 14.6951 0.17584H5.76923ZM14.6739 18.3963H5.79394C3.59511 18.3963 1.8057 16.6133 1.8057 14.4224V5.57412C1.8057 3.38315 3.59511 1.60014 5.79394 1.60014H14.6739C16.8728 1.60014 18.6622 3.38315 18.6622 5.57412V14.4224C18.6622 16.6133 16.8728 18.3963 14.6739 18.3963ZM5.79394 1.77598C3.69394 1.77598 1.98217 3.47811 1.98217 5.57412V14.4224C1.98217 16.5149 3.69041 18.2205 5.79394 18.2205H14.6739C16.7739 18.2205 18.4857 16.5184 18.4857 14.4224V5.57412C18.4857 3.48162 16.7775 1.77598 14.6739 1.77598H5.79394Z"
                                            fill="white" />
                                        <path
                                            d="M10.2334 4.7758C7.33925 4.7758 4.99219 7.11447 4.99219 10.0018C4.99219 12.889 7.33925 15.2242 10.2334 15.2242C13.1275 15.2242 15.4781 12.8855 15.4781 10.0018C15.4781 7.11799 13.131 4.7758 10.2334 4.7758ZM10.2334 13.406C8.34513 13.406 6.81336 11.8797 6.81336 9.99824C6.81336 8.11676 8.34513 6.59047 10.2334 6.59047C12.1216 6.59047 13.6534 8.11676 13.6534 9.99824C13.6534 11.8797 12.1216 13.406 10.2334 13.406Z"
                                            fill="white" />
                                        <path
                                            d="M10.2337 15.3121C7.29371 15.3121 4.9043 12.9277 4.9043 10.0018C4.9043 7.07578 7.29724 4.68788 10.2337 4.68788C13.1702 4.68788 15.5666 7.07227 15.5666 10.0018C15.5666 12.9312 13.1737 15.3121 10.2337 15.3121ZM10.2337 4.86372C7.39253 4.86372 5.08077 7.16722 5.08077 10.0018C5.08077 12.8363 7.39253 15.1363 10.2337 15.1363C13.0749 15.1363 15.3902 12.8328 15.3902 10.0018C15.3902 7.17074 13.0784 4.86372 10.2337 4.86372ZM10.2337 13.4939C8.29959 13.4939 6.72547 11.9254 6.72547 9.99824C6.72547 8.07104 8.29959 6.50255 10.2337 6.50255C12.1678 6.50255 13.7419 8.07104 13.7419 9.99824C13.7419 11.9254 12.1678 13.4939 10.2337 13.4939ZM10.2337 6.67839C8.39841 6.67839 6.90194 8.16599 6.90194 9.99824C6.90194 11.8305 8.39488 13.3181 10.2337 13.3181C12.0725 13.3181 13.5655 11.8305 13.5655 9.99824C13.5655 8.16599 12.0725 6.67839 10.2337 6.67839Z"
                                            fill="white" />
                                        <path
                                            d="M16.8301 4.60348C16.8301 5.25057 16.3042 5.77457 15.6548 5.77457C15.0054 5.77457 14.4795 5.25057 14.4795 4.60348C14.4795 3.95639 15.0054 3.43239 15.6548 3.43239C16.3042 3.43239 16.8301 3.95639 16.8301 4.60348Z"
                                            fill="white" />
                                        <path
                                            d="M15.6551 5.86249C14.9563 5.86249 14.3916 5.29629 14.3916 4.60348C14.3916 3.91067 14.9598 3.34447 15.6551 3.34447C16.3504 3.34447 16.9187 3.91067 16.9187 4.60348C16.9187 5.29629 16.3504 5.86249 15.6551 5.86249ZM15.6551 3.52031C15.0551 3.52031 14.5681 4.00562 14.5681 4.60348C14.5681 5.20133 15.0551 5.68665 15.6551 5.68665C16.2551 5.68665 16.7422 5.20133 16.7422 4.60348C16.7422 4.00562 16.2551 3.52031 15.6551 3.52031Z"
                                            fill="white" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.0005 12.4213V19.8945H16.6523V12.9207C16.6523 11.1693 16.024 9.97363 14.4499 9.97363C13.2499 9.97363 12.5334 10.779 12.2193 11.5597C12.1064 11.8375 12.0746 12.2244 12.0746 12.6147V19.8945H7.72638C7.72638 19.8945 7.78638 8.08511 7.72638 6.86127H12.0746V8.70759C12.0746 8.70759 12.0534 8.73572 12.0464 8.74979H12.0746V8.70759C12.6534 7.82135 13.684 6.55531 15.9923 6.55531C18.8546 6.55531 20.997 8.41921 20.997 12.4213H21.0005ZM0.974609 19.8945H5.32284V6.86479H0.974609V19.898V19.8945ZM5.4499 2.44066C5.4499 3.67154 4.44755 4.67031 3.21226 4.67031C1.97696 4.67031 0.974609 3.67154 0.974609 2.44066C0.974609 1.20978 1.97696 0.211014 3.21226 0.211014C4.44755 0.211014 5.4499 1.20978 5.4499 2.44066Z"
                                            fill="white" />
                                    </svg>

                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </section>
        <section class="footer-bottom">
            <div class="theme-container">
                <div
                    class="d-flex flex-wrap align-items-center justify-content-md-between justify-content-center gap-3">
                    <p class="theme-paragraph mb-0 text-white">@ {{ date('Y') }} - {{ $gs->title }} </p>
                    <img src="{{ asset('assets/front/images/footer-pay.png') }}" alt="">
                    <a href="#" class="live-chat-btn theme-btn">
                        Live Chat
                        <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_270_503)">
                                <path
                                    d="M13.25 0C6.20937 0 0.75 5.15925 0.75 12.1247C0.75 15.7684 2.24375 18.9183 4.675 21.0932C4.87813 21.2745 5.00313 21.5307 5.00938 21.8057L5.07812 24.0306C5.095 24.5825 5.55625 25.0166 6.10813 24.9997C6.23688 24.9956 6.36344 24.9672 6.48125 24.915L8.9625 23.8213C9.17188 23.7275 9.40938 23.7119 9.63125 23.7713C10.7719 24.0838 11.9844 24.2525 13.25 24.2525C20.2906 24.2525 25.75 19.0933 25.75 12.1278C25.75 5.16237 20.2906 0 13.25 0Z"
                                    fill="url(#paint0_radial_270_503)" />
                                <path
                                    d="M5.74332 15.6715L9.41519 9.84662C9.96707 8.97039 11.1249 8.70759 12.0011 9.25945C12.0446 9.28664 12.0868 9.31601 12.1277 9.34663L15.0496 11.5372C15.3177 11.7378 15.6861 11.7366 15.9527 11.5341L19.8964 8.5404C20.4214 8.14041 21.1089 8.77165 20.7589 9.33101L17.0839 15.1527C16.5321 16.029 15.3743 16.2918 14.498 15.7399C14.4546 15.7127 14.4124 15.6834 14.3714 15.6527L11.4496 13.4622C11.1814 13.2615 10.813 13.2628 10.5464 13.4653L6.60269 16.459C6.07769 16.8589 5.39019 16.2308 5.74332 15.6715Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <radialGradient id="paint0_radial_270_503" cx="0" cy="0" r="1"
                                    gradientUnits="userSpaceOnUse"
                                    gradientTransform="translate(4.875 25.0972) scale(27.5 27.4993)">
                                    <stop stop-color="#0099FF" />
                                    <stop offset="0.6" stop-color="#A033FF" />
                                    <stop offset="0.9" stop-color="#FF5280" />
                                    <stop offset="1" stop-color="#FF7061" />
                                </radialGradient>
                                <clipPath id="clip0_270_503">
                                    <rect width="25" height="25" fill="white" transform="translate(0.75)" />
                                </clipPath>
                            </defs>
                        </svg>

                    </a>
                </div>
            </div>

        </section>
    </footer>