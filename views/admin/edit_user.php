<?php
global $helper;
if ($_GET["user_id"]){
    require 'src/user.php';
    $User = new User();
    $user = $User->getUserId($_GET["user_id"])[0];
} else {
    $helper->redirect('/admin.php');
}
if (! empty($_POST["update-user"])) {
    $id = $_GET["user_id"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];
    require_once ("src/user.php");
    /* Form Required Field Validation */
    $user = new User();
    global $helper;
    $errorMessage = $user->validateUser();
    
    if (empty($errorMessage)) {
        $user->updateUser($id, $fullname, $email, $address, $birthday, $gender, $phone);
        $helper->redirect('/admin.php?page=users');
    }
}
?>
<div class="content">
        <div class="container-fluid">
        <div class="col-md">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Cập nhật thông tin người dùng</h4>
                </div>
                <div class="card-body">
                    <form name="frmRegistration" method="post" action="">
                        <?php
            if (! empty($errorMessage) && is_array($errorMessage)) {
                ?>
                        <div class="error-message">
                            <?php 
                        foreach($errorMessage as $message) {
                            echo $message . "<br/>";
                        }
                        ?>
                        </div>
                        <?php
            }
            ?>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Họ Tên</label>
                            <div class="col-sm-10">
                                <input type="text" name="fullname"
                                    value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : $user['full_name']; ?>"
                                    class="form-control" id="name" placeholder="Họ Tên">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="accout" class="col-sm-2 col-form-label">Tài Khoản Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="accout" name="email"
                                    value="<?php echo isset($_POST['email']) ? $_POST['email'] : $user['email']; ?>"
                                    placeholder="Email">
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row" style="margin-right: 0; margin-left: 0px;">
                                <label for="accout" class="col-sm-2 col-form-label">Giới tính</label>
                                <div class="col-sm-10">
                                    <div class="form-check" style="display: inline-block; margin-right: 3%;">
                                        <input class="form-check-input" type="radio" name="gender" id="gender1"
                                            value="Male" checked>
                                        <label class="form-check-label" for="gender1">
                                            Nam
                                        </label>
                                    </div>
                                    <div class="form-check" style="display: inline-block; margin-right: 3%;">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2"
                                            value="Female">
                                        <label class="form-check-label" for="gender2">
                                            Nữ
                                        </label>
                                    </div>
                                    <div class="form-check" style="display: inline-block; margin-right: 3%;">
                                        <input class="form-check-input" type="radio" name="gender" id="gender3"
                                            value="Other">
                                        <label class="form-check-label" for="gender3">
                                            Khác
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address"
                                    value="<?php  echo isset($_POST['address']) ? $_POST['address'] : $user['address']; ?>"
                                    id="address" placeholder="Địa chỉ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone"
                                    value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $user['phone']; ?>"
                                    id="phone" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-sm-2 col-form-label">Ngày sinh</label>
                            <div class="col-sm-10">
                                <input type="date" name="birthday"
                                    value="<?php  echo isset($_POST['birthday']) ? $_POST['birthday'] : $user['birthday'];?>"
                                    class="form-control" id="dob">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10" style="display: none;">
                                <input type="checkbox" checked name="terms"> Tôi chấp nhận các điều khoản
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="update-user" value="Cập nhật"
                                class="btn btn-primary pull-right login-button">
                            <div>
                    </form>
                    </div>

    </div>
</div>
</div>
<footer class="footer" style="display: block">
    <div class="container-fluid">
        <nav class="float-left">
        </nav>
        <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>, được phát triển bởi
            <a href="/" target="_blank">Fast Food</a>
        </div>
    </div>
</footer>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap-material-design.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="../assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="../assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="../assets/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="../assets/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="../assets/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../assets/js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="../assets/js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<script>
    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function (event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $(
                        '.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function () {
                        $sidebar_img_container.css('background-image', 'url("' +
                            new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $(
                        '.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                        'img').data('src');

                    $full_page_background.fadeOut('fast', function () {
                        $full_page_background.css('background-image', 'url("' +
                            new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr(
                        'src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                        'img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' +
                        new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function () {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function () {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function () {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });
</script>